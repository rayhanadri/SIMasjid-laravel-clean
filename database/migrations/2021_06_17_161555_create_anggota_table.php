<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_jabatan');
            $table->integer('id_status');
            $table->string('username');
            $table->string('password');
            $table->string('nama');
            $table->string('alamat');
            $table->string('telp');
            $table->string('email');
            $table->string('link_foto')->default("public/dist/assets/img/avatar/avatar-1.png");
            $table->string('remember_token')->default(null);
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
        Schema::dropIfExists('anggota');
    }
}
