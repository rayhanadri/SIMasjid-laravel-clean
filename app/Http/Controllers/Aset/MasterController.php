<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Kategori;
use App\Models\Aset\Lokasi;
use App\Models\Anggota\Anggota;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class MasterController extends Controller
{
    //

    public function indexKategori()
    {
        $kategoriGroup = Kategori::get();
        foreach ($kategoriGroup as $kategori) {
            $kategori->penanggung_jawab;
        }
        $lokasiGroup = Lokasi::get();
        $anggotaGroup = Anggota::get()->where('id_status', '!=', 3);
        //data kategori
        return view('aset.master_kategori', ['kategoriGroup' => $kategoriGroup, 'lokasiGroup' => $lokasiGroup, 'anggotaGroup' => $anggotaGroup]);
    }

    //kategori
    public function createKategori(Request $request)
    {
        $request->kode = strtoupper($request->kode);
        //validasi
        Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required|unique:kategori|size:4',
        ])->validate();

        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->kode = $request->kode;
        $kategori->id_pj = $request->id_pj;
        $kategori->save();

        return Redirect::back();
    }

    //kategori update
    public function updateKategori(Request $request)
    {
        //parse to
        $request->kode = strtoupper($request->kode);
        //cari kategori
        $kategori = Kategori::get()->where('id', '=', $request->id)->first();
        //validasi
        if ($request->kode != $kategori->kode) {
            Validator::make($request->all(), [
                'nama' => 'required',
                'kode' => 'required|unique:kategori|size:4',
            ])->validate();
        } else {
            Validator::make($request->all(), [
                'nama' => 'required',
            ])->validate();
        }

        $kategori = Kategori::get()->where('id', '=', $request->id)->first();
        $kategori->nama = $request->nama;
        $kategori->kode = $request->kode;
        $kategori->id_pj = $request->id_pj;
        $kategori->save();

        return Redirect::back();
    }

    public function deleteKategori(Request $request)
    {
        $kategori = Kategori::get()->where('id', '=', $request->id)->first();
        $kategori->delete();

        return Redirect::back();
    }

    public function indexLokasi()
    {
        $kategoriGroup = Kategori::get();
        foreach ($kategoriGroup as $kategori) {
            $kategori->penanggung_jawab;
        }
        $lokasiGroup = Lokasi::get();
        $anggotaGroup = Anggota::get()->where('id_status', '!=', 3);
        //data kategori
        return view('aset.master_lokasi', ['kategoriGroup' => $kategoriGroup, 'lokasiGroup' => $lokasiGroup, 'anggotaGroup' => $anggotaGroup]);
    }

    //lokasi
    public function createLokasi(Request $request)
    {
        //validasi
        Validator::make($request->all(), [
            'nama' => 'required',
        ])->validate();
        $lokasi = new Lokasi;
        $lokasi->nama = $request->nama;
        $lokasi->save();

        return Redirect::back();
    }

    //lokasi update
    public function updateLokasi(Request $request)
    {
        //parse to
        $request->kode = strtoupper($request->kode);
        //cari kategori
        $kategori = Kategori::get()->where('id', '=', $request->id)->first();
        //validasi
        if ($request->kode != $kategori->kode) {
            Validator::make($request->all(), [
                'nama' => 'required',
            ])->validate();
        } else {
            Validator::make($request->all(), [
                'nama' => 'required',
            ])->validate();
        }
        $kategori->nama = $request->nama;
        $kategori->kode = $request->kode;
        $kategori->id_pj = $request->id_pj;
        $kategori->save();

        return Redirect::back();
    }

    public function deleteLokasi(Request $request)
    {
        $lokasi = Lokasi::get()->where('id', '=', $request->id)->first();
        $lokasi->delete();

        return Redirect::back();
    }
}
