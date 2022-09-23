<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PelayanMisaService
{
    static function jadwalMisa(int $id = 0)
    {
        $result = DB::table('jadwal_misa');
        if($id == 0) return $result->get();
        return $result->where('id', $id)->first();
    }
    static function tambahJadwalMisa(Request $request)
    {
        return DB::table('jadwal_misa')->insert(
            [
                'tanggal' => $request->tanggal
            ]
        );
    }
    static function ubahJadwalMisa(Request $request, $id)
    {
        return DB::table('jadwal_misa')->where('id', $id)->update(
            [
                'tanggal' => $request->tanggal
            ]
        );
    }

    static function hapusJadwalMisa(int $id)
    {
        return DB::table('jadwal_misa')->where('id', $id)->delete();
    }


}