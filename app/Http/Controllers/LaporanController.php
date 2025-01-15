<?php

namespace App\Http\Controllers;

use App\Models\Laporan; // Pastikan namespace model Laporan benar
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function create()
    {
        return view('laporan.create');
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id); // Memastikan laporan ditemukan atau gagal
        return view('laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id); // Memastikan laporan ditemukan atau gagal
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_program' => 'required',
            'jumlah_penerima' => 'required|numeric|min:1',
            'wilayah_provinsi' => 'required|string',
            'tanggal_penyaluran' => 'required|date',
            'bukti_penyaluran' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $laporan = Laporan::findOrFail($id); // Memastikan laporan ditemukan atau gagal
        $laporan->nama_program = $request->nama_program;
        $laporan->jumlah_penerima = $request->jumlah_penerima;
        $laporan->wilayah_provinsi = $request->wilayah_provinsi;
        $laporan->tanggal_penyaluran = $request->tanggal_penyaluran;
        $laporan->catatan_tambahan = $request->catatan_tambahan;

        if ($request->hasFile('bukti_penyaluran')) {
            $path = $request->file('bukti_penyaluran')->store('laporan_bukti', 'public');
            $laporan->bukti_penyaluran = $path;
        }

        $laporan->save();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id); // Memastikan laporan ditemukan atau gagal
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
