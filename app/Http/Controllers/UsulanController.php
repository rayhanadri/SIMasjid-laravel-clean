<?php

namespace App\Http\Controllers;

use App\Usulan;
use App\Pengelola_Aset;
use App\Kategori;
use App\Anggota;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsulanController extends Controller
{
    public function index()
    {
        //list pengelola
        $obj_list_pengelola = Pengelola_Aset::get();
        $arr_list_pengelola = [];
        foreach ($obj_list_pengelola as $pengelola) {
            $arr_list_pengelola[] = $pengelola->id_anggota;
        }
        //tambahkan jenis aset dan kategori ke list
        $list_usulan = Usulan::get()->sortByDesc('created_at');
        foreach ($list_usulan as $usulan) {
            $usulan->katalog;
            $usulan->pengusul;
            $usulan->pengelola;
            $usulan->pembelian;
        }

        //user terotentikasi
        $anggota = Auth::user();

        //list_kategori
        $list_kategori = Kategori::get();

        //retval
        return view('aset.usulan.usulan', ['list_usulan' => $list_usulan, 'list_kategori' => $list_kategori, 'list_pengelola' => $arr_list_pengelola, 'anggota' => $anggota]);
    }

    public function create(Request $request)
    {
        $usulan = new Usulan;
        $usulan->id_pengusul = $request->id_pengusul;
        $usulan->jenis_usulan = $request->jenis_usulan;
        if ($request->jenis_usulan == "Katalog") {
            $usulan->id_katalog = $request->pilihKatalog;
        } else {
            $usulan->nama = $request->nama;
        }
        $usulan->jumlah = $request->jumlah;
        $usulan->harga_usulan = $request->harga;
        $usulan->status_usulan = "Menunggu Keputusan";
        $usulan->created_at = now();
        $usulan->updated_at = now();
        if ( !empty($request->keterangan) ) {
            $usulan->keterangan = $request->keterangan;
        }
        // return $usulan;
        $usulan->save();
        return redirect(route('usulanTerdaftar').'/detail/'.$usulan->id);
    }

    public function update(Request $request)
    {
        $usulan = Usulan::get()->where("id", '=', $request->id)->first();
        $usulan->id_pengelola = $request->id_pengelola;
        $usulan->status_usulan = $request->status_usulan;
        $usulan->updated_at = now();
        $usulan->save();
        return redirect(route('usulanTerdaftar').'/detail/'.$usulan->id);
    }
    public function edit(Request $request)
    {
        $usulan = Usulan::get()->where("id", '=', $request->id)->first();
        // return $request;
        $usulan->id_pengelola = $request->id_pengelola;
        if ( !empty($request->nama) ) {
            $usulan->nama = $request->nama;
        }
        $usulan->jumlah = $request->jumlah;
        $usulan->harga_usulan = $request->harga;
        $usulan->updated_at = now();
        $usulan->save();
        
        return redirect(route('usulanTerdaftar').'/detail/'.$usulan->id);
    }

    public function delete(Request $request)
    {
        $usulan = Usulan::get()->where("id", '=', $request->id)->first();
        $usulan->delete();
        return redirect(route('usulanTerdaftar'));
    }

    public function getDetail($id)
    {
        //list pengelola
        $obj_list_pengelola = Pengelola_Aset::get();
        $arr_list_pengelola = [];
        foreach ($obj_list_pengelola as $pengelola) {
            $arr_list_pengelola[] = $pengelola->id_anggota;
        }
        $detail_usulan = Usulan::get()->where('id', '=', $id)->first();
        if ($detail_usulan->jenis_usulan == "Katalog") {
            $detail_usulan->katalog;
            $detail_usulan->katalog->kategori;
        }
        $detail_usulan->pengusul;
        $detail_usulan->pengelola;
        $detail_usulan->pembelian;
        Carbon::setLocale('id'); // set locale Carbon (PHP DateTime Extension) 
        $detail_usulan->dibuat = $detail_usulan->created_at->isoFormat('LLLL');
        $detail_usulan->diperbarui = $detail_usulan->created_at->isoFormat('LLLL');

        //user terotentikasi
        $anggota = Auth::user();

        //list user aktif
        $list_anggota = Anggota::get()->where('id_status', '=', 1);

        //retval
        return view('aset.usulan.detail_usulan', ['detail_usulan' => $detail_usulan, 'list_anggota' => $list_anggota, 'list_pengelola' => $arr_list_pengelola, 'anggota' => $anggota]);
    }

    public function getView($id)
    {
        $view_usulan = Usulan::get()->where('id', '=', $id)->first();
        if ($view_usulan->jenis_usulan == "Katalog") {
            $view_usulan->katalog;
            $view_usulan->katalog->kategori;
        }
        $view_usulan->pengusul;
        $view_usulan->pengelola;
        $view_usulan->pembelian;
        Carbon::setLocale('id');    // set locale Carbon (PHP DateTime Extension) 
        $view_usulan->dibuat = $view_usulan->created_at->isoFormat('LLLL');
        $view_usulan->diperbarui = $view_usulan->created_at->isoFormat('LLLL');
        return $view_usulan;
    }
}
