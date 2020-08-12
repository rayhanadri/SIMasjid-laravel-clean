<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lokasi;
use App\Pengelola_Aset;
use Auth;

class LokasiController extends Controller
{
    //
    public function index(){
        //list pengelola
        $obj_list_pengelola = Pengelola_Aset::get();
        $arr_list_pengelola = [];
        foreach ($obj_list_pengelola as $pengelola) {
            $arr_list_pengelola[] = $pengelola->id_anggota;
        }

        //list lokasi
        $list_lokasi = Lokasi::get();

        //anggota terotentikasi
        $anggota = Auth::user();

        return view('aset.lokasi', ['list_lokasi' => $list_lokasi, 'list_pengelola' => $arr_list_pengelola, 'anggota' => $anggota]);
    }
}
