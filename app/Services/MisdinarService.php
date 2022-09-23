<?php 
namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MisdinarService{

    static function misdinar(int $id = 0) : Collection
    {
        $misdinar = DB::table('misdinar');
        if($id != 0){
            $misdinar->where('id', $id);
        }
        return $misdinar->get();
    }

    static function jumlahMisdinar($gender) : int
    {
        return DB::table('misdinar')
            ->where('jenis_kelamin', $gender)->count();
    }

    static function tambah(Request $request) : bool
    {
        return DB::table('misdinar')->insert([
            "nama" => $request->nama,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin,
            "jabatan" => $request->jabatan,
            "asal_rukun" => $request->asal_rukun
        ]);
    }
    static function ubah(Request $request, int $id) : bool
    {
        return DB::table('misdinar')->where('id', $id)->update([
            "nama" => $request->nama,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin,
            "jabatan" => $request->jabatan,
            "asal_rukun" => $request->asal_rukun
        ]);
    }

    static function hapus($id)
    {
        return DB::table('misdinar')->where('id', $id)->delete();
    }
}
?>