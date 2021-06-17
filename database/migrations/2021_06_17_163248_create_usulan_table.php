<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->longText('keterangan_usulan');
            $table->integer('id_pengusul');
            $table->string('status');
            $table->timestamp('tgl_dibuat')->nullable()->default(null);;
            $table->timestamp('tgl_diperbarui')->nullable()->default(null);
            $table->longText('alasan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulan');
    }
}
