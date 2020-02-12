<?php

namespace App\Models\Aset\Pengadaan;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    //
    protected $table = 'pengadaan';
    public $timestamps = false;

    public function riwayat()
    {
        return $this->hasMany('App\Models\Aset\Riwayat_Pengadaan', 'id_pengadaan', 'id');
    }
     
}
