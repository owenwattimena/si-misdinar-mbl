<?php 
namespace App\Services;

use App\Models\Misa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MisaService{

    static function misa(int $id = 0)
    {
        $result = DB::table('misa');
        if($id == 0) return Misa::with('pelayan.misdinar')->get();
        return $result->where('id', $id)->first();
    }

    public static function tambah(Request $request, int $idJadwal)
    {
        return DB::table('misa')->insert(
            [
                'id_jadwal_misa' => $idJadwal,
                'misa'           => $request->misa
            ]
        );
    }

    static function ubah(Request $request, $idJadwal, $idMisa)
    {
        return DB::table('misa')->where('id', $idMisa)->update(
            [
                'misa' => $request->misa
            ]
        );
    }

    static function hapus(int $idMisa)
    {
        return DB::table('misa')->where('id', $idMisa)->delete();
    }

    public static function misdinar(Request $request, int $idMisa)
    {
        $data = DB::table('pelayan_misa')->where('id_misa', $idMisa)->where('id_misdinar', $request->id_misdinar)->first();
        if($data) return null;
        return DB::table('pelayan_misa')->insert(
            [
                'id_misa'       => $idMisa,
                'id_misdinar'   => $request->id_misdinar
            ]
        );
    }

    static function hapusMisdinar(int $idPelayan)
    {
        return DB::table('pelayan_misa')->where('id', $idPelayan)->delete();
    }
}