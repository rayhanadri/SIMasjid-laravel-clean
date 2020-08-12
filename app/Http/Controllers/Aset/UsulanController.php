<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Usulan;
use App\Models\Aset\Kategori;
use App\Models\Aset\Pengadaan;
use Illuminate\Support\Facades\Auth;

class UsulanController extends Controller
{
    //

    private function checkPermission() {
        //check permission
        $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }
    }

    public function index()
    {
        $usulanGroup = Usulan::get()->where('status', '=', 'Belum Diproses');
        $tab_active = "Belum Diproses";
        return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
    }

    public function indexDiproses()
    {
        $usulanGroup = Usulan::get()->where('status', '=', 'Diproses');
        $tab_active = "Diproses";
        return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
    }

    public function indexSelesai()
    {
        $usulanGroup = Usulan::get()->where('status', '=', 'Selesai');
        $tab_active = "Selesai";
        return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
    }

    public function indexDitolak()
    {
        $usulanGroup = Usulan::get()->where('status', '=', 'Ditolak');
        $tab_active = "Ditolak";
        return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
    }

    public function indexDibatalkan()
    {
        $usulanGroup = Usulan::get()->where('status', '=', 'Dibatalkan');
        $tab_active = "Dibatalkan";
        return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
    }

    public function createForm()
    {
        $kategoriGroup = Kategori::get();
        return view('aset.usulan_create', ['kategoriGroup' => $kategoriGroup]);
    }

    public function create(Request $request)
    {
        //cari usulan
        // return $request;
        $usulan = new Usulan;
        $usulan->nama_barang = $request->nama;
        $usulan->jumlah = $request->jumlah;
        if ($request->keterangan != null) {
            $usulan->keterangan_usulan = $request->keterangan;
        }
        $usulan->id_pengusul = Auth::user()->id;
        $usulan->status = "Belum Diproses";
        $usulan->tgl_dibuat = now();
        $usulan->tgl_diperbarui = now();
        $usulan->save();
        return redirect(route('asetUsulanIndex'));
    }

    public function proses(Request $request)
    {
        //check permission
        $this->checkPermission();

        //cari usulan
        $usulan = Usulan::get()->where('id', '=', $request->id)->first();
        $usulan->status = "Diproses";
        $usulan->tgl_diperbarui = now();
        $usulan->save();
        return redirect(route('asetUsulanIndexDiproses'));
    }

    public function selesai(Request $request)
    {
        //check permission
        $this->checkPermission();

        //cari usulan
        $usulan = Usulan::get()->where('id', '=', $request->id)->first();
        $usulan->status = "Selesai";
        $usulan->tgl_diperbarui = now();
        $usulan->save();
        return redirect(route('asetUsulanIndexSelesai'));
    }

    public function tolak(Request $request)
    {
        //check permission
        $this->checkPermission();

        $usulan = Usulan::get()->where('id', '=', $request->id)->first();
        $usulan->status = "Ditolak";
        $usulan->tgl_diperbarui = now();
        if ($request->alasan != null) {
            $usulan->alasan = $request->alasan;
        }
        $usulan->save();

        return redirect(route('asetUsulanIndexDitolak'));
    }

    public function batal(Request $request)
    {
        //check permission
        $this->checkPermission();

        $usulan = Usulan::get()->where('id', '=', $request->id)->first();
        $usulan->status = "Dibatalkan";
        $usulan->tgl_diperbarui = now();
        if ($request->alasan != null) {
            $usulan->alasan = $request->alasan;
        }
        $usulan->save();

        return redirect(route('asetUsulanIndexDibatalkan'));
    }

    public function adakan(Request $request)
    {
        //check permission
        $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }
        // return $request;
        //cari usulan
        $usulan = Usulan::get()->where('id', '=', $request->id)->first();
        $usulan->status = "Diadakan";
        $usulan->save();

        // return $request;
        $pengadaan = new Pengadaan;
        $pengadaan->nama_barang = $request->nama_barang;
        $pengadaan->jumlah = $request->jumlah;
        $pengadaan->id_kategori = $request->id_kategori;
        $pengadaan->harga_satuan = $request->harga_satuan;
        $pengadaan->id_kategori = $request->id_kategori;
        $pengadaan->id_pembuat = Auth::user()->id;
        $pengadaan->keterangan = $request->keterangan;
        $pengadaan->status =  "Berjalan";
        $pengadaan->tgl_dibuat =  now();
        $pengadaan->save();
        return redirect(route('asetUsulanIndexDiadakan'));
    }
}
