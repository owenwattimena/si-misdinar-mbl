<?php 
namespace App\Services;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganService
{
    public static function keuangan($tanggal = null, $cari = false)
    {
        if($tanggal !=null){
            $date = new DateTime( $cari ? $tanggal : strtotime( $tanggal )) ;
            $month = ($date->format('m'));
            $data = DB::table('keuangan')->whereMonth('tanggal', $month)->orderBy('tanggal', 'desc')->get();
        }else{
            $data = DB::table('keuangan')->orderBy('tanggal', 'desc')->get();
        }
        return $data;
    }

    public static function tambah(Request $request)
    {
        $jumlah = $request->jumlah;
        if($request->tipe == 'kredit'){
            $jumlah = -1 * abs($request->jumlah);
        } 
        return DB::table('keuangan')->insert(
            [
                'tanggal' => $request->tanggal,
                'tipe'        => $request->tipe,
                'jumlah'      => $jumlah,
                'keterangan'  => $request->keterangan,
            ]
        );
    }

    static function hapus(int $id)
    {
        return DB::table('keuangan')->where('id', $id)->delete();
    }

}