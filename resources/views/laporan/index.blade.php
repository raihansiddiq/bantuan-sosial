@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Laporan</h1>
    <a href="{{ route('laporan.create') }}" class="btn btn-primary mb-3">Buat Laporan Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Program</th>
                <th>Jumlah Penerima</th>
                <th>Wilayah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
            <tr>
                <td>{{ $item->nama_program }}</td>
                <td>{{ $item->jumlah_penerima }}</td>
                <td>{{ $item->wilayah_provinsi }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="{{ route('laporan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('laporan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
