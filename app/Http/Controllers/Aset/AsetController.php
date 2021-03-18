<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Models\Aset\Aset;
use App\Models\Aset\Riwayat_Aset;
use App\Models\Aset\Lokasi;
use App\Models\Aset\Kategori;
use App\Models\Aset\Katalog;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;


class AsetController extends Controller
{
    //
    public function index()
    {
        $katalogGroup = Katalog::join('aset', 'aset.id_katalog', '=', 'katalog.id')
            ->select('katalog.nama_barang', 'katalog.id', 'katalog.id_kategori', DB::raw('count(*) as jumlah'), DB::raw('sum(harga_satuan) as total_nilai'))
            ->where('aset.status', '!=', 'Dilepas')
            ->groupBy('katalog.nama_barang', 'katalog.id', 'katalog.id_kategori')
            ->get();

        foreach ($katalogGroup as $katalog) {
            $katalog->kategori;
        }

        $kategoriGroup = Kategori::get();
        $lokasiGroup = Lokasi::get();
        // return $asetGroup];
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
    }

    public function laporan()
    {
        //
        $aset_baik = Aset::where('status', '=', 'Baik')
            ->select(DB::raw('count(*) as jumlah'), DB::raw('sum(harga_satuan) as nilai'))
            ->get();

        //
        $aset_rusak = Aset::where('status', '=', 'Rusak')
            ->select(DB::raw('count(*) as jumlah'), DB::raw('sum(harga_satuan) as nilai'))
            ->get();
        //
        $aset_diperbaiki = Aset::where('status', '=', 'Diperbaiki')
        ->select(DB::raw('count(*) as jumlah'), DB::raw('sum(harga_satuan) as nilai'))
            ->get();
        //
        $aset_dipinjam = Aset::where('status', '=', 'Dipinjam')
        ->select(DB::raw('count(*) as jumlah'), DB::raw('sum(harga_satuan) as nilai'))
            ->get();
        //
        $aset_dilepas = Aset::where('status', '=', 'Dilepas')
        ->select(DB::raw('count(*) as jumlah'), DB::raw('sum(harga_satuan) as nilai'))
            ->get();
        //
        $aset_aktif = Aset::where('status', '!=', 'Dilepas')
        ->select(DB::raw('count(*) as jumlah'), DB::raw('sum(harga_satuan) as nilai'))
        ->get();
    //

        // return $asetGroup;
        return view('aset.laporan', ["aset_baik" => $aset_baik, "aset_rusak" => $aset_rusak, "aset_diperbaiki" => $aset_diperbaiki, "aset_dipinjam" => $aset_dipinjam, "aset_dilepas" => $aset_dilepas, "aset_aktif" => $aset_aktif]);
    }

    public function update(Request $request)
    {
        //check permission
        $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
        if ($permission == false) {
            return redirect(route('home'));
        }
        // return $request;
        $aset = Aset::get()->where('id', '=', $request->id)->first();
        $aset->merek = $request->merek;
        $aset->tipe = $request->tipe;
        $aset->harga_satuan = $request->harga;
        $aset->id_lokasi = $request->id_lokasi;
        $aset->sumber = $request->sumber;
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
    }

    public function detail($id)
    {
        $aset = Aset::get()->where('id', '=', $id)->first();
        if ($aset == null) {
            return redirect()->route('asetIndex');
        }
        $aset->riwayat_aset();
        $aset->lokasi();
        // return $aset;
        return view('aset.detail', ['aset' => $aset]);
    }

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
