<?php

namespace App\Http\Controllers\Aset\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Master\Katalog;
use App\Models\Aset\Master\Kategori;
use App\Models\Aset\Master\PJ_Kategori;
use App\Models\Aset\Master\Lokasi;
use App\Models\Anggota\Anggota;

class MasterController extends Controller
{
    //

    public function index()
    {
        //data katalog
        $katalogGroup = Katalog::get();
        foreach ($katalogGroup as $katalog) {
            $katalog->kategori;
        }
        $kategoriGroup = Kategori::get();
        $PJKategoriGroup = PJ_Kategori::get();
        foreach ($PJKategoriGroup as $PJKategori) {
            $PJKategori->kategori;
            $PJKategori->anggota;
        }
        $lokasiGroup = Lokasi::get();
        $anggotaGroup = Anggota::get()->where('id_status', '=', 1); //status 1 = ANGGOTA AKTIF

        //data kategori
        return view('aset.master.index', ['katalogGroup' => $katalogGroup, 'kategoriGroup' => $kategoriGroup, 'PJKategoriGroup' => $PJKategoriGroup, 'lokasiGroup' => $lokasiGroup, 'anggotaGroup' => $anggotaGroup]);
    }

    //katalog
    public function createKatalog(Request $request)
    {
        $katalog = new Katalog;
        $katalog->kategori = $request->kategori;
        $katalog->nama_barang = $request->nama_barang;
        $katalog->merek = $request->merek;
        $katalog->tipe = $request->tipe;
        $katalog->save();

        $url_detail_usulan = "/aset/usulan/detail/" . $request->id;
        return redirect($url_detail_usulan);

        // return response()->json(['success'=>'Barang katalog berhasil dibuat!']);

        // $katalog = new Katalog;
        // $katalog->nama_barang = $request->nama_barang;
        // $katalog->id_kategori = $request->id_kategori;
        // $katalog->save();


    }

    public function deleteKatalog(Request $request)
    {
        $katalog = Katalog::get()->where('id', '=', $request->id)->first();

        $katalog;
        $katalog->delete();

        return redirect(route('masterIndex'));
    }

    //kategori
    public function createKategori(Request $request)
    {
        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->save();

        return redirect(route('masterIndex'));
    }

    public function deleteKategori(Request $request)
    {
        $kategori = Kategori::get()->where('id', '=', $request->id)->first();
        $kategori->delete();

        return redirect(route('masterIndex'));
    }


    //PJ kategori
    public function createPJKategori(Request $request)
    {
        $PJKategori = new PJ_Kategori;
        $PJKategori->id_anggota = $request->id_anggota;
        $PJKategori->id_kategori = $request->id_kategori;
        $PJKategori->save();

        return redirect(route('masterIndex'));
    }

    public function deletePJKategori(Request $request)
    {
        $PJKategori = PJ_Kategori::get()->where('id', '=', $request->id)->first();
        $PJKategori->delete();

        return redirect(route('masterIndex'));
    }

    //lokasi
    public function createLokasi(Request $request)
    {
        $lokasi = new Lokasi;
        $lokasi->nama = $request->nama;
        $lokasi->save();

        return redirect(route('masterIndex'));
    }

    public function deleteLokasi(Request $request)
    {
        $lokasi = Lokasi::get()->where('id', '=', $request->id)->first();
        $lokasi->delete();

        return redirect(route('masterIndex'));
    }
}
