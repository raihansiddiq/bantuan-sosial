<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_program',
        'jumlah_penerima',
        'wilayah_provinsi',
        'tanggal_penyaluran',
        'bukti_penyaluran',
        'catatan_tambahan',
    ];
}
