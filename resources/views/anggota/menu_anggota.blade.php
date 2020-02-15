<?php
/* PHP UNTUK PENGATURAN VIEW */
//anggota terautentikasi
$authUser = Auth::user();
//hide untuk selain sekretaris dan ketua
$sekretaris = array(1, 2);
$inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);
?>
<style>
  @media only screen and (max-width: 595px){
    #menu_keanggotaan{
      display: none;
    }
  }
</style>
<div id="menu_keanggotaan" class="row" style="margin: 1em auto;">
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_index" href="{{ route('anggotaIndex') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-address-book" style="font-size: 24px;"></i><br>Data Anggota
        </a>
    </div>
    @if($inside_sekretaris)
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_verifikasi" href="{{ route('anggotaIndexVerifikasi') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-user-check" style="font-size: 24px;"></i><br>Verifikasi
        </a>
    </div>
    @endif
    <div class="col-xs-2" style="padding: 0px;">
        <a id="menu_pengelola_aset" href="{{ route('anggotaPengelolaAset') }}" class="btn btn-info icon-left" style="height: 55px; width: 120px; font-size: 11px; border-radius: 0; line-height: 1.5;">
            <i class="fa fa-users-cog" style="font-size: 24px;"></i><br>Pengelola Aset
        </a>
    </div>
</div>
<div id="menu_keanggotaan_mini" class="row" style="margin: 1em auto; display:none;">
    <div class="dropdown d-inline mr-2">
        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars"></i> Menu
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('anggotaIndex') }}"><i class="fa fa-table"></i> Data Anggota</a>
            @if($inside_sekretaris)
            <a class="dropdown-item" href="{{ route('anggotaIndexVerifikasi') }}"><i class="fa fa-user-check"></i> Verifikasi</a>
            @endif
            <a class="dropdown-item" href="{{ route('anggotaPengelolaAset') }}"><i class="fa fa-users-cog"></i> Pengelola Aset</a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#keanggotaan-link").addClass("active");
        if ($(window).width() <= 576) {
            $("#menu_keanggotaan").remove();
            $("#menu_keanggotaan_mini").show();
        }
    });
</script>