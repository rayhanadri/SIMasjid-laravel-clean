<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_pembuat');
            $table->integer('id_penerima');
            $table->string('jenis');
            $table->string('msg');
            $table->integer('sudah_baca');
            $table->string('icon');
            $table->string('bg');
            $table->string('link');
            $table->timestamp('tgl_dibuat')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifikasi');
    }
}
