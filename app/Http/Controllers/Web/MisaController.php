<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\MisaService;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\MisdinarService;
use App\Services\PelayanMisaService;

class MisaController extends Controller
{
    public function index(int $id)
    {
        $data['misdinar'] = MisdinarService::misdinar();
        $data['jadwal'] = PelayanMisaService::jadwalMisa($id);
        $data['misa'] = MisaService::misa();
        // dd($data['misa']);  
        return view('pelayan-misa.misa', $data);
    }

    public function store(Request $request, int $idJadwal)
    {
        $request->validate([
            'misa' => 'required'
        ]);
        $result = MisaService::tambah($request, $idJadwal);
        if ($result) return redirect()->back()->with(AlertFormatter::success('Misa berhasil di tambahkan.'));
        return redirect()->back()->with(AlertFormatter::danger('Misa gagal di tambahkan.'));
    }

    public function update(Request $request, $idJadwal, $idMisa)
    {
        $request->validate([
            'misa' => 'required'
        ]);

        $result = MisaService::ubah($request, $idJadwal, $idMisa);

        if($result > 0)
            return redirect()->back()->with(AlertFormatter::success('Misa berhasil di ubah.'));
        
        return redirect()->back()->with(AlertFormatter::danger('Magal di ubah.'));
    }

    public function delete($idJadwal, $idMisa)
    {
        $result = MisaService::hapus($idMisa);

        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Misa berhasil dihapus.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Misa gagal dihapus.'));
    }

    // 
    public function misdinar(Request $request, int $idJadwal, $idMisa)
    {
        $request->validate([
            'id_misdinar' => 'required'
        ]);
        $result = MisaService::misdinar($request, $idMisa);
        if($result == null) return redirect()->back()->with(AlertFormatter::warning('Misdinar telah di tambahkan.'));
        if ($result) return redirect()->back()->with(AlertFormatter::success('Misdinar berhasil di tambahkan.'));
        return redirect()->back()->with(AlertFormatter::danger('Misdinar gagal di tambahkan.'));
    }

    public function deleteMisdinar($idJadwal, $idMisa, $idPelayan)
    {
        $result = MisaService::hapusMisdinar($idPelayan);

        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Misdinar berhasil dihapus.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Misdinar gagal dihapus.'));
    }
    
}
