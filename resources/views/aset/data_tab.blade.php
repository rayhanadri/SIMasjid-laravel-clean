<div class="col-12">
    <ul class="nav nav-tabs" id="tabMenu" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="katalog-tab" href="{{ route('asetIndex') }}"> <i class="fa fa-list-alt"></i> Katalog Aset</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="baik-tab" href="{{  route('asetIndexByStatus', ['status'=>'baik']) }}" role="tab"> <i class="fa fa-check"></i> Baik</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="rusak-tab" href="{{ route('asetIndexByStatus', ['status'=>'rusak']) }}" role="tab"> <i class="fas fa-unlink"></i> Rusak</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="diperbaiki-tab" href="{{ route('asetIndexByStatus', ['status'=>'diperbaiki']) }}" role="tab"> <i class="fa fa-wrench"></i> Diperbaiki</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="dipinjam-tab" href="{{ route('asetIndexByStatus', ['status'=>'dipinjam']) }}" role="tab"> <i class="fa fa-hand-holding"></i> Dipinjam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="dilepas-tab" href="{{ route('asetIndexByStatus', ['status'=>'dilepas']) }}" role="tab"> <i class="fa fa-recycle"></i> Dilepas</a>
        </li>
    </ul>
</div>