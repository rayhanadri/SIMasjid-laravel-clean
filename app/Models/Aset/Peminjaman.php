<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    //
    protected $table = 'peminjaman';
    public $timestamps = false; 
    protected $dates = ['tgl_dibuat', 'tgl_selesai'];

    public function barang()
    {
        return $this->hasOne('App\Models\Aset\Aset', 'id', 'id_aset');
    }
    public function pembuat()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pembuat');
    }
}
