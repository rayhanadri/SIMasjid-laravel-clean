<<<<<<< HEAD
<style>
    @media only screen and (max-width: 595px) {
        #menu_aset {
            display: none;
        }
    }
</style>
<?php
//check permission pengelola
$permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
?>
<div id="menu_aset" class="row">
    <div id="group_menu" style="margin: 1em;">
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_index" href="{{ route('asetIndex') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5; margin-top: 0.3em;">
                <i class="fa fa-table" style="font-size: 24px;"></i><br>Data Aset
            </a>
        </span>
        @if ($permission == true)
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_pencatatan" href="{{ route('asetCreate') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5; margin-top: 0.3em;">
                <i class="fa fa-edit" style="font-size: 24px;"></i><br>Pendaftaran Aset
            </a>
        </span>
        @endif
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_tracking" href="{{ route('asetTracking') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5; margin-top: 0.3em;">
                <i class="fa fa-search" style="font-size: 24px;"></i><br>Penelusuran
            </a>
        </span>
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_usulan" href="{{ route('asetUsulanIndex') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5; margin-top: 0.3em;">
                <i class="fa fa-lightbulb" style="font-size: 24px;"></i><br>Usulan Aset
            </a>
        </span>
        @if ($permission == true)
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_metadata" href="{{ route('metadataIndexKategori') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5; margin-top: 0.3em;">
                <i class="fa fa-database" style="font-size: 24px;"></i><br> Pengaturan Metadata
            </a>
        </span>
        @endif
    </div>

</div>
<div id="menu_aset_mini" class="row" style="margin: 1em auto; display:none;">
    <div class="dropdown d-inline mr-2">
        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars"></i> Menu Aset
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('asetIndex') }}"><i class="fa fa-table"></i> Data Aset</a>
            @if ($permission == true)
            <a class="dropdown-item" href="{{ route('asetCreate') }}"><i class="fa fa-edit"></i> Pendaftaran</a>
            @endif
            <a class="dropdown-item" href="{{ route('asetTracking') }}"><i class="fa fa-search"></i> Penelusuran</a>
            <a class="dropdown-item" href="{{ route('asetUsulanIndex') }}"><i class="fa fa-lightbulb"></i> Usulan Aset</a>
            @if ($permission == true)
            <a class="dropdown-item" href="{{ route('metadataIndexKategori') }}"><i class="fa fa-database"></i> Pengaturan Data</a>
            @endif
=======
<div id="menu_aset" class="row" style="margin: 1em auto;">
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_index" href="{{ route('asetIndex') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-table" style="font-size: 24px;"></i><br>Data Aset
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_pencatatan" href="{{ route('asetCreate') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-edit" style="font-size: 24px;"></i><br>Pencatatan
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_tracking" href="{{ route('asetTracking') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-search" style="font-size: 24px;"></i><br>Tracking
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_peminjaman" href="{{ route('asetPeminjamanIndexBerjalan') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-hand-holding" style="font-size: 24px;"></i><br>Peminjaman
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_perbaikan" href="#" class="btn btn-info icon-left not-ready" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-tools" style="font-size: 24px;"></i><br>Perbaikan
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_pengecekan" href="#" class="btn btn-info icon-left not-ready" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-clock" style="font-size: 24px;"></i><br>Jadwal Check
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_usulan" href="#" class="btn btn-info icon-left not-ready" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-lightbulb" style="font-size: 24px;"></i><br>Usulan
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_pengadaan" href="#" class="btn btn-info icon-left not-ready" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-truck-loading" style="font-size: 24px;"></i><br>Pengadaan
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_pelepasan" href="#" class="btn btn-info icon-left not-ready" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-recycle" style="font-size: 24px;"></i><br>Pelepasan
        </a>
    </div>
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_master" href="{{ route('masterIndexKategori') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-database" style="font-size: 24px;"></i><br> Pengaturan Data
        </a>
    </div>
</div>
<div id="menu_aset_mini" class="row" style="margin: 1em auto; display: none;">
    <div class="dropdown d-inline mr-2">
        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars"></i> Menu
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('asetIndex') }}"><i class="fa fa-table"></i> Data Aset</a>
            <a class="dropdown-item" href="{{ route('asetCreate') }}"><i class="fa fa-edit"></i> Pencatatan</a>
            <a class="dropdown-item" href="{{ route('asetTracking') }}"><i class="fa fa-search"></i> Tracking</a>
            <a class="dropdown-item" href="{{ route('asetPeminjamanIndexBerjalan') }}"><i class="fa fa-hand-holding"></i> Peminjaman</a>
            <a class="dropdown-item not-ready" href="#"><i class="fa fa-table"></i> Perbaikan</a>
            <a class="dropdown-item not-ready" href="#"><i class="fa fa-clock"></i> Jadwal Check</a>
            <a class="dropdown-item not-ready" href="#"><i class="fa fa-lightbulb"></i> Usulan</a>
            <a class="dropdown-item not-ready" href="#"><i class="fa fa-truck-loading"></i> Pengadaan</a>
            <a class="dropdown-item not-ready" href="#"><i class="fa fa-recycle"></i> Pelepasan</a>
            <a class="dropdown-item" href="{{ route('masterIndexKategori') }}"><i class="fa fa-database"></i> Pengaturan Data</a>
>>>>>>> first commit
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#aset-link").addClass("active");
        if ($(window).width() <= 576) {
            $("#menu_aset").remove();
            $("#menu_aset_mini").show();
        }
    });
</script>