<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    //
    protected $table = 'aset';
    public $timestamps = false;
    protected $dates = ['tgl_pencatatan'];

    public function riwayat_aset()
    {
        return $this->hasMany('App\Models\Aset\Riwayat_Aset', 'id_aset', 'id');
    }

    public function lokasi()
    {
        return $this->hasOne('App\Models\Aset\Lokasi', 'id', 'id_lokasi');
    }

    public function kategori()
    {
        return $this->hasOne('App\Models\Aset\Kategori', 'id', 'id_kategori');
    }
}
