<?php

namespace App\Models\Anggota;

use Illuminate\Database\Eloquent\Model;

class Pengelola_Aset extends Model
{
    //
    protected $table = 'pengelola_aset';

    public $timestamps = false; 

    protected $fillable = [
        'id_pengelola',
    ];

    //pengelola anggota adalah anggota
    public function anggota_pengelola()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_anggota');
    }
}
