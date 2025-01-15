<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan; // Pastikan menggunakan model yang sesuai

class AdminController extends Controller
{
    // Menampilkan daftar laporan
    public function index()
    {
        // Ambil semua laporan
        $laporans = Laporan::all(); // Sesuaikan dengan model yang Anda gunakan
        return view('admin.laporan.index', compact('laporans'));
    }

    // Menyetujui laporan
    public function approve($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'Disetujui';
        $laporan->save();

        return redirect()->route('admin.laporan.index');
    }

    // Menolak laporan
    public function reject($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'Ditolak';
        $laporan->save();

        return redirect()->route('admin.laporan.index');
    }

    // Menampilkan dashboard admin
    public function dashboard()
    {
        // Tampilkan statistik atau data yang diperlukan di dashboard
        return view('admin.dashboard');
    }
}
