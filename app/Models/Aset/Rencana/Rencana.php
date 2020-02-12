<?php

namespace App\Models\Aset\Rencana;

use Illuminate\Database\Eloquent\Model;

class Rencana extends Model
{
    //
    protected $table = 'pengadaan';
    public $timestamps = false;

     //usulan terdapat anggota pengelola aset yg update usulannya
     public function katalog()
     {
         return $this->hasOne('App\Models\Aset\Master\Katalog', 'id', 'id_katalog');
     }

     public function perencana()
     {
         return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_perencana');
     }

     public function usulan()
     {
         return $this->hasOne('App\Models\Aset\Usulan\Usulan', 'id', 'id_usulan');
     }
     
}
