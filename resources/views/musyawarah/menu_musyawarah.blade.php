<?php
/* PHP UNTUK PENGATURAN VIEW */
//anggota terautentikasi
$authUser = Auth::user();
//hide untuk selain sekretaris dan ketua
$sekretaris = array(1, 2);
$inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);
?>
<style>
    @media only screen and (max-width: 595px) {
        #menu_musyawarah {
            display: none;
        }
    }
</style>
<div id="menu_musyawarah" class="row">
    <div id="group_menu" style="margin: 10px auto;">
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_index" href="{{ route('musyawarahIndex') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5;">
                <i class="fa fa-address-book" style="font-size: 24px;"></i><br>Musyawarah
            </a>
        </span>
        
        <span class="col-xs-2" style="padding: 0px;">
            <a id="menu_pekerjaan" href="{{ route('musyawarahPekerjaan') }}" class="btn btn-info icon-left" style="height: 55px; width: 18em; font-size: 11px; border-radius: 0; line-height: 1.5;">
                <i class="fa fa-user-check" style="font-size: 24px;"></i><br>Pekerjaan
            </a>
        </span>
        @if($inside_sekretaris)
        @endif
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