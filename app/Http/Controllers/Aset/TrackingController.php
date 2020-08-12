<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Models\Aset\Aset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TrackingController extends Controller
{
<<<<<<< HEAD
    public function trackingForm()
=======
    public function tracking()
>>>>>>> first commit
    {
        return view('aset.tracking_form');
    }

<<<<<<< HEAD
    public function tracking()
=======
    public function trackingHasil()
>>>>>>> first commit
    {
        $kode = Input::get('kode');
        $aset = Aset::get()->where('kode', '=', strtoupper($kode))->first();
        if ($aset == NULL) {
<<<<<<< HEAD
            return redirect(route('asetTracking'))->withErrors('Kode aset tidak ditemukan.');
=======
            return redirect()->back()->withErrors('Kode aset tidak ditemukan.');
>>>>>>> first commit
        }
        $aset->riwayat_aset();
        $aset->lokasi();
        // return $aset;
<<<<<<< HEAD
        $link_detail = route('home').'/aset/detail/'.$aset->id;
        return redirect($link_detail);
=======
        return view('aset.tracking_hasil', ['aset' => $aset]);
>>>>>>> first commit
    }
}