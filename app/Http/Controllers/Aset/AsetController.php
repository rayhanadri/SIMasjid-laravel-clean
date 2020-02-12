<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Models\Aset\Aset;
use App\Models\Aset\Riwayat_Aset;
use App\Models\Aset\Lokasi;
use App\Models\Aset\Kategori;
use App\Http\Controllers\Controller;
use QrCode;
use Storage;
use Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
// use App\Events\StatusLiked;
use App\Models\Notifikasi;
use App\Models\Anggota\Pengelola_Aset;


class AsetController extends Controller
{
    //
    public function index()
    {
        // echo "index";
        $asetGroup = Aset::get();
        foreach ($asetGroup as $aset) {
            // jika keterangan kosong ganti -
            if ($aset->keterangan == NULL) {
                $aset->keterangan = "-";
                $aset->save();
            }
            // jika jumlah <= 0 status tidak tersedia
            if ($aset->jumlah <= 0) {
                $aset->status = "Tidak Tersedia";
                $aset->save();
            }
            // jika jumlah > 0 status tersedia
            if ($aset->jumlah > 0) {
                $aset->status = "Tersedia";
                $aset->save();
            }
            $aset->kategori;
            $aset->lokasi;
            $aset->tgl_pencatatan;
        }

        $kategoriGroup = Kategori::get();
        $lokasiGroup = Lokasi::get();
        // return $asetGroup;
        return view('aset.index', ["asetGroup" => $asetGroup, "kategoriGroup" => $kategoriGroup, "lokasiGroup" => $lokasiGroup]);
    }

    public function update(Request $request)
    {
        //validasi input
        Validator::make($request->all(), [
            'jumlah' => 'required|numeric|min:0',
        ])->validate();

        $aset = Aset::get()->where('id', '=', $request->id)->first();
        // ganti kode aset
        $kategori = Kategori::get()->where('id', '=', $request->id_kategori)->first();
        $kode_kategori = $kategori->kode;
        $aset->kode = $kode_kategori . $aset->id;

        // generate qr baru
        $qrCode = QrCode::format('png')->size(1000)->generate($aset->kode);
        $output_file = '/qr-code/img-' . $aset->kode . '.png';
        Storage::disk('public')->put($output_file, $qrCode); //storage/app/public/img/qr-code/img-1557309130.png
        $aset->link_qr = "public/storage/qr-code/img-" . $aset->kode . ".png";

        // ganti detail
        $aset->nama = $request->nama;
        $aset->id_kategori = $request->id_kategori;
        $aset->id_lokasi = $request->id_lokasi;
        if ($request->jumlah < 1) {
            $aset->status = "Tidak Tersedia";
        } else {
            $aset->status = "Tersedia";
        }
        $aset->jumlah = $request->jumlah;
        $aset->harga_satuan = $request->harga_satuan;
        $aset->save();

        //Riwayat
        $riwayat_aset = new Riwayat_Aset;
        $riwayat_aset->aksi = "Diperbarui";
        $riwayat_aset->status = $aset->status;
        $riwayat_aset->jumlah = $aset->jumlah;

        $riwayat_aset->waktu = now();
        $riwayat_aset->id_aset = $aset->id;
        $riwayat_aset->id_oleh_anggota = Auth::user()->id;
        $riwayat_aset->save();

        return redirect()->back();
    }

    public function detail($id)
    {
        $aset = Aset::get()->where('id', '=', $id)->first();
        // if ($aset == NULL) {
        //     return redirect()->back()->withErrors('Kode aset tidak ditemukan.');
        // }
        $aset->riwayat_aset();
        $aset->lokasi();
        // return $aset;
        return view('aset.detail', ['aset' => $aset]);
    }

    public function getAsetWhere($id)
    {
        $aset = Aset::get()->where('id', '=', $id)->first();
        $aset->parse_tgl_pencatatan = $aset->tgl_pencatatan->isoFormat('LLLL');
        $aset->kategori;
        $aset->lokasi;

        return $aset;
    }


    public function testing()
    {
        return view('aset.testing');
    }
}
