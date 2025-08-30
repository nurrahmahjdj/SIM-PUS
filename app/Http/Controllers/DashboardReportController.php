<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiah;
use App\Models\User;
use App\Models\Rumpun;
use Illuminate\Http\Request;
use PDF;

class DashboardReportController extends Controller
{
    public function index(){

        $tanggalawal = request(['start_date']) ?? date('Y-m-d');
        $tanggalahir = request(['end_date']) ?? date('Y-m-d');
        // $karyailmiahs = KaryaIlmiah::latest()->filter(request(['start_date', 'end_date', 'tipe', 'rumpun']))->paginate(15)->withQueryString();
        $karyailmiahs = KaryaIlmiah::all();
        $rumpuns = Rumpun::all();
        // $prodis = prodi::all();
        $tipes = KaryaIlmiah::distinct()->get(['tipe']);



        // dd(request());

        // return view('dashboard.reports.index',[
        //     'karyailmiahs' => $karyailmiahs,
        //     // 'tanggalawal' => $tanggalawal,
        //     // 'tanggalahir' => $tanggalahir,
        //     'tipes' => $tipes,
        //     'rumpuns' => $rumpuns,
        //     // 'prodis' => $prodis,

        // ]);

        return view('dashboard.reports.laporan', [
            'karyailmiahs' => $karyailmiahs,
        ]);

    }

    public function exportpdf(){
        $data = KaryaIlmiah::latest()->filter(request(['start_date', 'end_date', 'tipe', 'rumpun']))->get();

        // dd(request());

        view()->share('data', $data);
        $pdf = PDF::loadview('dashboard.reports.report');
        return $pdf->download('data.pdf');
    }

    // //reset button
    // public function reset(Request $request, $npm)
    // {
    //     $validatedData['password']= bcrypt($npm);

    //     Mahasiswa::where('npm', $npm)
    //     ->update($validatedData);

    //     return redirect('dashboard/mahasiswa')->with('success', 'password berhasil direset!');
    // }
}
