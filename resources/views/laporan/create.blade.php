@extends('layouts.app')

@section('title', 'Formulir Laporan')

@section('content')
<h1>Formulir Laporan</h1>
<form id="laporanForm" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_program" class="form-label">Nama Program</label>
        <select id="nama_program" name="nama_program" class="form-control" required>
            <option value="">Pilih Program</option>
            <option value="PKH">PKH</option>
            <option value="BLT">BLT</option>
            <option value="Bansos">Bansos</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="jumlah_penerima" class="form-label">Jumlah Penerima</label>
        <input id="jumlah_penerima" type="number" name="jumlah_penerima" class="form-control" required min="1">
    </div>
    <div class="mb-3">
        <label for="wilayah_provinsi" class="form-label">Wilayah Provinsi</label>
        <input id="wilayah_provinsi" type="text" name="wilayah_provinsi" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_penyaluran" class="form-label">Tanggal Penyaluran</label>
        <input id="tanggal_penyaluran" type="date" name="tanggal_penyaluran" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="bukti_penyaluran" class="form-label">Bukti Penyaluran</label>
        <input id="bukti_penyaluran" type="file" name="bukti_penyaluran" class="form-control" accept="image/png, image/jpeg, application/pdf" required>
    </div>
    <div class="mb-3">
        <label for="catatan_tambahan" class="form-label">Catatan Tambahan</label>
        <textarea id="catatan_tambahan" name="catatan_tambahan" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    document.getElementById('laporanForm').addEventListener('submit', function (event) {
        // Validasi Nama Program
        const namaProgram = document.getElementById('nama_program').value;
        if (!namaProgram) {
            alert('Pilih nama program!');
            event.preventDefault();
            return;
        }

        // Validasi Jumlah Penerima
        const jumlahPenerima = document.getElementById('jumlah_penerima').value;
        if (jumlahPenerima < 1) {
            alert('Jumlah penerima harus lebih dari 0!');
            event.preventDefault();
            return;
        }

        // Validasi Wilayah
        const wilayah = document.getElementById('wilayah_provinsi').value;
        if (!wilayah.trim()) {
            alert('Wilayah harus diisi!');
            event.preventDefault();
            return;
        }

        // Validasi Tanggal Penyaluran
        const tanggalPenyaluran = document.getElementById('tanggal_penyaluran').value;
        if (!tanggalPenyaluran) {
            alert('Tanggal penyaluran harus diisi!');
            event.preventDefault();
            return;
        }

        // Validasi File Bukti Penyaluran
        const buktiPenyaluran = document.getElementById('bukti_penyaluran').files[0];
        if (buktiPenyaluran) {
            const allowedExtensions = ['image/jpeg', 'image/png', 'application/pdf'];
            if (!allowedExtensions.includes(buktiPenyaluran.type)) {
                alert('File bukti harus berupa JPG, PNG, atau PDF!');
                event.preventDefault();
                return;
            }
            if (buktiPenyaluran.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                event.preventDefault();
                return;
            }
        } else {
            alert('Bukti penyaluran harus diunggah!');
            event.preventDefault();
            return;
        }
    });
</script>
@endsection
