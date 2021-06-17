<?php

namespace App\Models\Musyawarah;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    //
    // protected $connection = 'mysql_musyawarah';
    protected $table = 'pekerjaan';
    protected $fillable = ['nama', 'deskripsi', 'status', 'id_anggota'];

    //pengelola anggota adalah anggota
    public function penanggung_jawab()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_anggota');
    }
}
