@include('layouts.header')
@include('layouts.navbar')
<?php

?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div>
                <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
                    <li class="breadcrumb-item active">Peminjaman</li>
                </ol>
            </div>
        </div>
        @include('aset.menu_aset')
        <div class="section-header">
            <h1 style="margin:auto;"><i class="fa fa-hand-holding"></i> Peminjaman</h1>
        </div>

        <div class="section-body" style="min-height: 800px;">
            @include('aset.peminjaman_tab')
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <table id="table_aset" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th id="th_No_aset">No. Aset</th>
                                <th id="th_kode_aset">Kode Aset</th>
                                <th id="th_nama_aset">Nama Barang</th>
                                <th id="th_kategori_aset">Kategori</th>
                                <th id="th_jumlah_aset">Jumlah</th>
                                <th id="th_action_aset">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asetGroup as $aset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $aset->kode }}</td>
                                <td>{{ $aset->nama }}</td>
                                @if ($aset->kategori != null)
                                <td>{{ $aset->kategori->nama }}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>{{ $aset->jumlah }}</td>
                                <td><a href="#" class="btn btn-icon btn-sm btn-primary open-tambah" style="width: 8em; margin: 2px;" data-toggle="modal" data-id="{{ $aset->id }}" data-nama="{{ $aset->nama }}" data-kode="{{ $aset->kode }}" data-jumlah="{{ $aset->jumlah }}" data-target="#tambahPeminjamanModal"><i class="fas fa-hand-holding"></i> Pinjamkan</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Peminjaman -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahPeminjamanModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peminjaman Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('asetPeminjamanCreateHasil') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
                        <div class="col-md-6">
                            <input id="nama_barang" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-md-4 col-form-label text-md-right">Kode Barang</label>
                        <div class="col-md-6">
                            <input id="kode_aset" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-4 col-form-label text-md-right">Jumlah (Max: <span id="max-jumlah"></span>)</label>
                        <div class="col-md-6">
                            <input id="jumlah" type="number" class="form-control" name="jumlah" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_peminjam" class="col-md-4 col-form-label text-md-right">Nama Peminjam</label>
                        <div class="col-md-6">
                            <input id="nama_peminjam" type="text" class="form-control" name="nama_peminjam" placeholder="Nama Peminjam" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telp_peminjam" class="col-md-4 col-form-label text-md-right">No. HP/Telp Peminjam</label>
                        <div class="col-md-6">
                            <input id="telp_peminjam" type="text" class="form-control" name="telp_peminjam" placeholder="Nomor Telepon/HP Peminjam" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-md-4 col-form-label text-md-right">Keterangan</label>
                        <div class="col-md-6">
                            <textarea id="keterangan" class="form-control" name="keterangan" style="height:82px;" placeholder="Keterangan lainnya"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <input type="text" id="id_aset" name="id_aset" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script type="text/javascript">
    //listener function
    $(document).on("click", ".open-tambah", function() {
        /* passing data dari view button detail ke modal */
        var id_aset = $(this).data('id');
        var nama_barang = $(this).data('nama');
        var kode_aset = $(this).data('kode');
        var jumlah = $(this).data('jumlah');
        $("#id_aset").val(id_aset);
        $("#nama_barang").val(nama_barang);
        $("#kode_aset").val(kode_aset);
        $("#jumlah").val(jumlah);
        $("#max-jumlah").html(jumlah);
    });

    //document function
    $(document).ready(function() {
        $('#menu_peminjaman').addClass('active');
        $('#create-tab').addClass('active');
        //dynamic scrollx
        var scroll_table = false;
        if ($(window).width() <= 530) {
            scroll_table = true;
        }

        $('#table_aset').DataTable({
            scrollX: scroll_table,
            pageLength: 25,
            lengthChange: false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            }
        });

        //JQuery Table

        var table = $('#table_peminjaman').DataTable({
            "scrollX": scroll_table,
            "lengthChange": false,
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
</script>
@include('layouts.footer')