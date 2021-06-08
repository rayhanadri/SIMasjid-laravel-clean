<?php

namespace App\Models\Musyawarah;

use Illuminate\Database\Eloquent\Model;

class Notulensi extends Model
{
    //
    protected $connection = 'mysql_musyawarah';
    protected $table = 'notulensi';
    protected $fillable = ['judul_musyawarah', 'catatan', 'status', 'id_notulen'];

    //pengelola anggota adalah anggota
    public function notulen()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_notulen');
    }
}
