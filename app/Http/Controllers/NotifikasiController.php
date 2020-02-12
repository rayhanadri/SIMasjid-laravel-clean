<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    //baca notifikasi
    public function read(Request $request)
    {
        $id = $request->id;
        $notif = Notifikasi::get()->where('id', '=', $id)->first();
        $notif->sudah_baca = 1;
        $notif->save();
        return response()->json(['success' => "Got Simple Ajax Request $id"]);
    }

    public function create( $arrayNotifikasi )
    {
        // array: [0] pembuat, [1] penerima, [2] jenis, [3] msg, [4] icon, [5] bg, [6] tgl_dibuat, [7] link  
        // return $arrayNotifikasi;
        $notif = new Notifikasi;
        $notif->id_pembuat = $arrayNotifikasi[0];
        $notif->id_penerima = $arrayNotifikasi[1];
        $notif->jenis = $arrayNotifikasi[2];
        $notif->msg = $arrayNotifikasi[3];
        $notif->icon = $arrayNotifikasi[4];
        $notif->bg = $arrayNotifikasi[5];
        $notif->tgl_dibuat = $arrayNotifikasi[6];
        $notif->link = $arrayNotifikasi [7];
        $notif->save();
    }
}
