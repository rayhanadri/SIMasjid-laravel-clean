<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Usulan;
use App\Pengelola_Aset;
use App\Anggota;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    //
    public function index()
    {
        //list pengelola
        $obj_list_pengelola = Pengelola_Aset::get();
        $arr_list_pengelola = [];
        foreach ($obj_list_pengelola as $pengelola) {
            $arr_list_pengelola[] = $pengelola->id_anggota;
        }

        //list anggota aktif untuk ditunjuk sebagai petugas pembelian
        $list_anggota = Anggota::get()->where('id_status', '=', 1);

        //tambahkan jenis aset dan kategori ke list
        $list_pembelian = Pembelian::get()->sortByDesc('created_at');

        //transform kode jenis aset ke string
        foreach ($list_pembelian as $pembelian) {
            $pembelian->usulan;
            $pembelian->petugas;
            $pembelian->pengelola;
            $pembelian->usulan;
            if ($pembelian->usulan->jenis_usulan == "Katalog") {
                $pembelian->usulan->katalog;
                $pembelian->usulan->katalog->kategori;
            }
        }

        //user terotentikasi
        $anggota = Auth::user();

        // return $list_pembelian;
        //retval
        return view('aset.pembelian', ['list_anggota' => $list_anggota, 'list_pembelian' => $list_pembelian, 'list_pengelola' => $arr_list_pengelola, 'anggota' => $anggota]);
    }

    public function create(Request $request)
    {
        $pembelian = new Pembelian;
        $pembelian->id_usulan = $request->id_usulan;
        $pembelian->id_pengelola = $request->id_pengelola;
        $pembelian->id_petugas = $request->id_petugas;
        $pembelian->keterangan = $request->keterangan;
        $usulan = Usulan::get()->where('id', '=', $request->id_usulan)->first();
        $pembelian->harga_pembelian = $usulan->harga_usulan;
        $pembelian->status_pembelian = "Dalam Proses";
        $pembelian->created_at = now();
        $pembelian->updated_at = now();
        $pembelian->save();
        return redirect(route('pembelianTerdaftar'));
    }

    public function update(Request $request)
    {
        $pembelian = Pembelian::get()->where("id", '=', $request->pembelianId)->first();
        $pembelian->jumlah = $request->updateJumlah;
        $pembelian->harga = $request->updateHarga;
        $pembelian->penjual = $request->updatePenjual;
        $pembelian->telp_penjual = $request->updateTelpPenjual;
        $pembelian->updated_at = now();
        //jika nota diisi
        if (!empty($request->file('file'))) {
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
            // validasi jenis file
            $allowed_files = ['jpeg', 'gif', 'png', 'jpg', 'bmp'];
            $inside_allowed = in_array($file->getClientOriginalExtension(), $allowed_files);
            if (!$inside_allowed) {
                throw ValidationException::withMessages([
                    'file' => "Format file gambar yang diperbolehkan yaitu JPEG, JPG, GIF, PNG, dan BMP",
                ]);
            }
            // $request->validate([
            //     'file' => 'image|mimes:gif,jpeg,png,jpg,bmp|max:2048'
            // ]);
            // tujuan folder upload
            $tujuan_upload = 'foto_nota';
            //format nama file sesuai dengan id pembelian
            //kemudian simpan linknya
            $filebaru = $pembelian->id . '.' . $file->getClientOriginalExtension();
            $file->move($tujuan_upload, $filebaru);
            //save link
            $pembelian->link_foto_nota = $tujuan_upload . '/' . $filebaru;
        }
        //save semua attribut
        $pembelian->save();
        return redirect(route('pembelianTerdaftar'));
    }

    public function edit(Request $request)
    {
        // return $request;
        $pembelian = Pembelian::get()->where("id", '=', $request->pembelianId)->first();
        $pembelian->nama = $request->editNama;
        $pembelian->id_jenis = $request->editJenis;
        $pembelian->id_kategori = $request->editKategori;
        $pembelian->status_pembelian = $request->editStatus;
        $pembelian->jumlah = $request->editJumlah;
        $pembelian->harga = $request->editHarga;
        $pembelian->id_petugas = $request->editPetugas;
        if (!empty($pembelian->penjual)) {
            $pembelian->penjual = $request->updatePenjual;
        }
        if (!empty($pembelian->telp_penjual)) {
            $pembelian->telp_penjual = $request->updateTelpPenjual;
        }
        $pembelian->updated_at = now();

        //jika nota diisi
        if (!empty($request->file('file'))) {

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');
            // validasi jenis file
            $request->validate([
                'file' => 'image|mimes:gif,jpeg,png,jpg,bmp|max:2048'
            ]);
            // tujuan folder upload
            $tujuan_upload = 'foto_nota';
            //format nama file sesuai dengan id pembelian
            //kemudian simpan linknya
            $filebaru = $pembelian->id . '.' . $file->getClientOriginalExtension();
            $file->move($tujuan_upload, $filebaru);
            //save link
            $pembelian->link_foto_nota = $tujuan_upload . '/' . $filebaru;
        }

        $pembelian->save();
        return redirect(route('pembelianTerdaftar'));
    }

    public function delete(Request $request)
    {
        $usulan = Pembelian::get()->where("id", '=', $request->pembelianId)->first();
        $usulan->delete();
        return redirect(route('pembelianTerdaftar'));
    }

    public function getDetail($id)
    {
        $detail_pembelian = Pembelian::get()->where('id', '=', $id)->first();
        $detail_pembelian->petugas;
        $detail_pembelian->pengelola;
        $detail_pembelian->usulan;
        $detail_pembelian->inventaris;
        if ($detail_pembelian->usulan->jenis_usulan == "Katalog") {
            $detail_pembelian->usulan->katalog;
            $detail_pembelian->usulan->katalog->kategori;
        }
        if ($detail_pembelian->link_foto_nota == null) {
            $detail_pembelian->upload_nota = "Belum Upload";
            $detail_pembelian->link_foto_nota = "foto_nota/belum_upload.jpg";
        } else {
            $detail_pembelian->upload_nota = "Sudah Upload";
            //tambahkan mtime ke link file untuk display ke view
            $mtime = filemtime($detail_pembelian->link_foto_nota);
            $detail_pembelian->link_foto_nota = $detail_pembelian->link_foto_nota . '?=' . $mtime;
        }
        Carbon::setLocale('id');
        $detail_pembelian->dibuat = $detail_pembelian->created_at->isoFormat('LLLL');
        $detail_pembelian->diperbarui = $detail_pembelian->created_at->isoFormat('LLLL');

        return $detail_pembelian;
    }

    public function getView($id)
    {
        $detail_pembelian = Pembelian::get()->where('id', '=', $id)->first();
        $detail_pembelian->petugas;
        $detail_pembelian->pengelola;
        $detail_pembelian->usulan;
        if ($detail_pembelian->usulan->jenis_usulan == "Katalog") {
            $detail_pembelian->usulan->katalog;
            $detail_pembelian->usulan->katalog->kategori;
        }
        if ($detail_pembelian->link_foto_nota == null) {
            $detail_pembelian->upload_nota = "Belum Upload";
            $detail_pembelian->link_foto_nota = "foto_nota/belum_upload.jpg";
        } else {
            $detail_pembelian->upload_nota = "Sudah Upload";
            $mtime = filemtime($detail_pembelian->link_foto_nota);
            $detail_pembelian->link_foto_nota = $detail_pembelian->link_foto_nota . '?=' . $mtime;
        }
        $tglDibuat = $detail_pembelian->created_at->format('d/M/Y');
        $pukulDibuat = $detail_pembelian->created_at->format('H:i');
        $tglDiperbarui = $detail_pembelian->updated_at->format('d/M/Y');
        $pukulDiperbarui = $detail_pembelian->updated_at->format('H:i');
        $detail_pembelian->dibuat = $tglDibuat . ' pukul ' . $pukulDibuat;
        $detail_pembelian->diperbarui = $tglDiperbarui . ' pukul ' . $pukulDiperbarui;
        //tambahkan mtime ke link file untuk display ke view
        return $detail_pembelian;
    }
}
