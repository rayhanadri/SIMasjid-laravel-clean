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

class MetadataController extends Controller
{
    //
    public function index($jenis_metadata)
    {
        switch ($jenis_metadata) {
            case 'kategori':
                $kategoriGroup = Kategori::orderBy('kode', 'asc')->get();
                foreach ($kategoriGroup as $kategori) {
                    $kategori->penanggung_jawab;
                }
                $lokasiGroup = Lokasi::get();
                $anggotaGroup = Anggota::get()->where('id_status', '!=', 3);
                return view('aset.metadata_kategori', ['kategoriGroup' => $kategoriGroup, 'lokasiGroup' => $lokasiGroup, 'anggotaGroup' => $anggotaGroup]);
                break;
            case 'lokasi':
                $lokasiGroup = Lokasi::orderBy('nama', 'asc')->get();
                return view('aset.metadata_lokasi', ['lokasiGroup' => $lokasiGroup]);
                break;
            case 'katalog':
                $katalogGroup = Katalog::orderBy('nama_barang', 'asc')->get();
                foreach ($katalogGroup as $katalog) {
                    $katalog->kategori = $katalog->kategori;
                }
                $kategoriGroup = Kategori::get();
                return view('aset.metadata_katalog', ['kategoriGroup' => $kategoriGroup, 'katalogGroup' => $katalogGroup]);
                break;
            default:
                abort(404);
                break;
        }
    }

    //create
    public function create(Request $request)
    {
        switch ($request->jenis_metadata) {
            case 'kategori':
                $request->kode = strtoupper($request->kode);
                //validasi
                Validator::make($request->all(), [
                    'nama' => 'required',
                    'kode' => 'required|unique:kategori|max:4',
                ])->validate();

                $kategori = new Kategori;
                $kategori->nama = $request->nama;
                $kategori->kode = $request->kode;
                $kategori->id_pj = $request->id_pj;
                $kategori->save();

                return redirect()->back();
                break;
            case 'lokasi':
                //validasi
                Validator::make($request->all(), [
                    'nama' => 'required',
                ])->validate();
                $lokasi = new Lokasi;
                $lokasi->nama = $request->nama;
                $lokasi->save();

                return redirect()->back();
                break;
            case 'katalog':
                //validasi
                Validator::make($request->all(), [
                    'nama_barang' => 'required|unique:katalog',
                    'id_kategori' => 'required',
                ])->validate();
                $katalog = new Katalog();
                $katalog->nama_barang = $request->nama_barang;
                $katalog->id_kategori = $request->id_kategori;
                $katalog->save();

                return redirect()->back();
                break;
            default:
                return redirect()->back();
                break;
        }
    }

    //update
    public function update(Request $request)
    {
        switch ($request->jenis_metadata) {
            case 'kategori':
                //parse to
                $request->kode = strtoupper($request->kode);
                //cari kategori
                $kategori = Kategori::get()->where('id', '=', $request->id)->first();
                //validasi
                if ($request->kode != $kategori->kode) {
                    Validator::make($request->all(), [
                        'nama' => 'required',
                        'kode' => 'required|unique:kategori|max:3',
                    ])->validate();
                } else {
                    Validator::make($request->all(), [
                        'nama' => 'required',
                    ])->validate();
                }

                $kategori = Kategori::get()->where('id', '=', $request->id)->first();
                $kategori->nama = $request->nama;
                $kategori->id_pj = $request->id_pj;

                //jika kode berubah maka update semua kode aset
                if ($kategori->kode != $request->kode) {
                    $kategori->kode = $request->kode;
                    $kategori->save();

                    //update semua kode aset
                    $katalogGroup = Katalog::get()->where('id_kategori', '=', $kategori->id);
                    foreach ($katalogGroup as $katalog) {
                        $asetGroup = Aset::get()->where('id_katalog', '=', $katalog->id);
                        foreach ($asetGroup as $aset) {
                            $aset->kode = $katalog->kategori->kode . $aset->id;
                            app('App\Http\Controllers\Aset\PendaftaranController')->generateQR($aset);
                            $aset->save();
                        }
                    }
                }
                $kategori->save();

                return redirect()->back();
                break;
            case 'lokasi':
                Validator::make($request->all(), [
                    'nama' => 'required',
                ])->validate();
                $lokasi = Lokasi::get()->where('id', '=', $request->id)->first();
                $lokasi->nama = $request->nama;
                $lokasi->save();

                return redirect()->back();
                break;
            case 'katalog':
                Validator::make($request->all(), [
                    'nama' => 'required',
                    'id_kategori' => 'required',
                ])->validate();
                $katalog = Katalog::get()->where('id', '=', $request->id)->first();
                $katalog->nama_barang = $request->nama;

                //katalog berubah kategori, update semua kode barang
                if ($katalog->id_kategori != $request->id_kategori) {
                    $katalog->id_kategori = $request->id_kategori;
                    $katalog->save();

                    $asetGroup = Aset::get()->where('id_katalog', '=', $katalog->id);
                    foreach ($asetGroup as $aset) {
                        $aset->kode = $katalog->kategori->kode . $aset->id;
                        app('App\Http\Controllers\Aset\PendaftaranController')->generateQR($aset);
                        $aset->save();
                    }
                }
                $katalog->save();
                return redirect()->back();
                break;
            default:
                return redirect()->back();
                break;
        }
    }

    //update
    public function delete(Request $request)
    {
        switch ($request->jenis_metadata) {
            case 'kategori':
                $kategori = Kategori::get()->where('id', '=', $request->id)->first();
                $kategori->delete();

                return redirect()->back();
                break;
            case 'lokasi':
                $lokasi = Lokasi::get()->where('id', '=', $request->id)->first();
                $lokasi->delete();

                return redirect()->back();
                break;
            case 'katalog':
                $katalog = Katalog::get()->where('id', '=', $request->id)->first();
                $katalog->delete();

                return redirect()->back();
                break;
            default:
                return redirect()->back();
                break;
        }
    }
}
