<?php

namespace App\Http\Controllers\Aset\Usulan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Usulan\Usulan;
use App\Models\Aset\Master\Katalog;
use Auth;
use Carbon\Carbon;

class UsulanController extends Controller
{
    //
    public function index()
    {
        $usulanGroup = Usulan::get();
        foreach ($usulanGroup as $usulan) {
            $usulan->pembuat;
        }
        return view('aset.usulan.index', ['usulanGroup' => $usulanGroup]);
    }

    public function createForm()
    {
        return view('aset.usulan.create_form');
    }

    public function create(Request $request)
    {
        $usulan = new Usulan;
        $usulan->nama_barang = $request->nama_barang;
        $usulan->id_pembuat = Auth::user()->id;
        $usulan->jumlah = $request->jumlah;
        $usulan->keterangan = $request->keterangan;
        $usulan->status = "Menunggu Persetujuan";
        $usulan->tgl_usulan_dibuat = now();
        $usulan->save();

        $url_detail_usulan = "/aset/usulan/detail/" . $usulan->id;
        return redirect($url_detail_usulan);
    }



    public function detail($id)
    {
        $katalog = Katalog::get();
        $usulan = Usulan::get()->where('id', '=', $id)->first();
        $usulan->tgl_usulan_dibuat = Carbon::parse($usulan->tgl_usulan_dibuat)->isoFormat('LLLL');
        $usulan->pembuat;
        if ($usulan->tgl_usulan_diperbarui != NULL) {
            $usulan->tgl_usulan_diperbarui = Carbon::parse($usulan->tgl_usulan_diperbarui)->isoFormat('LLLL');
        } else {
            $usulan->tgl_usulan_diperbarui = '-';
        }
        if ($usulan->tgl_usulan_diputuskan != NULL) {
            $usulan->tgl_usulan_diputuskan = Carbon::parse($usulan->tgl_usulan_diputuskan)->isoFormat('LLLL');
        } else {
            $usulan->tgl_usulan_diputuskan = '-';
        }

        return view('aset.usulan.detail', ['usulan' => $usulan, 'katalog' => $katalog]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $usulan = Usulan::get()->where('id', '=', $id)->first();
        $usulan->status = $request->status;
        $usulan->tgl_usulan_diputuskan = now(); //save waktu data usulan diubah
        $usulan->save();

        $url_detail_usulan = "/aset/usulan/detail/" . $id;
        return redirect($url_detail_usulan);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $usulan = Usulan::get()->where('id', '=', $id)->first();
        $usulan->nama_barang = $request->nama_barang;
        $usulan->jumlah = $request->jumlah;
        $usulan->keterangan = $request->keterangan;
        $usulan->tgl_usulan_diperbarui = now(); //save waktu data usulan diubah
        $usulan->save();
        $url_detail_usulan = "/aset/usulan/detail/" . $id;
        return redirect($url_detail_usulan);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        //delete semua barang di dalam usulan
        $barangUsulanGroup = Barang_Usulan::get()->where('id_usulan', '=', $id);
        if (!empty($barangUsulanGroup)) {
            foreach ($barangUsulanGroup as $barangUsulan) {
                $barangUsulan->delete();
            }
        }
        //delete usulan;
        $usulan = Usulan::get()->where('id', '=', $id)->first();
        $usulan->delete();

        return redirect(route('usulanTerdaftar'));
    }
}
