<?php

namespace App\Http\Controllers\aset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PelepasanController extends Controller
{
    public function createForm()
    {
        $asetGroup = Aset::get()->where('status', '=', 'Tersedia');
        return view('aset.pelepasan_create', ['asetGroup' => $asetGroup]);
    }
}
