<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanBantuan;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = LaporanBantuan::where('status', 'Pending')->get();
        return view('laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required',
            'jumlah_penerima' => 'required|integer|min:1',
            'wilayah_provinsi' => 'required',
            'wilayah_kabupaten' => 'required',
            'wilayah_kecamatan' => 'required',
            'tanggal_penyaluran' => 'required|date',
            'bukti_penyaluran' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $filePath = $request->file('bukti_penyaluran')->store('bukti_penyaluran');

        LaporanBantuan::create([
            'nama_program' => $request->nama_program,
            'jumlah_penerima' => $request->jumlah_penerima,
            'wilayah_provinsi' => $request->wilayah_provinsi,
            'wilayah_kabupaten' => $request->wilayah_kabupaten,
            'wilayah_kecamatan' => $request->wilayah_kecamatan,
            'tanggal_penyaluran' => $request->tanggal_penyaluran,
            'bukti_penyaluran' => $filePath,
            'catatan_tambahan' => $request->catatan_tambahan,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laporan = LaporanBantuan::findOrFail($id);
        if ($laporan->status !== 'Pending') {
            abort(403, 'Laporan tidak dapat diedit.');
        }
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanBantuan::findOrFail($id);
        if ($laporan->status !== 'Pending') {
            abort(403, 'Laporan tidak dapat diubah.');
        }

        $request->validate([
            'nama_program' => 'required',
            'jumlah_penerima' => 'required|integer|min:1',
            'wilayah_provinsi' => 'required',
            'wilayah_kabupaten' => 'required',
            'wilayah_kecamatan' => 'required',
            'tanggal_penyaluran' => 'required|date',
            'bukti_penyaluran' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti_penyaluran')) {
            Storage::delete($laporan->bukti_penyaluran);
            $laporan->bukti_penyaluran = $request->file('bukti_penyaluran')->store('bukti_penyaluran');
        }

        $laporan->update($request->all());

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diubah.');
    }

    public function destroy($id)
    {
        $laporan = LaporanBantuan::findOrFail($id);
        if ($laporan->status !== 'Pending') {
            abort(403, 'Laporan tidak dapat dihapus.');
        }

        Storage::delete($laporan->bukti_penyaluran);
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}

