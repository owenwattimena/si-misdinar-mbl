<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AlertFormatter;
use App\Services\ProgramKerjaService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramKerjaController extends Controller
{
    public function index()
    {
        $data['programKerja'] = ProgramKerjaService::programKerja();
        return view('program-kerja.index', $data);
    }
    public function tambah()
    {
        return view('program-kerja.tambah');
    }
    public function store(Request $request)
    {
        $request->validate([
            'seksi' => 'required',
            'program_kerja' => 'required'
        ]);

        $result = ProgramKerjaService::tambah($request);

        if($result)
        {
            return redirect()->route('program-kerja')->with(AlertFormatter::success('Program kerja berhasil di tambahkan.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Program kerja gagal di tambahkan.'));

    }

    public function detail($id)
    {
        $data['programKerja'] = ProgramKerjaService::programKerja($id);
        return view('program-kerja.detail', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'seksi' => 'required',
            'program_kerja' => 'required'
        ]);

        $result = ProgramKerjaService::ubah($request, $id);

        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Program kerja berhasil di ubah.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Program kerja gagal di ubah.'));

    }

    public function delete($id)
    {
        $result = ProgramKerjaService::hapus($id);

        if($result > 0)
        {
            return redirect()->back()->with(AlertFormatter::success('Program kerja berhasil dihapus.'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Program kerja gagal dihapus.'));
    }
}
