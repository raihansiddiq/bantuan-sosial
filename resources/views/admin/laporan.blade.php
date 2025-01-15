@extends('layouts.app')

@section('title', 'Verifikasi Laporan')

@section('content')
<h1>Verifikasi Laporan</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama Program</th>
            <th>Wilayah</th>
            <th>Jumlah Penerima</th>
            <th>Tanggal Penyaluran</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $item)
        <tr>
            <td>{{ $item->nama_program }}</td>
            <td>{{ $item->wilayah_provinsi }}</td>
            <td>{{ $item->jumlah_penerima }}</td>
            <td>{{ $item->tanggal_penyaluran }}</td>
            <td><a href="{{ asset('storage/' . $item->bukti_penyaluran) }}" target="_blank">Lihat Bukti</a></td>
            <td>{{ $item->status }}</td>
            <td>
                @if($item->status === 'Pending')
                <form action="{{ route('admin.approve', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                </form>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $item->id }}">Tolak</button>

                <!-- Modal Tolak -->
                <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rejectModalLabel">Tolak Laporan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.reject', $item->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                                    <textarea name="alasan_penolakan" class="form-control" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
