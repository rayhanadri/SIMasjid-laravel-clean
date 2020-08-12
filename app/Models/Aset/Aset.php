<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    //
    protected $table = 'aset';
    public $timestamps = false;
    protected $dates = ['tgl_pendaftaran', 'tgl_diperbarui'];

    public function riwayat_aset()
    {
        return $this->hasMany('App\Models\Aset\Riwayat_Aset', 'id_aset', 'id')->orderBy('waktu', 'desc');
    }

    public function katalog()
    {
        return $this->hasOne('App\Models\Aset\Katalog', 'id', 'id_katalog');
    }

    public function lokasi()
    {
        return $this->hasOne('App\Models\Aset\Lokasi', 'id', 'id_lokasi');
    }
}
