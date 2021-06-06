<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotulensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_musyawarah')->create('notulensi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_notulen')->nullable();
            // $table->foreign('id_notulen')->references('id')->on('SIMASINA.anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul_musyawarah')->nullable();
            $table->longText('catatan')->nullable();
            $table->enum('status',['Menunggu Persetujuan','Ditolak','Dikunci'])->default('Menunggu Persetujuan');;
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
        Schema::dropIfExists('notulensi');
    }
}
