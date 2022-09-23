<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\PelayanMisaService;

class PelayanMisaController extends Controller
{
    public function index()
    {
        $data['pelayanMisa'] = PelayanMisaService::jadwalMisa();
        return view('pelayan-misa.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required'
        ]);
        $result = PelayanMisaService::tambahJadwalMisa($request);
        if ($result) return redirect()->route('pelayan-misa')->with(AlertFormatter::success('Jadwal misa berhasil di tambahkan.'));
        return redirect()->back()->with(AlertFormatter::danger('Jadwal misa gagal di tambahkan.'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required'
        ]);

        $result = PelayanMisaService::ubahJadwalMisa($request, $id);

        if($result > 0)
            return redirect()->back()->with(AlertFormatter::success('Jadwal misa berhasil di ubah.'));
        
        return redirect()->back()->with(AlertFormatter::danger('Tanggal gagal di ubah.'));
    }

    public function delete($id)
    {
        $result = PelayanMisaService::hapusJadwalMisa($id);

        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Jadwal misa berhasil dihapus.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Jadwal misa gagal dihapus.'));
    }

}
