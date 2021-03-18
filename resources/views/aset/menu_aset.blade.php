<style>
    @media only screen and (max-width: 595px) {
        #menu_aset {
            display: none;
        }
    }
</style>
<?php
/* PHP UNTUK PENGATURAN VIEW */
//anggota terautentikasi
$authUser = Auth::user();
//hide untuk selain sekretaris dan ketua
$sekretaris = array(1, 2);
$inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);
?>
<?php
//check permission pengelola
$permission = app('App\Http\Controllers\Aset\PengelolaAsetController')->checkPermission();
?>

<div id="menu_aset" class="row">
    <div id="group_menu" style="margin: 10px auto;">
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
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_metadata" href="{{ route('metadataIndex', ['jenis_metadata' => 'kategori']) }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5; margin-top: 0.3em;">
                <i class="fa fa-database" style="font-size: 24px;"></i><br> Metadata
            </a>
        </span>
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_pengelola_aset" href="{{ route('asetPengelolaAset') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5; margin-top: 0.3em;">
                <i class="fa fa-users-cog" style="font-size: 24px;"></i><br> Pengelola Aset
            </a>
        </span>
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
            <a class="dropdown-item" href="{{ route('metadataIndex', ['jenis' => 'kategori']) }}"><i class="fa fa-database"></i> Metadata</a>
            @endif
            @if ($inside_sekretaris == true)
            <a class="dropdown-item" href="{{ route('asetPengelolaAset') }}"><i class="fa fa-users-cog"></i> Pengelola Aset</a>
            @endif
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