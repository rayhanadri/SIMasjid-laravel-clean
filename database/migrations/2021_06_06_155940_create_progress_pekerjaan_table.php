<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressPekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_pekerjaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_notulensi')->nullable();
            // $table->foreign('id_notulensi')->references('id')->on('notulensi')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_pekerjaan')->nullable();
            // $table->foreign('id_pekerjaan')->references('id')->on('pekerjaan')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_anggota')->nullable();
            $table->longText('keterangan')->nullable();
            $table->longText('masukkan')->nullable();
            $table->longText('keputusan')->nullable();
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
        Schema::dropIfExists('progress_pekerjaan');
    }
}
