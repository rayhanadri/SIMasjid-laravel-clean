<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatAsetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_aset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status_awal');
            $table->string('status_akhir');
            $table->timestamp('waktu')->nullable()->default(null);;
            $table->longText('keterangan');
            $table->integer('id_aset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_aset');
    }
}
