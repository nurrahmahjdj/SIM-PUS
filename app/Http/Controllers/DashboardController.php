<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiah;
use App\Models\User;
use App\Models\Visitor;
use App\Charts\VisitorCountChart;

class DashboardController extends Controller
{
    public function index(VisitorCountChart $visitorCountChart){

        $users = User::where("is_admin", "false")->count();
        $jurnal = KaryaIlmiah::where('tipe', "Jurnal")->count();
        $skripsi = KaryaIlmiah::where('tipe', "Skripsi / Tugas Akhir")->count();
        $haki = KaryaIlmiah::where('tipe', "HKI")->count();
        $visitorCount = Visitor::count();


        return view('dashboard.index', [
            'users' => $users,
            'jurnal' => $jurnal,
            'skripsi' => $skripsi,
            'haki' => $haki,
            'visitorCount' => $visitorCount,
            'visitorcountchart' => $visitorCountChart->build()

        ]);
      }

}
