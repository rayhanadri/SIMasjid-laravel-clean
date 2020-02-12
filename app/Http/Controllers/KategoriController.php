<?php

namespace App\Http\Controllers;

use App\Models\Anggota\Pengelola_Aset;
use App\PJ_Kategori;
use App\Kategori;
use Auth;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        //list pengelola
        $obj_list_pengelola = Pengelola_Aset::get();
        $arr_list_pengelola = [];
        foreach ($obj_list_pengelola as $pengelola) {
            $arr_list_pengelola[] = $pengelola->id_anggota;
        }
        $list_kategori = Kategori::get();
        foreach ($list_kategori as $kategori) {
            $kategori->list_pj_kategori;
            foreach ($kategori->list_pj_kategori as $pj_kategori) {
                $pj_kategori->anggota_pj_kategori;
            }
        }

        //user terotentikasi
        $anggota = Auth::user();

        return view('aset.kategori', ['list_kategori' => $list_kategori, 'list_pengelola' => $arr_list_pengelola, 'anggota' => $anggota]);
    }

    public function get(Request $request)
    {
        $kategori = Kategori::get()->where('id', '=', $request->id);
        return $kategori;
    }

    public function list()
    {
        $kategori = Kategori::get();
        return $kategori;
    }
}
