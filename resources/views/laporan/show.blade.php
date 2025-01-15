@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>
    <p><strong>Nama Program:</strong> {{ $laporan->nama_program }}</p>
    <p><strong>Jumlah Penerima:</strong> {{ $laporan->jumlah_penerima }}</p>
    <p><strong>Wilayah:</strong> {{ $laporan->wilayah_provinsi }}</p>
    <p><strong>Tanggal Penyaluran:</strong> {{ $laporan->tanggal_penyaluran }}</p>
    <p><strong>Catatan Tambahan:</strong> {{ $laporan->catatan_tambahan }}</p>
    <p><strong>Bukti Penyaluran:</strong> <a href="{{ asset('storage/' . $laporan->bukti_penyaluran) }}" target="_blank">Lihat Bukti</a></p>
</div>
@endsection
