<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomentarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_notulensi')->nullable();
            // $table->foreign('id_notulensi')->references('id')->on('notulensi')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_anggota')->nullable();
            // $table->foreign('id_anggota')->references('id')->on('SIMASINA.anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('komentar');
    }
}
