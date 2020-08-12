<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    //
    protected $table = 'katalog';
    public $timestamps = false;
    
    public function kategori()
    {
        return $this->hasOne('App\Models\Aset\Kategori', 'id', 'id_kategori');
    }
}
