<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Anggota\Anggota;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:anggota'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:anggota'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Anggota
     */
    protected function create(array $data)
    {
        return Anggota::create([
            'id_jabatan' => $data['id_jabatan'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'nama' => $data['nama'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
            'id_status' => 3,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        // event(new Registered($user = $this->create($request->all())));

        $this->create($request->all());
        // $this->guard()->login($user);

        //logout user
        Auth::logout();
        //redirect ke halaman after_register
        return redirect(route('afterRegister'));
        
        // return $this->registered($request, $user)
        //     ?: redirect($this->redirectPath('/'));
    }
}
