<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalIbadahService
{
    static function jadwalIbadah(int $id = 0)
    {
        $jadwal = DB::table('jadwal_ibadah');
        if($id != 0)
        {
            return $jadwal->where('id', $id)->first();
        }
        return $jadwal->get();
    }
    static function tambah(Request $request)
    {
        return DB::table('jadwal_ibadah')->insert(
            [
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'tempat_ibadah' => $request->tempat_ibadah,
                'pemimpin_ibadah' => $request->pemimpin_ibadah,
                'permainan_sharing' => $request->permainan_sharing,
                'pembawa_lagu' => $request->pembawa_lagu
            ]
        );
    }

    static function ubah(Request $request, $id)
    {
        return DB::table('jadwal_ibadah')->where('id', $id)->update(
            [
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'tempat_ibadah' => $request->tempat_ibadah,
                'pemimpin_ibadah' => $request->pemimpin_ibadah,
                'permainan_sharing' => $request->permainan_sharing,
                'pembawa_lagu' => $request->pembawa_lagu
            ]
        );
    }

    static function hapus(int $id)
    {
        return DB::table('jadwal_ibadah')->where('id', $id)->delete();
    }

}