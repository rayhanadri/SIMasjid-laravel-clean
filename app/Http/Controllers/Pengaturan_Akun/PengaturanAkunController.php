<?php

namespace App\Http\Controllers\Pengaturan_Akun;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class PengaturanAkunController extends Controller
{
    protected function validator(array $data)
    {
        if (Auth::user()->username == $data['username'] && Auth::user()->email == $data['email']) {
            return Validator::make($data, [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        if (Auth::user()->username == $data['username']) {
            return Validator::make($data, [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:anggota'],
            ]);
        }
        if (Auth::user()->email == $data['email']) {
            return Validator::make($data, [
                'username' => ['required', 'string', 'max:255', 'unique:anggota'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:anggota'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:anggota'],
        ]);
    }

    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        //ubah dan simpan data
        $anggota = Auth::user();
        $anggota->username = $request->username;
        $anggota->password = Hash::make($request->password);
        $anggota->email = $request->email;
        $anggota->alamat = $request->alamat;
        $anggota->telp = $request->telp;
        $anggota->save();

        //kembalikan ke halaman pengaturan akun
        Session::flash('message', "Berhasil menyimpan pengaturan akun");
        return Redirect::back();
    }

    public function index()
    {
        //tampilkan view profile dengan data anggota
        return view('pengaturan_akun.pengaturan_akun');
    }
}
