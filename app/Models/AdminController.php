<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanBantuan;

class AdminController extends Controller
{
    public function index()
    {
        $laporan = LaporanBantuan::all();
        return view('admin.laporan.index', compact('laporan'));
    }

    public function approve($id)
    {
        $laporan = LaporanBantuan::findOrFail($id);
        $laporan->update(['status' => 'Disetujui']);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);

        $laporan = LaporanBantuan::findOrFail($id);
        $laporan->update([
            'status' => 'Ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil ditolak.');
    }

    public function dashboard()
    {
        $totalLaporan = LaporanBantuan::count();
        $laporanPerProgram = LaporanBantuan::select('nama_program')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('nama_program')
            ->get();

        $laporanPerWilayah = LaporanBantuan::select('wilayah_provinsi')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('wilayah_provinsi')
            ->get();

        return view('admin.dashboard', compact('totalLaporan', 'laporanPerProgram', 'laporanPerWilayah'));
    }
}

