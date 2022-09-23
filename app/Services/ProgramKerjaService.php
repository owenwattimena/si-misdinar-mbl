<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramKerjaService
{
    static function programKerja($id = 0)
    {
        $programKerja = DB::table('program_kerja');
        if ($id != 0) {
            return $programKerja->where('id', $id)->first();
        }
        return $programKerja->get();
    }

    static function tambah(Request $request)
    {
        return DB::table('program_kerja')->insert(
            [
                'seksi' => $request->seksi,
                'program_kerja' => $request->program_kerja
            ]
        );
    }
    static function ubah(Request $request, $id)
    {
        return DB::table('program_kerja')->where('id', $id)->update(
            [
                'seksi' => $request->seksi,
                'program_kerja' => $request->program_kerja
            ]
        );
    }
    static function hapus(int $id)
    {
        return DB::table('program_kerja')->where('id', $id)->delete();
    }
}
