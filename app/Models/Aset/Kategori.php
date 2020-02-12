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
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pj');
    }
    
}
