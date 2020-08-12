<?php

namespace App\Http\Controllers\Anggota;

use App\Models\Anggota\Anggota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AnggotaController extends Controller
{
    //CONSTANT VALUES FOR MEMBER STATUS
    public const ACTIVE_MEMBER = 1;
    public const NON_ACTIVE_MEMBER = 2;
    public const UNVERIFIED_MEMBER = 3;

    //CONSTANT VALUES FOR MEMBER JABATAN
    public const KETUA = 1;
    public const SEKRETARIS = 2;
    public const BENDAHARA = 3;
    public const TAKMIR = 4;
    public const REMAS = 5;

    public function getJabatan(Anggota $anggota)
    {
        switch ($anggota->id_jabatan) {
            case (self::KETUA):
                return 'Ketua Takmir';
                break;
            case (self::SEKRETARIS):
                return 'Sekretaris Takmir';
                break;
            case (self::BENDAHARA):
                return 'Bendahara Takmir';
                break;
            case (self::TAKMIR):
                return 'Takmir Masjid';
                break;
            case (self::REMAS):
                return 'Remaja Masjid';
                break;
            default:
                return 'Anggota';
                break;
        }
    }

    public static function getStatus(Anggota $anggota)
    {
        switch ($anggota->id_status) {
            case (self::ACTIVE_MEMBER):
                return 'Aktif';
                break;
            case (self::NON_ACTIVE_MEMBER):
                return 'Non-Aktif';
                break;
            case (self::UNVERIFIED_MEMBER):
                return 'Belum Verifikasi';
                break;
            default:
                return 'Anggota';
                break;
        }
    }

    //check akses sekretaris
    public function checkAksesSekretaris()
    {
        //array berisi jabatan dengan akses sekretaris
        $sekretaris = array(self::KETUA, self::SEKRETARIS);

        //jika user terotentikasi statusnya aktif bisa lanjutkan, jika tidak return ke '/'
        $authUser = Auth::user();
        $insideSekretaris = in_array($authUser->id_jabatan, $sekretaris);
        if ($insideSekretaris) {
            return true;
        } else {
            return false;
        }
    }

    //mendapatkan detail anggota berdasarkan id, return objek anggota
    public function getDetail($id)
    {
        $anggota = Anggota::get()->where('id', $id)->first();
        $anggota->jabatan = $this->getJabatan($anggota);
        $anggota->status = $this->getStatus($anggota);
        $anggota->link_foto = $anggota->link_foto . '?=' . filemtime($anggota->link_foto);
        return $anggota;
    }

    //mendapatkan semua anggota terdaftar aktif dan non-aktif
    public function index()
    {
        //semua user, composite object
        $anggotaGroup = Anggota::get()->where('id_status', '!=', self::UNVERIFIED_MEMBER);

        //tambahkan keterangan status dan jabatan dalam string
        foreach ($anggotaGroup as $anggota) {
            $anggota->status =  $this->getStatus($anggota);
            $anggota->jabatan = $this->getJabatan($anggota);
        }
        //retval
        return view('anggota.index', ['anggotaGroup' => $anggotaGroup]);
    }

    //menghapus akun anggota, return list anggota terdaftar
    public function delete(Request $request)
    {
        //check akses sekretaris
        if ($this->checkAksesSekretaris() == false) {
            return redirect(route('home'));
        }
        $anggota = Anggota::get()->where('id', $request->id)->first();
        $anggota->delete();

        return redirect(route('anggotaIndex'));
    }

    //mengedit data akun anggota, return list anggota terdaftar
    public function update(Request $request)
    {
        //check akses sekretaris
        if ($this->checkAksesSekretaris() == false) {
            return redirect(route('home'));
        }
        //edited user
        $anggota = Anggota::get()->where('id', $request->id)->first();

        if ($request->username != $anggota->username) {
            $anggota->username = $request->username;
            $request->validate([
                'username' => 'unique:anggota',
            ]);
        }
        if ($request->email != $anggota->email) {
            $anggota->email = $request->email;
            $request->validate([
                'email' => 'unique:anggota|email'
            ]);
        }
        $request->validate([
            'nama' => 'required',
            'id_jabatan' => 'required',
            'id_status' => 'required',
        ]);
        $anggota->nama = $request->nama;
        $anggota->id_jabatan = $request->id_jabatan;
        $anggota->id_status = $request->id_status;
        $anggota->alamat = $request->alamat;
        $anggota->telp = $request->telp;
        $anggota->save();

        return redirect(route('anggotaIndex'));
    }
}
