<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Pkl;


class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count(); // total siswa
        $totalIndustri = Industri::count(); //total industri
        $totalPkl = Pkl::count(); //total pkl

        //kirim data ke view dashboard buat ditampilin
        return view('dashboard', [
            'totalSiswa' => $totalSiswa,
            'totalIndustri' => $totalIndustri,
            'totalPkl' => $totalPkl,
        ]);
    }
}