<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Kategori;
use App\Models\Aset\Lokasi;
use App\Models\Anggota\Anggota;
use App\Models\Aset\Katalog;
use App\Models\Aset\Aset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class MetadataController extends Controller
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
        return view('aset.metadata_kategori', ['kategoriGroup' => $kategoriGroup, 'lokasiGroup' => $lokasiGroup, 'anggotaGroup' => $anggotaGroup]);
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
        return view('aset.metadata_lokasi', ['kategoriGroup' => $kategoriGroup, 'lokasiGroup' => $lokasiGroup, 'anggotaGroup' => $anggotaGroup]);
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
        Validator::make($request->all(), [
            'nama' => 'required',
        ])->validate();
        $lokasi = Lokasi::get()->where('id', '=', $request->id)->first();
        $lokasi->nama = $request->nama;
        $lokasi->save();

        return redirect()->back();
    }

    public function deleteLokasi(Request $request)
    {
        $lokasi = Lokasi::get()->where('id', '=', $request->id)->first();
        $lokasi->delete();

        return Redirect::back();
    }

    public function indexKatalog()
    {
        $katalogGroup = Katalog::get();
        foreach ($katalogGroup as $katalog) {
            $katalog->kategori = $katalog->kategori;
        }
        // return $katalogGroup;
        $kategoriGroup = Kategori::get();
        //data kategori
        return view('aset.metadata_katalog', ['kategoriGroup' => $kategoriGroup, 'katalogGroup' => $katalogGroup]);
    }

    //lokasi
    public function createKatalog(Request $request)
    {
        // return $request;
        //validasi
        Validator::make($request->all(), [
            'nama_barang' => 'required|unique:katalog',
            'id_kategori' => 'required',
        ])->validate();
        $katalog = new Katalog();
        $katalog->nama_barang = $request->nama_barang;
        $katalog->id_kategori = $request->id_kategori;
        $katalog->save();

        return Redirect::back();
    }

    public function updateKatalog(Request $request)
    {
        Validator::make($request->all(), [
            'nama' => 'required',
            'id_kategori' => 'required',
        ])->validate();
        $katalog = Katalog::get()->where('id', '=', $request->id)->first();
        $katalog->nama_barang = $request->nama;
        $katalog->id_kategori = $request->id_kategori;
        $katalog->save();

        $asetGroup = Aset::get()->where('id_katalog','=',$katalog->id);
        foreach ($asetGroup as $aset) {
            $aset->kode = $katalog->kategori->kode.$aset->id;
            app('App\Http\Controllers\Aset\PencatatanController')->generateQR($aset);
            $aset->save();
        }

        return redirect()->back();
    }

    public function deleteKatalog(Request $request)
    {
        $katalog = Katalog::get()->where('id', '=', $request->id)->first();
        $katalog->delete();

        return redirect()->back();
    }
}
