<?php

namespace App\Http\Controllers\aset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aset\Peminjaman;
use App\Models\Aset\Aset;
use App\Models\Aset\Riwayat_Aset;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class PeminjamanController extends Controller
{
    //
    // throw ValidationException::withMessages([
    //     $this->username() => "Akun belum diaktivasi, silakan hubungi ketua atau sekretaris Masjid."
    // ]);

    public function createForm()
    {
        $asetGroup = Aset::get()->where('status', '=', 'Tersedia');
        $peminjamanGroup = Peminjaman::get()->where('status', '=', 'Belum Verifikasi');
        return view('aset.peminjaman_create', ['asetGroup' => $asetGroup]);
    }

    public function create(Request $request)
    {
        //pinjaman baru
        $peminjaman = new Peminjaman;
        $peminjaman->id_aset = $request->id_aset;       // input -- id aset
        $peminjaman->id_pembuat = Auth::user()->id;
        //cari aset
        $aset = Aset::get()->where('id', '=', $request->id_aset)->first();
        //verifikasi jumlah barang dipinjam dan jumlah barang aset
        if (($request->jumlah) > ($aset->jumlah)) {
            //jumlah dipinjam lebih banyak throw exception
            throw ValidationException::withMessages([
                'jumlah' => "Gagal menambah peminjaman baru: Jumlah aset yang dipinjam melebihi dari jumlah aset dimiliki."
            ]);
        } else {
            //jumlah barang dipinjam valid, lanjutkan peminjaman
            $peminjaman->jumlah = $request->jumlah;                             // input -- jumlah
            $peminjaman->nama_peminjam = $request->nama_peminjam;             // input -- nama peminjam
            $peminjaman->telp_peminjam = $request->telp_peminjam;             // input -- kontak peminjam
            if ($request->keterangan != null) {
                $peminjaman->keterangan = $request->keterangan;                   // input -- ket
            }
            $peminjaman->status = 'Belum Verifikasi';
            $peminjaman->tgl_dibuat = now();
            $peminjaman->save();

            return redirect(route('asetPeminjamanIndexVerifikasi'));
        }
    }


    public function terima(Request $request)
    {
        //cari peminjaman
        $peminjaman = Peminjaman::get()->where('id', '=', $request->id)->first();
        //cari aset
        $aset = Aset::get()->where('id', '=', $peminjaman->id_aset)->first();
        //verifikasi jumlah peminjaman dan barang
        if (($peminjaman->jumlah) > ($aset->jumlah)) {
            //exception, jumlah dipinjam melebihi aset
            throw ValidationException::withMessages([
                'jumlah' => "Gagal verifikasi peminjaman baru: Jumlah aset yang dipinjam melebihi dari jumlah aset dimiliki."
            ]);
        } else {
            //jumlah peminjaman masih valid, kurangi aset aktif
            $aset->jumlah = $aset->jumlah - $peminjaman->jumlah;
            if ($request->jumlah < 1) {
                $aset->status = "Tidak Tersedia";
            } else {
                $aset->status = "Tersedia";
            }
            $aset->save();
            //ubah status peminjaman
            $peminjaman->status = 'Berjalan';
            $peminjaman->save();

            //Riwayat
            $riwayat_aset = new Riwayat_Aset;
            $riwayat_aset->aksi = "Dipinjam";
            $riwayat_aset->status = $aset->status;
            $riwayat_aset->jumlah = $aset->jumlah;

            $riwayat_aset->waktu = now();
            $riwayat_aset->id_aset = $aset->id;
            $riwayat_aset->id_oleh_anggota = Auth::user()->id;
            $riwayat_aset->save();

            return redirect(route('asetPeminjamanIndexBerjalan'));
        }
    }

    public function tolak(Request $request)
    {
        //cari peminjaman, update status peminjaman
        // return $request;
        $peminjaman = Peminjaman::get()->where('id', '=', $request->id)->first();
        $peminjaman->status = 'Verifikasi Ditolak';
        $peminjaman->alasan_tolak = $request->alasan_tolak;
        $peminjaman->save();

        return redirect(route('asetPeminjamanIndexDitolak'));
    }
    public function selesai(Request $request)
    {
        //cari peminjaman
        $peminjaman = Peminjaman::get()->where('id', '=', $request->id)->first();
        //cari aset
        $aset = Aset::get()->where('id', '=', $peminjaman->id_aset)->first();
        //update jumlah aset
        $aset->jumlah = $aset->jumlah + $peminjaman->jumlah;
        if ($aset->jumlah < 1) {
            $aset->status = "Tidak Tersedia";
        } else {
            $aset->status = "Tersedia";
        }
        $aset->save();

        //Riwayat
        $riwayat_aset = new Riwayat_Aset;
        $riwayat_aset->aksi = "Dikembalikan";
        $riwayat_aset->status = $aset->status;
        $riwayat_aset->jumlah = $aset->jumlah;

        //update selesaikan peminjaman
        $riwayat_aset->waktu = now();
        $riwayat_aset->id_aset = $aset->id;
        $riwayat_aset->id_oleh_anggota = Auth::user()->id;
        $riwayat_aset->save();

        //update status peminjaman
        $peminjaman->status = 'Selesai';
        $peminjaman->tgl_selesai = now();
        $peminjaman->save();

        return redirect(route('asetPeminjamanIndexSelesai'));
    }
    public function indexVerifikasi()
    {
        $peminjamanGroup = Peminjaman::get()->where('status', '=', 'Belum Verifikasi');
        return view('aset.peminjaman_verifikasi', ['peminjamanGroup' => $peminjamanGroup]);
    }
    public function indexDitolak()
    {
        $peminjamanGroup = Peminjaman::get()->where('status', '=', 'Verifikasi Ditolak');
        return view('aset.peminjaman_ditolak', ['peminjamanGroup' => $peminjamanGroup]);
    }
    public function indexBerjalan()
    {
        $peminjamanGroup = Peminjaman::get()->where('status', '=', 'Berjalan');
        return view('aset.peminjaman_berjalan', ['peminjamanGroup' => $peminjamanGroup]);
    }
    public function indexSelesai()
    {
        $peminjamanGroup = Peminjaman::get()->where('status', '=', 'Selesai');
        return view('aset.peminjaman_selesai', ['peminjamanGroup' => $peminjamanGroup]);
    }
}
