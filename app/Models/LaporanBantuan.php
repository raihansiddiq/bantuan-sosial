<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBantuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_program',
        'jumlah_penerima',
        'wilayah_provinsi',
        'wilayah_kabupaten',
        'wilayah_kecamatan',
        'tanggal_penyaluran',
        'bukti_penyaluran',
        'catatan_tambahan',
        'status',
        'alasan_penolakan',
    ];
}
