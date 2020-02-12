<?php

namespace App\Http\Controllers\Aset\Usulan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Usulan\Barang_Usulan;
use App\Models\Aset\Usulan\Usulan;
use Auth;

class BarangUsulanController extends Controller
{
    //
    public function create(Request $request)
    {
        $id_usulan = $request->id_usulan;
        // update usulan
        $usulan = Usulan::get()->where( 'id', '=', $id_usulan )->first();
        $usulan->id_pengelola = Auth::user()->id; //save data user yg mengubah data usulan
        $usulan->updated_at = now(); //save waktu data usulan diubah
        $usulan->save();

        //tambah barang usulan
        $barang_usulan = new Barang_Usulan;
        $barang_usulan->id_usulan = $request->id_usulan;
        $barang_usulan->nama_barang = $request->nama_barang;
        $barang_usulan->jumlah = $request->jumlah;
        $barang_usulan->save();

        //redirect
        $url_detail_usulan = "/aset/usulan/detail/" . $id_usulan;
        return redirect($url_detail_usulan);
    }

    public function delete(Request $request)
    {
        $id_usulan = $request->id_usulan;
        // update usulan
        $usulan = Usulan::get()->where( 'id', '=', $id_usulan )->first();
        $usulan->id_pengelola = Auth::user()->id; //save data user yg mengubah data usulan
        $usulan->updated_at = now(); //save waktu data usulan diubah
        $usulan->save();

        //hapus barang usulan
        $barang_usulan = Barang_Usulan::get()->where('id', '=', $request->id)->first();
        $barang_usulan->delete();

        //redirect
        $url_detail_usulan = "/aset/usulan/detail/" . $id_usulan;
        return redirect($url_detail_usulan);
    }
}
