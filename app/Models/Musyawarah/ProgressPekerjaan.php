<?php

namespace App\Models\Musyawarah;

use Illuminate\Database\Eloquent\Model;

class ProgressPekerjaan extends Model
{
    //
    protected $connection = 'mysql_musyawarah';
    protected $table = 'progress_pekerjaan';
    protected $fillable = ['keterangan', 'masukkan', 'keputusan', 'id_anggota','id_pekerjaan','id_notulensi'];

    public function pembuat_progress()
    {
        return $this->hasOne('App\Models\Anggota\Anggota', 'id', 'id_anggota');
    }

    public function pekerjaan()
    {
        return $this->hasOne('App\Models\Musyawarah\Pekerjaan', 'id', 'id_pekerjaan');
    }
}
