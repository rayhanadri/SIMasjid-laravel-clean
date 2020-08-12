<?php

namespace App\Http\Controllers\Aset;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Aset\Aset;
use App\Models\Aset\Katalog;
use App\Models\Aset\Kategori;
use App\Models\Aset\Lokasi;
use App\Models\Aset\Riwayat_Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class AsetController extends Controller
{
    public function index()
    {
        $katalogGroup = Katalog::join('aset', 'aset.id_katalog', '=', 'katalog.id')
            ->select('katalog.nama_barang', 'katalog.id', 'katalog.id_kategori', DB::raw('count(*) as jumlah'))
            ->where('aset.status', '!=', 'Dilepas')
            ->groupBy('katalog.nama_barang', 'katalog.id', 'katalog.id_kategori')
            ->get();

        foreach ($katalogGroup as $katalog) {
            $katalog->kategori;
=======
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
>>>>>>> first commit
        }

        $kategoriGroup = Kategori::get();
        $lokasiGroup = Lokasi::get();
<<<<<<< HEAD
        return view('aset.index', ["katalogGroup" => $katalogGroup, "kategoriGroup" => $kategoriGroup, "lokasiGroup" => $lokasiGroup]);
    }

    public function indexByStatus($status)
    {
        switch ($status) {
            case 'baik':
                $asetGroup = Aset::where('status', '=', 'Baik')->get();
                $tab_active = "Baik";
                return view('aset.index_by_status', ["asetGroup" => $asetGroup, "tab_active" => $tab_active]);
                break;
            case 'rusak':
                $asetGroup = Aset::where('status', '=', 'Rusak')->get();
                $tab_active = "Rusak";
                return view('aset.index_by_status', ["asetGroup" => $asetGroup, "tab_active" => $tab_active]);
            case 'diperbaiki':
                $asetGroup = Aset::where('status', '=', 'Diperbaiki')->get();
                $tab_active = "Diperbaiki";
                return view('aset.index_by_status', ["asetGroup" => $asetGroup, "tab_active" => $tab_active]);
            case 'dipinjam':
                $asetGroup = Aset::where('status', '=', 'Dipinjam')->get();
                $tab_active = "Dipinjam";
                return view('aset.index_by_status', ["asetGroup" => $asetGroup, "tab_active" => $tab_active]);
            case 'dilepas':
                $asetGroup = Aset::where('status', '=', 'Dilepas')->get();
                $tab_active = "Dilepas";
                return view('aset.index_by_status', ["asetGroup" => $asetGroup, "tab_active" => $tab_active]);
            default:
                abort(404);
                break;
        }
    }

    public function getByKatalog($id)
    {
        $asetGroup = Aset::where('id_katalog', '=', $id)->where('status', '!=', 'Dilepas')->get();
        // return $asetGroup;
        $kategoriGroup = Kategori::get();
        $lokasiGroup = Lokasi::get();
        return view('aset.index_by_katalog', ["asetGroup" => $asetGroup, "kategoriGroup" => $kategoriGroup, "lokasiGroup" => $lokasiGroup]);
=======
        // return $asetGroup;
        return view('aset.index', ["asetGroup" => $asetGroup, "kategoriGroup" => $kategoriGroup, "lokasiGroup" => $lokasiGroup]);
>>>>>>> first commit
    }

    public function update(Request $request)
    {
<<<<<<< HEAD
        //check permission
        $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }
        $aset = Aset::get()->where('id', '=', $request->id)->first();
        $aset->merek = $request->merek;
        $aset->tipe = $request->tipe;
        $aset->harga_satuan = $request->harga;
        $aset->id_lokasi = $request->id_lokasi;
        $aset->keterangan = $request->keterangan;
        $aset->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        //check permission
        $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }
        // return $request;
        $aset = Aset::get()->where('id', '=', $request->id)->first();
        $aset->delete();
        return redirect()->route('asetIndex');
    }

    public function buatRiwayat($aset, $status_awal, $status_akhir, $keterangan)
    {
        //Riwayat
        $riwayat_aset = new Riwayat_Aset;
        $riwayat_aset->status_awal = $status_awal;
        $riwayat_aset->status_akhir = $status_akhir;
        $riwayat_aset->keterangan = $keterangan;
        $riwayat_aset->waktu = now();
        $riwayat_aset->id_aset = $aset->id;
        $riwayat_aset->save();
=======
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
>>>>>>> first commit
    }

    public function detail($id)
    {
        $aset = Aset::get()->where('id', '=', $id)->first();
<<<<<<< HEAD
        if ($aset == null) {
            return redirect()->route('asetIndex');
        }
=======
        // if ($aset == NULL) {
        //     return redirect()->back()->withErrors('Kode aset tidak ditemukan.');
        // }
>>>>>>> first commit
        $aset->riwayat_aset();
        $aset->lokasi();
        // return $aset;
        return view('aset.detail', ['aset' => $aset]);
    }

<<<<<<< HEAD
    public function updateFoto(Request $request)
    {
        //check permission
        $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }

        //validasi input
        Validator::make($request->all(), [
            'file' => 'required|max:5012|image|mimes:jpeg,png,jpg,gif,bmp,svg|max:5012',
        ])->validate();
        $aset = Aset::get()->where('id', '=', $request->id)->first();
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
        $image->save($tujuan_upload);

        //simpan link foto
        $aset->link_foto_barang = "public/storage/foto_aset/$filebaru";
        $aset->save();

        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        //check permission
        $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }

        $aset = Aset::get()->where('id', '=', $request->id)->first();
        $status_awal = $aset->status;
        $status = $request->status;
        $aset->tgl_diperbarui = now();
        $aset->keterangan = $request->keterangan;
        switch ($status) {
            case 'Baik':
                $aset->status = "Baik";
                $aset->save();
                $this->buatRiwayat($aset, $status_awal, 'Baik', $aset->keterangan);
                return redirect()->back();
                break;
            case 'Rusak':
                $aset->status = "Rusak";
                $aset->save();
                $this->buatRiwayat($aset, $status_awal, 'Rusak', $aset->keterangan);
                return redirect()->back();
                break;
            case 'Diperbaiki':
                $aset->status = "Diperbaiki";
                $aset->save();
                $this->buatRiwayat($aset, $status_awal, 'Diperbaiki', $aset->keterangan);
                return redirect()->back();
                break;
            case 'Dipinjam':
                $aset->status = "Dipinjam";
                $this->buatRiwayat($aset, $status_awal, 'Dipinjam', $aset->keterangan);
                $aset->save();
                return redirect()->back();
                break;
            case 'Dilepas':
                $aset->status = "Dilepas";
                $this->buatRiwayat($aset, $status, 'Dilepas', $aset->keterangan);
                $aset->save();
                return redirect()->back();
                break;
            default:
                return redirect()->back();
                break;
        }

        return redirect()->back();
    }
}
=======
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
>>>>>>> first commit
