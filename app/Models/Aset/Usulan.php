<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    //
    protected $table = 'usulan';
    public $timestamps = false;
    protected $dates = ['tgl_dibuat', 'tgl_diperbarui'];

    public function pengusul()
    {
        return $this->belongsTo('App\Models\Anggota\Anggota', 'id_pengusul', 'id');
    }
}
