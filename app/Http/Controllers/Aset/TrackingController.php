<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Models\Aset\Aset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TrackingController extends Controller
{
    public function trackingForm()
    {
        return view('aset.tracking_form');
    }

    public function tracking()
    {
        $kode = Input::get('kode');
        $aset = Aset::get()->where('kode', '=', strtoupper($kode))->first();
        if ($aset == NULL) {
            return redirect(route('asetTracking'))->withErrors('Kode aset tidak ditemukan.');
        }
        $aset->riwayat_aset();
        $aset->lokasi();
        // return $aset;
        $link_detail = route('home').'/aset/detail/'.$aset->id;
        return redirect($link_detail);
    }
}