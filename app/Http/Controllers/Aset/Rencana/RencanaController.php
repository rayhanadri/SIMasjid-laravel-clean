<?php

namespace App\Http\Controllers\Aset\Rencana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Master\Katalog;
use App\Models\Aset\Master\Kategori;
use App\Models\Aset\Rencana\Rencana;
use App\Models\Aset\Usulan\Usulan;
use Auth;
// use Illuminate\Validation\ValidationException;

class RencanaController extends Controller
{
    //
    public function index()
    {
        $rencanaGroup = Rencana::get();
        // foreach ($rencanaGroup as $rencana) {
        //     $rencana->pengelola;
        //     $rencana->barang_rencana;
        //     $rencana->pengadaan;
        // }

        // return $rencanaGroup;
        return view('aset.rencana.index', ['rencanaGroup' => $rencanaGroup]);
    }

    public function create(Request $request)
    {
        $id_usulan = $request->id;
        //get Usulan
        $usulan = Usulan::get()->where('id', '=', $id_usulan)->first();
        $usulan->status = "Sudah Direncanakan";
        $usulan->save();
        // //create rencana
        $rencana = new Rencana;
        $rencana->id_barang_usulan = $request->id;
        $rencana->id_katalog = $request->katalog;
        $rencana->fase = "RENCANA";
        $rencana->status = "Menunggu Anggaran";
        $rencana->jumlah = $usulan->jumlah;
        $rencana->harga_rencana = $request->harga;
        $rencana->keterangan = $usulan->keterangan;
        $rencana->tgl_rencana_dibuat = now();
        $rencana->save();

        return $rencana;
        // return redirect('/aset/rencana/detail/' . $rencana->id);
    }

    public function detail($id)
    {
        $rencana = Rencana::get()->where('id', '=', $id)->first();
        // return $rencana;
        return view('aset.rencana.detail', ['rencana' => $rencana]);
    }

    public function selectKatalog($id)
    {
        //katalog untuk dipilih
        $katalogGroup = Katalog::get()->where('id_kategori', '=', $id);
        return ($katalogGroup);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $rencana = Rencana::get()->where('id', '=', $id)->first();
        $rencana->status = 'Dianggarkan';
        $rencana->id_pengelola_update = Auth::user()->id; //save data user yg mengubah data usulan
        $rencana->updated_at = now(); //save waktu data usulan diubah
        // return $request;

        //url detail rencana
        $url_detail_rencana = "/aset/rencana/detail/" . $id;

        //validasi barang sbg request untuk mengetahui apakah 
        //masih ada yg belum dimasukkan katalog atau belum masuk harganya
        $rencana->barang_rencana;
        foreach ($rencana->barang_rencana as $barang_rencana) {
            $request_barang = new Request([
                'id_katalog' => $barang_rencana->id_katalog,
                'harga' => $barang_rencana->harga
            ]);
            $this->validate($request_barang, [
                'id_katalog' => 'required',
                'harga' => 'required'
            ]);
        }
        $rencana->save();

        $url_detail_rencana = "/aset/rencana/detail/" . $id;
        return redirect($url_detail_rencana);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $usulan = Usulan::get()->where('id', '=', $id)->first();
        $usulan->nama_usulan = $request->nama_usulan;
        $usulan->id_pengelola = Auth::user()->id; //save data user yg mengubah data usulan
        $usulan->updated_at = now(); //save waktu data usulan diubah
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
