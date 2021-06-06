<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_musyawarah')->create('pekerjaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_anggota')->nullable();
            // $table->foreign('id_anggota')->references('id')->on('SIMASINA.anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->enum('status',['Menunggu Persetujuan','Ditolak','Proses','Batal','Selesai'])->default('Menunggu Persetujuan');;
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
        Schema::dropIfExists('pekerjaan');
    }
}
