<?php

namespace App\Http\Controllers\Musyawarah;

use App\Models\Anggota\Anggota;
use App\Models\Musyawarah\Pekerjaan;
use App\Models\Musyawarah\ProgressPekerjaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MusyawarahController extends Controller
{

    //CONSTANT VALUES FOR MEMBER STATUS
    public const ACTIVE_MEMBER = 1;
    public const NON_ACTIVE_MEMBER = 2;
    public const UNVERIFIED_MEMBER = 3;

    public function index()
    {
        //semua user, composite object
        $anggotaGroup = Anggota::get()->where('id_status', '!=', self::UNVERIFIED_MEMBER);

        //retval
        return view('musyawarah.index', ['anggotaGroup' => $anggotaGroup]);
    }

    public function pekerjaan()
    {
        //semua user, composite object
        $anggotaGroup = Anggota::get()->where('id_status', '!=', self::UNVERIFIED_MEMBER);
        $pekerjaanGroup = Pekerjaan::all();

        //retval
        return view('musyawarah.pekerjaan', ['anggotaGroup' => $anggotaGroup,'pekerjaanGroup'=>$pekerjaanGroup]);
    }

    public function addNotulensi()
    {
        //semua user, composite object
        $anggotaGroup = Anggota::get()->where('id_status', '!=', self::UNVERIFIED_MEMBER);
        $pekerjaanGroup = Pekerjaan::all();

        //retval
        return view('musyawarah.add_notulensi', ['anggotaGroup' => $anggotaGroup,'pekerjaanGroup'=>$pekerjaanGroup]);
    }

    public function addPekerjaan(Request $request)
    {
        //semua user, composite object
        $nama_pekerjaan = $request->nama_pekerjaan;
        $deskripsi_pekerjaan = $request->deskripsi_pekerjaan;
        $penanggung_jawab = $request->penanggung_jawab;

        Pekerjaan::create([
            'nama' => $nama_pekerjaan,
            'deskripsi' => $deskripsi_pekerjaan,
            'id_anggota' => $penanggung_jawab
        ]);

        //retval
        return redirect(route('musyawarahPekerjaan'));
    }

    public function storePekerjaan(Request $request)
    {
        //semua user, composite object
        $nama_pekerjaan = $request->nama_pekerjaan;
        $deskripsi_pekerjaan = $request->deskripsi_pekerjaan;
        $penanggung_jawab = Auth::user()->id;

        $p = Pekerjaan::create([
            'nama' => $nama_pekerjaan,
            'deskripsi' => $deskripsi_pekerjaan,
            'id_anggota' => $penanggung_jawab
        ]);

        //retval
        return $p;
    }

    public function addProgressPekerjaan(Request $request)
    {
        // dd($request);
        // //semua user, composite object
        $progress = $request->progress;
        $id_progress_pekerjaan = $request->id_progress_pekerjaan;
        $penanggung_jawab = Auth::user()->id;
        // $penanggung_jawab = $request->penanggung_jawab;

        ProgressPekerjaan::create([
            'keterangan' => $progress,
            'id_pekerjaan' => $id_progress_pekerjaan,
            'id_anggota' => $penanggung_jawab
        ]);

        // //retval
        return redirect(route('musyawarahPekerjaan'));
    }

    public function getDetailPekerjaan($id)
    {
        $pekerjaan = Pekerjaan::get()->where('id', $id)->first();
        $pp = ProgressPekerjaan::where('id_pekerjaan', $id)->get();
        for ($i=0; $i < count($pp); $i++) { 
            $p = $pp[$i];
            $p['creator'] = $p->pembuat_progress->nama;
        }
        $pekerjaan->progress = $pp;
        return $pekerjaan;
    }
    // //CONSTANT VALUES FOR MEMBER JABATAN
    // public const KETUA = 1;
    // public const SEKRETARIS = 2;
    // public const BENDAHARA = 3;
    // public const TAKMIR = 4;
    // public const REMAS = 5;

    // public function getJabatan(Anggota $anggota)
    // {
    //     switch ($anggota->id_jabatan) {
    //         case (self::KETUA):
    //             return 'Ketua Takmir';
    //             break;
    //         case (self::SEKRETARIS):
    //             return 'Sekretaris Takmir';
    //             break;
    //         case (self::BENDAHARA):
    //             return 'Bendahara Takmir';
    //             break;
    //         case (self::TAKMIR):
    //             return 'Takmir Masjid';
    //             break;
    //         case (self::REMAS):
    //             return 'Remaja Masjid';
    //             break;
    //         default:
    //             return 'Anggota';
    //             break;
    //     }
    // }

    // public function getStatus(Anggota $anggota)
    // {
    //     switch ($anggota->id_status) {
    //         case (self::ACTIVE_MEMBER):
    //             return 'Aktif';
    //             break;
    //         case (self::NON_ACTIVE_MEMBER):
    //             return 'Non-Aktif';
    //             break;
    //         case (self::UNVERIFIED_MEMBER):
    //             return 'Belum Verifikasi';
    //             break;
    //         default:
    //             return 'Anggota';
    //             break;
    //     }
    // }

    // //check akses sekretaris
    // public function checkAksesSekretaris()
    // {
    //     //array berisi jabatan dengan akses sekretaris
    //     $sekretaris = array(self::KETUA, self::SEKRETARIS);

    //     //jika user terotentikasi statusnya aktif bisa lanjutkan, jika tidak return ke '/'
    //     $authUser = Auth::user();
    //     $insideSekretaris = in_array($authUser->id_jabatan, $sekretaris);
    //     if ($insideSekretaris) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // //mendapatkan detail anggota berdasarkan id, return objek anggota
    // public function getDetail($id)
    // {
    //     $anggota = Anggota::get()->where('id', $id)->first();
    //     $anggota->jabatan = $this->getJabatan($anggota);
    //     $anggota->status = $this->getStatus($anggota);
    //     $anggota->link_foto = $anggota->link_foto . '?=' . filemtime($anggota->link_foto);
    //     return $anggota;
    // }

    // //menghapus akun anggota, return list anggota terdaftar
    // public function delete(Request $request)
    // {
    //     //check akses sekretaris
    //     if ($this->checkAksesSekretaris() == false) {
    //         return redirect(route('home'));
    //     }
    //     $anggota = Anggota::get()->where('id', $request->id)->first();
    //     $anggota->delete();

    //     return redirect(route('anggotaIndex'));
    // }

    // //mengedit data akun anggota, return list anggota terdaftar
    // public function update(Request $request)
    // {
    //     //check akses sekretaris
    //     if ($this->checkAksesSekretaris() == false) {
    //         return redirect(route('home'));
    //     }
    //     //edited user
    //     $anggota = Anggota::get()->where('id', $request->id)->first();

    //     if ($request->username != $anggota->username) {
    //         $anggota->username = $request->username;
    //         $request->validate([
    //             'username' => 'unique:anggota',
    //         ]);
    //     }
    //     if ($request->email != $anggota->email) {
    //         $anggota->email = $request->email;
    //         $request->validate([
    //             'email' => 'unique:anggota|email'
    //         ]);
    //     }
    //     $request->validate([
    //         'nama' => 'required',
    //         'id_jabatan' => 'required',
    //         'id_status' => 'required',
    //     ]);
    //     $anggota->nama = $request->nama;
    //     $anggota->id_jabatan = $request->id_jabatan;
    //     $anggota->id_status = $request->id_status;
    //     $anggota->alamat = $request->alamat;
    //     $anggota->telp = $request->telp;
    //     $anggota->save();

    //     return redirect(route('anggotaIndex'));
    // }
}
