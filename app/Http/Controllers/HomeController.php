<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        //buka index. Ambil data user terotentikasi, kemudian passing ke view home
        return view('home');
    }
}
