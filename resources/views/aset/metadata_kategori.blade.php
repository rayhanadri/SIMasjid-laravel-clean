@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<!-- <script type="text/javascript" src="{{asset('public/dist/assets/js/page/bootstrap-modal.js')}}"></script> -->
<?php

//hide untuk selain sekretaris dan ketua
// $inside_pengelola = in_array(Auth::user()->id, $list_pengelola);
?>
<?php
//check permission pengelola
$permission = app('App\Http\Controllers\Aset\PengelolaAsetController')->checkPermission();
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div>
                <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
                    <li class="breadcrumb-item active">Pengaturan Metadata</li>
                </ol>
            </div>
        </div>
        @include('aset.menu_aset')
        <div class="section-header">
            <h1 style="margin:auto;"><i class="fa fa-database"></i> Pengaturan Metadata</h1>
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
            @include('aset.metadata_tab')
            @if($permission)
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <a href="#" class="btn btn-lg btn-info btn-primary open-tambah" data-toggle="modal" data-target="#tambahKategoriModal" style="margin: 20px;"><i class="fas fas fa-plus"></i> Tambah Kategori</a>
                </div>
            </div>
            @endif
            <div class="row">
                <button style="margin: 1em auto;" class="btn btn-dark" data-toggle="collapse" data-target="#filter-box">
                    <i class="fa fa-filter"></i> Show/Close Filter Data
                </button>
                <div class="col-12">
                    <div id="filter-box" class="collapse">
                        <div class="card-body">
                            <h6 style="text-align:center"><i class="fa fa-filter"></i> Filter Data</h6>
                            <div id="filter-id-kategori" style="margin:10px"></div>
                            <div id="filter-kode-kategori" style="margin:10px"></div>
                            <div id="filter-nama-kategori" style="margin:10px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="table_kategori" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th id="th_no_kategori">No</th>
                                <th id="th_kode_kategori">Kode Aset</th>
                                <th id="th_nama_kategori">Kategori</th>
                                <th id="th_pj_kategori">Penanggung Jawab</th>
                                @if($permission)
                                <th id="th_btn">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoriGroup as $kategori)
                            <tr>
                                <td id="td_no_kategori">{{ $loop->iteration }}</th>
                                <td id="td_kode_kategori">{{ $kategori->kode }}</th>
                                <td id="td_nama_kategori">{{ $kategori->nama }}</th>
                                @if ($kategori->penanggung_jawab)
                                <td id="td_pj_kategori">{{ $kategori->penanggung_jawab->nama }}</th>
                                @else
                                <td id="td_pj_kategori">-</th>
                                @endif
                                @if($permission)
                                <td id="td_btn">
                                    <div class="btn-group-vertical mb-3" role="group">
                                        <a href="#" class="open-update btn btn-icon btn-sm btn-primary" data-toggle="modal" data-id="{{ $kategori->id }}" data-nama="{{ $kategori->nama }}" data-kode="{{ $kategori->kode }}" data-pj="{{ $kategori->id_pj }}" data-target="#updateModal"><i class="fas fa-pen-square"></i> Edit</a>
                                        <a href="#" class="open-delete  btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $kategori->id }}" data-target="#deleteModal"><i class="fas fa-trash"></i> Hapus</a>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@if($permission)
<!-- Modal Tambah Kategori -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahKategoriModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('metadataCreate') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Kategori</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Kategori" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-md-4 col-form-label text-md-right">Kode Aset (Harus unik, max 3 karakter)</label>
                        <div class="col-md-6">
                            <input id="kode" type="text" class="form-control" name="kode" placeholder="Kode Kategori" required minlength="1" maxlength="3" size="3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-md-4 col-form-label text-md-right">Penanggung Jawab</label>
                        <div class="col-md-6">
                            <select id="pj" type="text" class="form-control" name="id_pj" style="width:100%;">
                                @foreach ($anggotaGroup as $anggota)
                                <option value="{{ $anggota->id }}"> {{ $anggota->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <input type="text" id="jenis_metadata" name="jenis_metadata" value="kategori" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Update -->
<div class="modal fade" tabindex="-1" role="dialog" id="updateModal">
    <div class="modal-dialog" role="document">
        <form action="{{ route('metadataUpdate') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="update_nama" class="col-md-4 col-form-label text-md-right">Nama Kategori</label>
                        <div class="col-md-6">
                            <input id="update_nama" type="text" class="form-control" name="nama" placeholder="Nama Kategori" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="update_kode" class="col-md-4 col-form-label text-md-right">Kode Aset (Harus unik, max 3 karakter)</label>
                        <div class="col-md-6">
                            <input id="update_kode" type="text" class="form-control" name="kode" placeholder="Kode Kategori" required="" minlength="1" maxlength="3" size="3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-md-4 col-form-label text-md-right">Penanggung Jawab</label>
                        <div class="col-md-6">
                            <select id="update_pj" type="text" class="form-control" name="id_pj" style="width:100%;">
                                @foreach ($anggotaGroup as $anggota)
                                <option value="{{ $anggota->id }}"> {{ $anggota->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <input type="text" id="jenis_metadata" name="jenis_metadata" value="kategori" hidden />
                    <input type="text" id="id_update" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <input type="submit" value="Simpan" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/trash.svg" id="detailFoto" class="mx-auto d-block" alt="tolak image" style="width:150px; height:150px;overflow: hidden;">

                <h5 align="center">Apakah Anda yakin ingin menghapus kategori ini?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('metadataDelete') }}" method="post">
                    @csrf
                    <input type="text" id="jenis_metadata" name="jenis_metadata" value="kategori" hidden />
                    <input type="text" id="id_delete" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Hapus" class="btn btn-danger" />
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<!-- SCRIPT -->

<script type="text/javascript">
    //document function
    $(document).ready(function() {
        $('#menu_metadata').addClass('active');
        $('#kategori-tab').addClass('active');
        //dynamic scrollx
        var scroll_table = false;
        if ($(window).width() <= 595) {
            scroll_table = true;
        }

        //JQuery Pencarian Berdasarkan Kriteria
        var table = $('#table_kategori').DataTable({
            "scrollX": scroll_table,
            "lengthChange": false,
            "pageLength": 50,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
            },
            //kriteria column 0 nama tipe input
            initComplete: function() {
                //kriteria column 0 nama tipe select
                this.api().columns([1]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Kode Kategori" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-kode-kategori"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                this.api().columns([2]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Nama Kategori" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-kode-kategori"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                this.api().columns([3]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Penanggung Jawab" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-nama-kategori"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
            }
        });


    });

    $(document).on("click", ".open-tambah", function() {
        $('#pj').select2({
            dropdownParent: $('#tambahKategoriModal')
        });
    });

    // action listener update
    $(document).on("click", ".open-update", function() {
        /* passing data dari view button detail ke modal */
        var this_id = $(this).data('id');
        var this_nama = $(this).data('nama');
        var this_kode = $(this).data('kode');
        var this_pj = $(this).data('pj');
        $("#id_update").val(this_id);
        $("#update_nama").val(this_nama);
        $("#update_kode").val(this_kode);
        $("#update_pj").val(this_pj);
    });

    // action listener delete
    $(document).on("click", ".open-delete", function() {
        /* passing data dari view button detail ke modal */
        var this_id = $(this).data('id');
        $("#id_delete").val(this_id);
    });
</script>
@include('layouts.footer')