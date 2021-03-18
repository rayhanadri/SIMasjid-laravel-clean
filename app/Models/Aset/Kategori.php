<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = 'kategori';
    public $timestamps = false; 

    public function penanggung_jawab()
    {
        return $this->belongsTo('App\Models\Anggota\Anggota', 'id_pj', 'id');
    }
    
}
