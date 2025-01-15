<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_bantuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->integer('jumlah_penerima');
            $table->string('wilayah_provinsi');
            $table->string('wilayah_kabupaten');
            $table->string('wilayah_kecamatan');
            $table->date('tanggal_penyaluran');
            $table->string('bukti_penyaluran');
            $table->text('catatan_tambahan')->nullable();
            $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_bantuan');
    }
}
