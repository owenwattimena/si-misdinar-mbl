<?php

namespace App\Http\Controllers\Web;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Services\KeuanganService;
use App\Http\Controllers\Controller;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $date = date("Y-m-d");
        if ($request->tanggal) {
            $date = $request->tanggal;
        }
        $keuangan = KeuanganService::keuangan($date);
        $keuanganAll = KeuanganService::keuangan();
        $data['keuangan'] = $keuangan;
        $data['saldo'] = collect($keuanganAll)->sum('jumlah');
        $data['kredit'] = collect($keuangan)->where('tipe', 'kredit')->sum('jumlah');
        $data['debit'] = collect($keuangan)->where('tipe', 'debit')->sum('jumlah');
        $data['date'] = $date;
        // dd($data);
        return view('keuangan.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'tipe' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);
        $result = KeuanganService::tambah($request);
        if ($result) return redirect()->back()->with(AlertFormatter::success('Berhasil di tambahkan.'));
        return redirect()->back()->with(AlertFormatter::danger('Gagal di tambahkan.'));
    }

    public function delete($id){
        $result = KeuanganService::hapus($id);

        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Transaksi berhasil dihapus.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Transaksi gagal dihapus.'));
    }
}
