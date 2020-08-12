@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<!-- <script type="text/javascript" src="{{asset('public/dist/assets/js/page/bootstrap-modal.js')}}"></script> -->
<?php

//hide untuk selain sekretaris dan ketua
// $inside_pengelola = in_array(Auth::user()->id, $list_pengelola);
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div>
                <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
                    <li class="breadcrumb-item active">Pengaturan Data Master</li>
                </ol>
            </div>
        </div>
        @include('aset.menu_aset')
        <div class="section-header">
            <h1 style="margin:auto;"><i class="fa fa-database"></i> Pengaturan Data Master</h1>
        </div>
        <div class="section-body" style="min-height: 800px;">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="col-12">
                <ul class="nav nav-tabs" id="tabMenu" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="kategori-tab" href="{{ route('masterIndexKategori') }}"> <i class="fa fa-tags"></i> Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="lokasi-tab" href="{{ route('masterIndexLokasi') }}" role="tab"> <i class="fa fa-map-marker-alt"></i> Lokasi</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-lg btn-info btn-primary" data-toggle="modal" data-target="#tambahLokasiModal" style="margin: 20px;"><i class="fas fas fa-plus"></i> Tambah Lokasi</a>
                </div>
            </div>
            <div class="row">
                <button style="margin: 1em auto;" class="btn btn-dark" data-toggle="collapse" data-target="#filter-box">
                    <i class="fa fa-filter"></i> Show/Close Filter Data
                </button>
                <div class="col-12">
                    <div id="filter-box" class="collapse">
                        <div class="card-body">
                            <h6 style="text-align:center"><i class="fa fa-filter"></i> Filter Data</h6>
                            <div id="filter-no-lokasi" style="margin:10px"></div>
                            <div id="filter-nama-lokasi" style="margin:10px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="table_lokasi" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th id="th_no_lokasi">No</th>
                                <th id="th_nama_lokasi">Nama Lokasi</th>
                                <th id="th_action_lokasi">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokasiGroup as $lokasi)
                            <tr>
                                <td id="td_no_kategori">{{ $lokasi->id }}</th>
                                <td id="td_nama_kategori">{{ $lokasi->nama }}</th>
                                <td id="td_action_kategori">XX</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal Tambah Lokasi -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahLokasiModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('lokasiCreate') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Lokasi</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Lokasi" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SCRIPT -->
<script type="text/javascript">
    //document function
    $(document).ready(function() {
        $('#menu_master').addClass('active');
        //dynamic scrollx
        var scroll_table = false;
        if ($(window).width() <= 595) {
            scroll_table = true;
        }

        var table = $('#table_lokasi').DataTable({
            "scrollX": scroll_table,
            "lengthChange": false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
            },
            //kriteria column 0 nama tipe input

            initComplete: function() {
                this.api().columns([0]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="No" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-no-lokasi"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                this.api().columns([1]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Nama Lokasi" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-nama-lokasi"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
            },
        });
    });
</script>
@include('layouts.footer')