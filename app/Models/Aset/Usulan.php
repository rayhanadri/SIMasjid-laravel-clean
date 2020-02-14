<?php

namespace App\Models\Aset\Usulan;

use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    //
    protected $table = 'pengadaan';
    public $timestamps = false;

    public function pembuat()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pembuat_usulan');
    }

    public function pembuat_keputusan()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pembuat_keputusan_usulan');
    }
}
