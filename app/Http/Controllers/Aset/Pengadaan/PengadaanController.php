<?php

namespace App\Http\Controllers\Aset\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Pengadaan\Pengadaan;
use App\Models\Aset\Pengadaan\Riwayat_Pengadaan;
use Auth;
use Illuminate\Validation\Rule;

class PengadaanController extends Controller
{
    //INDEX
    public function index()
    {
        $pengadaanGroup = Pengadaan::get()->where('fase', '=', 'PENGADAAN');
        $rencanaGroup = Rencana::get()->where('fase', '=', 'RENCANA');
        $usulanGroup = Usulan::get()->where('fase', '=', 'USULAN');

        // return $pengadaanGroup;
        return view('aset.pengadaan.index', ['pengadaanGroup' => $pengadaanGroup, 'rencanaGroup' => $rencanaGroup, 'usulanGroup' => $usulanGroup]);
    }

    //FORM USULAN
    public function createForm()
    {
        return view('aset.pengadaan.create_form');
    }

    //BUAT USULAN
    public function create(Request $request)
    {
        $usulan = new Usulan;
        $usulan->fase = 'USULAN';
        $usulan->nama_barang = $request->nama_barang;
        $usulan->id_pembuat_usulan = Auth::user()->id;
        $usulan->jumlah = $request->jumlah;
        $usulan->keterangan = $request->keterangan;
        $usulan->status = "Menunggu Persetujuan";
        $usulan->save();

        $url_detail_usulan = "/aset/pengadaan/usulan/detail/" . $usulan->id;
        return redirect($url_detail_usulan);
    }

    public function detail_usulan($id)
    {
        // $katalog = Katalog::get();
        $usulan = Usulan::get()->where('id', '=', $id)->first();

        return view('aset.pengadaan.detail_usulan', ['usulan' => $usulan]);
    }

    public function detail_pengadaan($id)
    {
        $pengadaan = Pengadaan::get()->where('id', '=', $id)->first();
        $pengadaan->rencana;
        $pengadaan->pengelola;
        $pengadaan->petugas;
        $pengadaan->barang_pengadaan;

        // return $pengadaan;
        foreach ($pengadaan->barang_pengadaan as $barang_pengadaan) {
            $barang_pengadaan->katalog;
        }

        // return $pengadaan;
        return view('aset.pengadaan.detail', ['pengadaan' => $pengadaan]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $pengadaan = Pengadaan::get()->where('id', '=', $id)->first();
        $pengadaan->status = 'Terlaksana';
        $pengadaan->id_pengelola_update = Auth::user()->id; //save data user yg mengubah data usulan
        $pengadaan->updated_at = now(); //save waktu data usulan diubah
        // return $request;

        //url detail rencana
        // $url_detail_rencana = "/aset/rencana/detail/" . $id;

        //validasi barang sbg request untuk mengetahui apakah 
        //masih ada yg belum dimasukkan katalog atau belum masuk harganya
        $pengadaan->barang_pengadaan;
        foreach ($pengadaan->barang_pengadaan as $barang_pengadaan) {
            $request_barang = new Request([
                'id_katalog' => $barang_pengadaan->id_katalog,
                'harga' => $barang_pengadaan->harga,
                'status' => $barang_pengadaan->status,
                'foto nota' => $barang_pengadaan->link_foto_nota
            ]);
            $this->validate($request_barang, [
                'id_katalog' => 'required',
                'harga' => 'required',
                'status' => ['required', Rule::in(['Terlaksana', 'Gagal'])],
                'foto nota' => 'required'
            ]);
        }
        return $barang_pengadaan;
        $barang_pengadaan->save();

        $url_detail_pengadaan = "/aset/pengadaan/detail/" . $id;
        return redirect($url_detail_pengadaan);
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

    // public function delete(Request $request)
    // {
    //     $id = $request->id;
    //     //delete semua barang di dalam usulan
    //     $barangUsulanGroup = Barang_Usulan::get()->where('id_usulan', '=', $id);
    //     if (!empty($barangUsulanGroup)) {
    //         foreach ($barangUsulanGroup as $barangUsulan) {
    //             $barangUsulan->delete();
    //         }
    //     }
    //     //delete usulan;
    //     $usulan = Usulan::get()->where('id', '=', $id)->first();
    //     $usulan->delete();

    //     return redirect(route('usulanTerdaftar'));
    // }
}
