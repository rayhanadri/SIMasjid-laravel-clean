<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Anggota\AnggotaController;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends AnggotaController
{

    public function uploadFoto(Request $request)
    {
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        //validasi file dengan mime
        // Validator::make($request->all(), [
        //     'file' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg|max:2048',
        // ])->validate();

        // validasi jenis file in case mime not allowed
        $allowed_extension = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
        $extension = $file->getClientOriginalExtension();
        $inside_allowed = in_array($extension, $allowed_extension);
        if( !$inside_allowed ){
            throw ValidationException::withMessages([
                'file' => 'Format file gambar yang diperbolehkan adalah jpg, jpeg, gif, png, dan bmp.',
            ]);
        }

        //file confirmed image, make image then orientate
        ini_set('memory_limit', '2048M');
        $image = Image::make($file);

        // perbaiki orientasi gambar dengan intervention
        $image->orientate();

        //nama + extensi file
        $anggota = Auth::user();
        $filebaru = $anggota->id . '.' . $file->getClientOriginalExtension();

        // tujuan folder upload
        $tujuan_upload = public_path("/storage/foto_profil/$filebaru");

         //kemudian simpan gambarnya
        $image->save($tujuan_upload);

        //kemudian simpan linknya
        $anggota->link_foto = 'public/storage/foto_profil/'. $filebaru;
        $anggota->save();
        $anggota->jabatan = $this->getJabatan($anggota);
        $anggota->status = $this->getStatus($anggota);

        //kembalikan ke halaman pengaturan akun
        Session::flash('message', "Berhasil mengganti foto profil");
        return Redirect::back();
    }

    public function index()
    {
        //buka index. Ambil data user terotentikasi, kemudian passing ke view home
        $anggota = Auth::user();

        //transform dari db id_jabatan (angka) ke string, misal 1 jadi Ketua Takmir
        $anggota->jabatan = $this->getJabatan($anggota);
        $anggota->status = $this->getStatus($anggota);

        //tampilkan view profile dengan data anggota
        return view('profile.profile', ['anggota' => $anggota]);
    }
}
