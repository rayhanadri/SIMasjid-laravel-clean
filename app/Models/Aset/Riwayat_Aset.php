<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;

class Riwayat_Aset extends Model
{
    //
    protected $table = 'riwayat_aset';
    public $timestamps = false;
    protected $dates = ['waktu'];
}
