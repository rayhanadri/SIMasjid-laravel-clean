<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Anggota\Anggota;
use App\Models\Anggota\Pengelola_Aset;
use App\Models\Aset\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatusLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $jenis, $isi, $tgl_dibuat)
    {
        $managers = Pengelola_Aset::get();
        foreach ($managers as $manager) {
            $notif = new Notifikasi;
            $notif->id_pembuat = $id;
            $notif->id_penerima = $manager->anggota_pengelola->id;
            $notif->jenis = $jenis;
            $notif->isi = $isi;
            $notif->tgl_dibuat = $tgl_dibuat;
            $notif->save();
        }

        $this->username = $id;

        $this->message  = "{$id} telah membuat notifikasi | Jenis notifikasi $jenis | Isi notifikasi $isi | Tgl_dibuat notifikasi $tgl_dibuat";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['status-liked'];
    }
}