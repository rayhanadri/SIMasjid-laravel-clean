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
use Illuminate\Support\Facades\Validator;
use App\Models\Notifikasi;
use App\Models\Anggota\Pengelola_Aset;
use App\Models\Aset\Katalog;
use Intervention\Image\ImageManagerStatic as Image;

class PendaftaranController extends Controller
{
    public function createForm()
    {
        //check permission
        $permission = app('App\Http\Controllers\Aset\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }

        $kategoriGroup = Kategori::get();
        $lokasiGroup = Lokasi::get();
        $katalogGroup = Katalog::get();

        return  view('aset.pendaftaran_form', ['kategoriGroup' => $kategoriGroup, 'lokasiGroup' => $lokasiGroup, 'katalogGroup' => $katalogGroup])->with('katalogJSON', json_decode($katalogGroup, true));
    }

    public function create(Request $request)
    {
        //check permission
        $permission = app('App\Http\Controllers\Aset\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        } else if (isset($request->jumlah) == true) {
            //validator
            Validator::make($request->all(), [
                'id_katalog' => 'required',
                'jumlah' => 'required|min:1',
                'file' => 'required|max:5012|image|mimes:jpeg,png,jpg,gif,bmp,svg|max:5012',
                'sumber' => 'required',
            ])->validate();
            $jumlah = $request->jumlah;
            for ($i = 0; $i < $jumlah; $i++) {
                $aset = $this->buatAset($request, $request->id_katalog);
            }
            $link_detail = route('home') . "/aset/katalog/$request->id_katalog";
            return redirect($link_detail);
        } else if (isset($request->jumlah) == false) {
            //validator
            Validator::make($request->all(), [
                'id_katalog' => 'required',
                'file' => 'required|max:5012|image|mimes:jpeg,png,jpg,gif,bmp,svg|max:5012',
                'sumber' => 'required',
            ])->validate();

            $aset = $this->buatAset($request, $request->id_katalog);
            $link_detail = route('home') . "/aset/detail/$aset->id";
            return redirect($link_detail);
        } else {
            return redirect()->back();
        }
    }

    public function buatKatalog($request)
    {
        $katalog = new Katalog;
        $katalog->id_kategori = $request->id_kategori;
        $katalog->nama_barang = $request->nama_barang;
        $katalog->save();
        return $katalog;
    }

    public function buatRiwayat($aset, $status_akhir, $keterangan)
    {
        //Riwayat
        $riwayat_aset = new Riwayat_Aset;
        $riwayat_aset->status_awal = '-';
        $riwayat_aset->status_akhir = $status_akhir;
        $riwayat_aset->keterangan = $keterangan;
        $riwayat_aset->waktu = now();
        $riwayat_aset->id_aset = $aset->id;
        $riwayat_aset->save();
    }

    public function buatAset($request, $id_katalog)
    {
        $aset = new Aset;
        $aset->id_katalog = $id_katalog;
        $aset->id_lokasi = $request->id_lokasi;
        $aset->sumber = $request->sumber;
        $aset->merek = ($request->merek == null) ? "" : $request->merek;
        $aset->tipe = ($request->tipe == null) ? "" : $request->tipe;
        $aset->status = $request->status;
        $aset->harga_satuan = $request->harga_satuan;
        $aset->keterangan = ($request->keterangan == null) ? "" : $request->keterangan;
        $aset->tgl_pendaftaran = now();
        $aset->save();
        $aset->kode = $aset->katalog->kategori->kode . $aset->id;
        $this->generateQR($aset);
        $this->saveImage($request, $aset);
        $this->buatRiwayat($aset, $aset->status, $aset->keterangan);
        $aset->save();
        return $aset;
    }

    public function generateQR($aset)
    {
        // generate qr
        $qrCode = QrCode::format('png')->size(1000)->generate($aset->kode);
        $output_file = '/qr-code/img-' . $aset->kode . '.png';
        Storage::disk('public')->put($output_file, $qrCode); //storage/app/public/img/qr-code/img-1557309130.png
        $aset->link_qr = "public/storage/qr-code/img-" . $aset->kode . ".png";
    }

    public function saveImage($request, $aset)
    {
        //save img
        $file = $request->file('file');
        //file confirmed image, make image then orientate
        ini_set('memory_limit', '5242880');
        $image = Image::make($file);

        // perbaiki orientasi gambar dengan intervention
        $image->orientate();

        //nama + extensi file
        $filebaru = $aset->kode . '.' . $file->getClientOriginalExtension();

        // tujuan folder upload
        $tujuan_upload = public_path("/storage/foto_aset/$filebaru");

        //kemudian simpan gambarnya
        // $file->move($tujuan_upload, $filebaru);
        $image->save($tujuan_upload);

        //simpan link foto
        $aset->link_foto_barang = "public/storage/foto_aset/$filebaru";
    }
}
