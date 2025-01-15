@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<h1>Edit Laporan</h1>
<form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_program" class="form-label">Nama Program</label>
        <select name="nama_program" class="form-control" required>
            <option value="PKH" {{ $laporan->nama_program === 'PKH' ? 'selected' : '' }}>PKH</option>
            <option value="BLT" {{ $laporan->nama_program === 'BLT' ? 'selected' : '' }}>BLT</option>
            <option value="Bansos" {{ $laporan->nama_program === 'Bansos' ? 'selected' : '' }}>Bansos</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="jumlah_penerima" class="form-label">Jumlah Penerima</label>
        <input type="number" name="jumlah_penerima" class="form-control" value="{{ $laporan->jumlah_penerima }}" required>
    </div>
    <div class="mb-3">
        <label for="wilayah_provinsi" class="form-label">Wilayah Provinsi</label>
        <input type="text" name="wilayah_provinsi" class="form-control" value="{{ $laporan->wilayah_provinsi }}" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_penyaluran" class="form-label">Tanggal Penyaluran</label>
        <input type="date" name="tanggal_penyaluran" class="form-control" value="{{ $laporan->tanggal_penyaluran }}" required>
    </div>
    <div class="mb-3">
        <label for="bukti_penyaluran" class="form-label">Bukti Penyaluran (Kosongkan jika tidak ingin mengganti)</label>
        <input type="file" name="bukti_penyaluran" class="form-control" accept="image/png, image/jpeg, application/pdf">
    </div>
    <div class="mb-3">
        <label for="catatan_tambahan" class="form-label">Catatan Tambahan</label>
        <textarea name="catatan_tambahan" class="form-control">{{ $laporan->catatan_tambahan }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
