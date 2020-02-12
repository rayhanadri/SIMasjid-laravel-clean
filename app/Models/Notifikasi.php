<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    //
    protected $table = 'notifikasi';
    public $timestamps = false;
    protected $dates = ['tgl_dibuat'];
    protected $fillable = ['id_pembuat', 'id_penerima', 'jenis', 'msg', 'sudah_baca', 'icon', 'bg', 'link'];

    public function pembuat()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pembuat');
    }
}
