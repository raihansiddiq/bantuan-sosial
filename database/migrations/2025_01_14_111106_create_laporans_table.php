<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('laporan', function (Blueprint $table) {
        $table->id();
        $table->string('nama_program');
        $table->integer('jumlah_penerima');
        $table->string('wilayah_provinsi');
        $table->date('tanggal_penyaluran');
        $table->string('bukti_penyaluran');
        $table->text('catatan_tambahan')->nullable();
        $table->string('status')->default('Pending');
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
        Schema::dropIfExists('laporans');
    }
}
