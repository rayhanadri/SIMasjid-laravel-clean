<?php

namespace App\Models\Musyawarah;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    //
    protected $connection = 'mysql_musyawarah';
    protected $table = 'komentar';
    protected $fillable = ['id_notulensi','id_anggota','keterangan'];

    //pengelola anggota adalah anggota
    public function anggota()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_anggota');
    }

    public function notulensi()
    {
        return $this->hasOne('App\Models\Musyawarah\Notulensi', 'id', 'id_notulensi');
    }
}
