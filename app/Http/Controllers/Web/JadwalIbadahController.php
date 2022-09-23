<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\JadwalIbadahService;

class JadwalIbadahController extends Controller
{
    public function index()
    {
        $data['jadwal'] = JadwalIbadahService::jadwalIbadah();
        return view('jadwal-ibadah.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'tempat_ibadah' => 'required',
            'pemimpin_ibadah' => 'required',
            'permainan_sharing' => 'required',
            'pembawa_lagu' => 'required'
        ]);
        $result = JadwalIbadahService::tambah($request);
        if ($result) return redirect()->route('jadwal-ibadah')->with(AlertFormatter::success('Jadwal ibadah berhasil di tambahkan.'));
        return redirect()->back()->with(AlertFormatter::danger('Jadwal ibadah gagal di tambahkan.'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'tempat_ibadah' => 'required',
            'pemimpin_ibadah' => 'required',
            'permainan_sharing' => 'required',
            'pembawa_lagu' => 'required'
        ]);

        $result = JadwalIbadahService::ubah($request, $id);

        if($result > 0)
            return redirect()->back()->with(AlertFormatter::success('Jadwal ibadah berhasil di ubah.'));
        
        return redirect()->back()->with(AlertFormatter::danger('Jadwal ibadah gagal di ubah.'));
    }

    public function delete($id)
    {
        $result = JadwalIbadahService::hapus($id);

        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Jadwal ibadah berhasil dihapus.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Jadwal ibadah gagal dihapus.'));
    }
}
