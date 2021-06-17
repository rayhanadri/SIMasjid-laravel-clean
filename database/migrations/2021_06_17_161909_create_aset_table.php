<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_lokasi');
            $table->integer('id_katalog');
            $table->string('kode');
            $table->string('sumber');
            $table->string('merek');
            $table->string('tipe');
            $table->string('status');
            $table->string('link_qr');
            $table->string('link_foto_barang');
            $table->double('harga_satuan');
            $table->longText('keterangan');
            $table->timestamp('tgl_pendaftaran')->nullable()->default(null);;
            $table->timestamp('tgl_diperbarui')->nullable()->default(null);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aset');
    }
}
