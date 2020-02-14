<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Riwayat_Aset extends Model
{
    //
    protected $table = 'riwayat_aset';
    public $timestamps = false;
    protected $dates = ['waktu'];

    public function oleh_anggota()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_oleh_anggota');
    }
}
