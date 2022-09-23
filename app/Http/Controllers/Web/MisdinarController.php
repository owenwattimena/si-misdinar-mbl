<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\MisdinarService;
use Illuminate\Http\Request;

class MisdinarController extends Controller
{
    public function index()
    {
        $misdinar = MisdinarService::misdinar();
        $jumlahLaki = MisdinarService::jumlahMisdinar('Laki-laki');
        $jumlahPerempuan = MisdinarService::jumlahMisdinar('Perempuan');
        $data['misdinar'] = $misdinar;
        $data['jumlahLaki'] = $jumlahLaki;
        $data['jumlahPerempuan'] = $jumlahPerempuan;
        return view('misdinar.index', $data);
    }

    public  function store(Request $request)
    {
        $request->validate([
            "nama"  => "required",
            "tempat_lahir"  => "required",
            "tanggal_lahir"  => "required|date",
            "jenis_kelamin"  => "required",
            "jabatan"  => "required",
            "asal_rukun"  => "required",
        ]);

        $result = MisdinarService::tambah($request);
        if($result)
        {
            return redirect()->back()->with(AlertFormatter::success('Misdinar berhasil ditambahkan.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Misdinar gagal ditambahkan.'));
    }
    public  function update(Request $request, $id)
    {
        $request->validate([
            "nama"  => "required",
            "tempat_lahir"  => "required",
            "tanggal_lahir"  => "required|date",
            "jenis_kelamin"  => "required",
            "jabatan"  => "required",
            "asal_rukun"  => "required",
        ]);

        $result = MisdinarService::ubah($request, $id);
        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Misdinar berhasil diubah.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Misdinar gagal diubah.'));
    }

    public function delete(Request $request, $id)
    {
        $result = MisdinarService::hapus($id);
        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Misdinar berhasil dihapus.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Misdinar gagal dihapus.'));
    }
}
