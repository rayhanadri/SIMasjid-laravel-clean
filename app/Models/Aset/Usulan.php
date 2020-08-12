<?php

<<<<<<< HEAD
namespace App\Models\Aset;
=======
namespace App\Models\Aset\Usulan;
>>>>>>> first commit

use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    //
<<<<<<< HEAD
    protected $table = 'usulan';
    public $timestamps = false;
    protected $dates = ['tgl_dibuat', 'tgl_diperbarui'];

    public function pengusul()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pengusul');
=======
    protected $table = 'pengadaan';
    public $timestamps = false;

    public function pembuat()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pembuat_usulan');
    }

    public function pembuat_keputusan()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_pembuat_keputusan_usulan');
>>>>>>> first commit
    }
}
