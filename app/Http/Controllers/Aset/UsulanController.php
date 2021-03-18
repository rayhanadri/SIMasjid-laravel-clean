<?php

namespace App\Http\Controllers\Aset;

use App\Http\Controllers\Controller;
use App\Models\Aset\Kategori;
use App\Models\Aset\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsulanController extends Controller
{
    //

    private function checkPermission()
    {
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

    public function indexByStatus($status)
    {
        switch ($status) {
            case 'diproses':
                $usulanGroup = Usulan::get()->where('status', '=', 'Diproses');
                $tab_active = "Diproses";
                return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
                break;
            case 'selesai':
                $usulanGroup = Usulan::get()->where('status', '=', 'Selesai');
                $tab_active = "Selesai";
                return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
                break;
            case 'ditolak':
                $usulanGroup = Usulan::get()->where('status', '=', 'Ditolak');
                $tab_active = "Ditolak";
                return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
                break;
            case 'dibatalkan':
                $usulanGroup = Usulan::get()->where('status', '=', 'Dibatalkan');
                $tab_active = "Dibatalkan";
                return view('aset.usulan_index', ['usulanGroup' => $usulanGroup, "tab_active" => $tab_active]);
                break;
            default:
                abort(404);
                break;
        }

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
        $url = route('home').'/aset/usulan/status/diproses';
        return redirect($url);
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
        $url = route('home').'/aset/usulan/status/selesai';
        return redirect($url);
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

        $url = route('home').'/aset/usulan/status/ditolak';
        return redirect($url);
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

        $url = route('home').'/aset/usulan/status/dibatalkan';
        return redirect($url);
    }
}
