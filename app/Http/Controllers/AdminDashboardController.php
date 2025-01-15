<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Menyaring data berdasarkan wilayah yang dipilih
        $wilayah = $request->input('wilayah');

        // Ambil daftar wilayah untuk dropdown
        $allWilayah = Laporan::select('wilayah_provinsi')->distinct()->get()->pluck('wilayah_provinsi');

        // Ambil total laporan yang masuk (dengan filter jika ada wilayah)
        $laporanQuery = Laporan::query();
        if ($wilayah) {
            $laporanQuery->where('wilayah_provinsi', $wilayah);
        }
        $totalLaporan = $laporanQuery->count();

        // Ambil jumlah penerima per program
        $jumlahPenerima = $laporanQuery->select('nama_program', DB::raw('SUM(jumlah_penerima) as total'))
                                       ->groupBy('nama_program')
                                       ->get();

        // Ambil statistik penyaluran per wilayah
        $penyaluranPerWilayah = $laporanQuery->select('wilayah_provinsi', DB::raw('SUM(jumlah_penerima) as total'))
                                             ->groupBy('wilayah_provinsi')
                                             ->get();

        return view('admin.dashboard', compact('totalLaporan', 'jumlahPenerima', 'penyaluranPerWilayah', 'allWilayah'));
    }
}

