@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard Monitoring Penyaluran Bantuan</h1>

<!-- resources/views/admin/laporan/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
</head>
<body>
    <h1>Daftar Laporan</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Program</th>
                <th>Jumlah Penerima</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
                <tr>
                    <td>{{ $laporan->program }}</td>
                    <td>{{ $laporan->jumlah_penerima }}</td>
                    <td>{{ $laporan->status }}</td>
                    <td>
                        <a href="{{ route('admin.laporan.approve', $laporan->id) }}">Setujui</a>
                        <a href="{{ route('admin.laporan.reject', $laporan->id) }}">Tolak</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<!-- Form Filter Wilayah -->
<form action="{{ route('admin.dashboard') }}" method="GET">
    <label for="wilayah">Filter Wilayah: </label>
    <select name="wilayah" id="wilayah">
        <option value="">Pilih Wilayah</option>
        @foreach($allWilayah as $wilayah)
            <option value="{{ $wilayah }}" {{ request('wilayah') == $wilayah ? 'selected' : '' }}>{{ $wilayah }}</option>
        @endforeach
    </select>
    <button type="submit">Filter</button>
</form>

<!-- Total Laporan -->
<div class="card">
    <div class="card-body">
        <h5>Total Laporan Masuk: {{ $totalLaporan }}</h5>
    </div>
</div>

<!-- Grafik Jumlah Penerima per Program -->
<div class="card">
    <div class="card-body">
        <canvas id="jumlahPenerimaChart"></canvas>
    </div>
</div>

<!-- Grafik Penyaluran per Wilayah -->
<div class="card">
    <div class="card-body">
        <canvas id="penyaluranPerWilayahChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Jumlah Penerima per Program
    var ctx1 = document.getElementById('jumlahPenerimaChart').getContext('2d');
    var chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: @json($jumlahPenerima->pluck('nama_program')),
            datasets: [{
                label: 'Jumlah Penerima',
                data: @json($jumlahPenerima->pluck('total')),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    // Grafik Penyaluran per Wilayah
    var ctx2 = document.getElementById('penyaluranPerWilayahChart').getContext('2d');
    var chart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: @json($penyaluranPerWilayah->pluck('wilayah_provinsi')),
            datasets: [{
                label: 'Penyaluran Per Wilayah',
                data: @json($penyaluranPerWilayah->pluck('total')),
                backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F'],
            }]
        }
    });
</script>
@endsection
