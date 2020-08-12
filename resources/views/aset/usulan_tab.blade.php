<?php
//check permission pengelola
$permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
?>
<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs" id="tabMenu" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="belum-diproses-tab" href="{{ route('asetUsulanIndex') }}" role="tab"> <i class="fa fa-question-circle"></i> Belum Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="diproses-tab" href="{{ route('asetUsulanIndexDiproses') }}" role="tab"> <i class="fa fa-forward"></i> Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="selesai-tab" href="{{ route('asetUsulanIndexSelesai') }}" role="tab"> <i class="fa fa-check"></i> Selesai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ditolak-tab" href="{{ route('asetUsulanIndexDitolak') }}" role="tab"> <i class="fa fa-times-circle"></i> Ditolak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dibatalkan-tab" href="{{ route('asetUsulanIndexDibatalkan') }}" role="tab"> <i class="fa fa-times-circle"></i> Dibatalkan</a>
            </li>
        </ul>
    </div>
</div>