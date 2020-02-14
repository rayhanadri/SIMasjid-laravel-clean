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
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\Notifikasi;
use App\Models\Anggota\Pengelola_Aset;
use Intervention\Image\ImageManagerStatic as Image;

class PencatatanController extends Controller
{
    public function create()
    {
        $kategoriGroup = Kategori::get();
        $lokasiGroup = Lokasi::get();
        return view('aset.tambah_form', ['kategoriGroup' => $kategoriGroup, 'lokasiGroup' => $lokasiGroup]);
    }

    public function createHasil(Request $request)
    {
        //validasi input
        Validator::make($request->all(), [
            'file' => 'required|max:5242880',
            'jumlah' => 'required|numeric|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ])->validate();

        $aset = new Aset;
        $aset->id_lokasi = $request->id_lokasi;
        $aset->id_kategori = $request->id_kategori;
        $aset->nama = $request->nama;
        $aset->sumber = $request->sumber;
        $aset->status = 'Tersedia';
        $aset->jumlah = $request->jumlah;
        $aset->keterangan = $request->keterangan;
        $aset->harga_satuan = $request->harga_satuan;
        $aset->tgl_pencatatan = now();
        $aset->save();

        // get kode kategori
        $kategori = Kategori::get()->where('id', '=', $aset->id_kategori)->first();
        $kode_kategori = $kategori->kode;
        $aset->kode = $kode_kategori . $aset->id;

        // generate qr
        $qrCode = QrCode::format('png')->size(1000)->generate($aset->kode);
        $output_file = '/qr-code/img-' . $aset->kode . '.png';
        Storage::disk('public')->put($output_file, $qrCode); //storage/app/public/img/qr-code/img-1557309130.png
        $aset->link_qr = "public/storage/qr-code/img-" . $aset->kode . ".png";

        //save img
        $file = $request->file('file');

        // validasi jenis file
        $allowed_extension = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
        $extension = $file->getClientOriginalExtension();
        $inside_allowed = in_array($extension, $allowed_extension);
        if (!$inside_allowed) {
            throw ValidationException::withMessages([
                'file' => 'Format file gambar yang diperbolehkan adalah jpg, jpeg, gif, png, dan bmp.',
            ]);
        }

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
        $aset->save();

        //Riwayat
        $riwayat_aset = new Riwayat_Aset;
        $riwayat_aset->aksi = "Pencatatan";
        $riwayat_aset->status = $aset->status;
        $riwayat_aset->jumlah = $aset->jumlah;
        $riwayat_aset->waktu = now();
        $riwayat_aset->id_aset = $aset->id;
        $riwayat_aset->id_oleh_anggota = Auth::user()->id;
        $riwayat_aset->save();

        //notifikasi
        $managers = Pengelola_Aset::get();
        foreach ($managers as $manager) {
            // $arrayNotifikasi = [];
            $arrayNotifikasi = array(
                'id_pembuat' => Auth::user()->id,
                'id_penerima' => $manager->anggota_pengelola->id,
                'jenis' => "Penambahan Aset",
                'tgl_dibuat' => now(),
                'msg' => "menambahkan aset.",
                'sudah_baca' => 0,
                'icon' => "fas fa-plus-circle",
                'bg' => "bg-primary",
                'link' => route('home') . "/aset/detail/$aset->id"
            );
            // $arrayNotifikasi[] = Auth::user()->id;
            // $arrayNotifikasi[] = $manager->anggota_pengelola->id;
            // $arrayNotifikasi[] = "Penambahan Aset";
            // $arrayNotifikasi[] = "menambahkan aset.";
            // $arrayNotifikasi[] = "fas fa-plus-circle";
            // $arrayNotifikasi[] = "bg-primary";
            // $arrayNotifikasi[] = now();
            // $arrayNotifikasi[] = route('home') . "/aset/detail/$aset->id";
            Notifikasi::create($arrayNotifikasi);
            // return $arrayNotifikasi;
            // $notif = new Notifikasi;
            // $notif->id_pembuat = Auth::user()->id;
            // $notif->id_penerima = $manager->anggota_pengelola->id;
            // $notif->jenis = "Penambahan Aset";
            // $notif->msg = "menambahkan aset.";
            // $notif->icon = "fas fa-plus-circle";
            // $notif->bg = "bg-primary";
            // $notif->tgl_dibuat = now();
            // $notif->link = route('home') . "/aset/detail/$aset->id";
            // $notif->save();
        }

        return view('aset.tambah_hasil', ['aset' => $aset]);
    }
}
