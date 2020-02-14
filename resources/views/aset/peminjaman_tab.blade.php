<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs" id="tabMenu" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="berjalan-tab" href="{{ route('asetPeminjamanIndexBerjalan') }}" role="tab"> <i class="fa fa-play"></i> Berjalan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="selesai-tab" href="{{ route('asetPeminjamanIndexSelesai') }}" role="tab"> <i class="fa fa-flag-checkered"></i> Selesai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ditolak-tab" href="{{ route('asetPeminjamanIndexDitolak') }}" role="tab"> <i class="fa fa-window-close"></i> Ditolak</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="verifikasi-tab" href="{{ route('asetPeminjamanIndexVerifikasi') }}"> <i class="fa fa-clipboard-check"></i> Verifikasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="create-tab" href="{{ route('asetPeminjamanCreate') }}" role="tab"> <i class="fa fa-plus"></i> Peminjaman Baru</a>
            </li>
        </ul>
    </div>
</div>