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
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-lg btn-primary open-create" data-toggle="modal" data-target="#tambahKatalogModal" style="margin: 20px;"><i class="fas fas fa-plus"></i> Tambah Katalog</a>
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
                            <div id="filter-no-katalog" style="margin:10px"></div>
                            <div id="filter-nama-barang" style="margin:10px"></div>
                            <div id="filter-kategori" style="margin:10px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="table_katalog" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th id="th_no_katalog">No</th>
                                <th id="th_nama_katalog">Nama Barang</th>
                                <th id="th_kategori">Kategori</th>
                                <th id="th_action_katalog">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($katalogGroup as $katalog)
                            <tr>
                                <td id="td_no_katalog">{{ $loop->iteration }}</th>
                                <td id="td_nama_barang">{{ $katalog->nama_barang }}</th>
                                <td id="td_nama_kategori">
                                    @if( $katalog->kategori != null)
                                    {{ $katalog->kategori->nama }}
                                    @else
                                    -
                                    @endif
                                    </th>
                                <td id="td_btn">
                                    <div class="btn-group-vertical mb-3" role="group">
                                        <a href="#" class="open-update btn btn-icon btn-sm btn-primary" data-toggle="modal" data-id="{{ $katalog->id }}" data-nama="{{ $katalog->nama_barang }}" data-kategori="{{ $katalog->id_kategori }}" data-target="#updateModal"><i class="fas fa-pen-square"></i> Edit</a>
                                        <a href="#" class="open-delete  btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $katalog->id }}" data-target="#deleteModal"><i class="fas fa-trash"></i> Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal Tambah Katalog -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahKatalogModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Katalog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('metadataKatalogCreate') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
                        <div class="col-md-6">
                            <input id="nama_barang" type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create_kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>
                        <div class="col-md-6">
                            <select id="create_kategori" type="text" class="form-control" name="id_kategori" style="width:100%;">
                                @foreach ($kategoriGroup as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->kode }} | {{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
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
        <form action="{{ route('metadataKatalogUpdate') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Katalog Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="update_nama" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
                        <div class="col-md-6">
                            <input id="update_nama" type="text" class="form-control" name="nama" placeholder="Nama Katalog" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>
                        <div class="col-md-6">
                            <select id="update_kategori" type="text" class="form-control" name="id_kategori" style="width:100%;">
                                @foreach ($kategoriGroup as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->kode }} | {{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <input type="text" id="update_id" name="id" value="" hidden />
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

                <h5 align="center">Apakah Anda yakin ingin menghapus katalog ini?</h5>
                <h7 align="center">Menghapus katalog menyebabkan data aset dengan nama barang ini akan terhapus.</h7>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('metadataKatalogDelete') }}" method="post">
                    @csrf
                    <input type="text" id="id_delete" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Hapus" class="btn btn-danger" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPT -->
<script type="text/javascript">
    //document function
    $(document).ready(function() {
        $('#menu_metadata').addClass('active');
        $('#katalog-tab').addClass('active');
        //dynamic scrollx
        var scroll_table = false;
        if ($(window).width() <= 595) {
            scroll_table = true;
        }

        var table = $('#table_katalog').DataTable({
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
                this.api().columns([0]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="No" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-no-katalog"))
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
                    var input = $('<input class="form-control" placeholder="Nama Barang" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-nama-barang"))
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
                    var select = $('<select class="form-control select2" id="select2-kategori" style="margin: 5px; width:100%;"><option value="">Kategori Aset</option></select>')
                        // .appendTo($(column.header()).empty())
                        .appendTo($("#filter-kategori"))
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            },
        });
    });
    // action listener update
    $(document).on("click", ".open-create", function() {
        /* passing data dari view button detail ke modal */
        $('#create_kategori').select2({
            dropdownParent: $('#tambahKatalogModal')
        });
    });
    $(document).on("click", ".open-update", function() {
        /* passing data dari view button detail ke modal */
        var this_id = $(this).data('id');
        var this_nama = $(this).data('nama');
        var this_kategori = $(this).data('kategori');
        $("#update_id").val(this_id);
        $("#update_nama").val(this_nama);
        $('#update_kategori').select2({
            dropdownParent: $('#updateModal')
        });
        $('#update_kategori').val(this_kategori);
    });

    // action listener delete
    $(document).on("click", ".open-delete", function() {
        /* passing data dari view button detail ke modal */
        var this_id = $(this).data('id');
        $("#id_delete").val(this_id);
    });
</script>
@include('layouts.footer')