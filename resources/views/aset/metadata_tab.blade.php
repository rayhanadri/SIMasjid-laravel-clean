<div class="col-12">
    <ul class="nav nav-tabs" id="tabMenu" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="kategori-tab" href="{{ route('metadataIndex', ['jenis_metadata' => 'kategori']) }}"> <i class="fa fa-tags"></i> Kategori</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="lokasi-tab" href="{{ route('metadataIndex', ['jenis_metadata' => 'lokasi']) }}" role="tab"> <i class="fa fa-map-marker-alt"></i> Lokasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="katalog-tab" href="{{ route('metadataIndex', ['jenis_metadata' => 'katalog']) }}" role="tab"> <i class="fa fa-list-alt"></i> Katalog</a>
        </li>
    </ul>
</div>