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
                    <table id="table_peminjaman" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th id="th_no_peminjaman">No. Peminjaman</th>
                                <th id="th_kode_peminjaman">Kode Barang</th>
                                <th id="th_nama_barang_peminjaman">Nama Barang</th>
                                <th id="th_jumlah_barang_peminjaman">Jumlah</th>
                                <th id="th_pembuat_peminjaman">Pembuat</th>
                                <th id="th_nama_peminjam">Nama Peminjam</th>
                                <th id="th_telp_peminjam">Telp/HP Peminjam</th>
                                <th id="th_keterangan_peminjaman">Keterangan</th>
                                <th id="th_tgl_dibuat_peminjaman">Tanggal Dibuat</th>
                                <th id="th_action_peminjaman">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamanGroup as $peminjaman)
                            <tr>
                                <td id="td_no_peminjaman">{{ $peminjaman->id }}</td>
                                <td id="td_kode_barang_peminjaman">{{ $peminjaman->barang->nama }}</td>
                                <td id="td_nama_barang_peminjaman">{{ $peminjaman->barang->kode }}</td>
                                <td id="td_jumlah_barang_peminjaman">{{ $peminjaman->jumlah }}</td>
                                <td id="td_pembuat_peminjaman">{{ $peminjaman->pembuat->nama }}</td>
                                <td id="td_nama_peminjam">{{ $peminjaman->nama_peminjam}}</td>
                                <td id="td_telp_peminjam">{{ $peminjaman->telp_peminjam}}</td>
                                <td id="td_keterangan_peminjaman">{{ $peminjaman->keterangan}}</td>
                                <td id="td_tgl_peminjaman">{{ $peminjaman->tgl_dibuat}}</td>
                                <td id="td_btn_peminjaman">
                                    <div class="btn-group mb-3" role="group" aria-label="Basic example" style="padding-left: 20px;">
                                        <a href="#" class="open-tolak btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $peminjaman->id }}" data-target="#tolakModal"><i class="fas fa-times"></i></i> Tolak</a>
                                        <a href="#" class="open-terima btn btn-icon btn-sm btn-primary" data-toggle="modal" data-id="{{ $peminjaman->id }}" data-target="#terimaModal"><i class="fas fa-check"></i> Terima</a>
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
<!-- Modal Verif Tolak -->
<div class="modal fade" tabindex="-1" role="dialog" id="tolakModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Verifikasi Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/cancel.svg" id="detailFoto" class="mx-auto d-block" alt="tolak image" style="width:150px; height:150px;overflow: hidden;">
                <h5 align="center">Apakah Anda yakin ingin menolak verifikasi peminjaman ini?</h5>
                <form action="{{ route('asetPeminjamanTolakVerif') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="alasan_tolak" class="col-md-4 col-form-label text-md-right">Alasan Penolakan</label>
                        <div class="col-md-6">
                            <textarea id="alasan_tolak" class="form-control" name="alasan_tolak" style="height:82px;" placeholder="Alasan penolakan peminjaman" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="text" id="id_tolak" name="id" value="" hidden />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                        <input type="submit" value="Ya, Tolak" class="btn btn-danger" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal Verif Terima -->
<div class="modal fade" tabindex="-1" role="dialog" id="terimaModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terima Verifikasi Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/checked.svg" id="detailFoto" class="mx-auto d-block" alt="verif image" style="width:150px; height:150px;overflow: hidden;">
                <h5 align="center">Apakah Anda yakin ingin menerima verifikasi peminjaman ini?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('asetPeminjamanTerimaVerif') }}" method="post">
                    @csrf
                    <input type="text" id="id_terima" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Verifikasi" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script type="text/javascript">
    //listener function
    $(document).on("click", ".open-tolak", function() {
        /* passing data dari view button detail ke modal */
        var thisDataPeminjaman = $(this).data('id');
        $("#id_tolak").val(thisDataPeminjaman);
    });
    // onclick verif, show modal
    $(document).on("click", ".open-terima", function() {
        /* passing data dari view button detail ke modal */
        var thisDataPeminjaman = $(this).data('id');
        $("#id_terima").val(thisDataPeminjaman);
    });

    //document function
    $(document).ready(function() {
        $('#menu_peminjaman').addClass('active');
        $('#verifikasi-tab').addClass('active');
        //dynamic scrollx
        var scroll_table = false;
        if ($(window).width() <= 740) {
            scroll_table = true;
        }
        var scroll_table_aset = false;
        if ($(window).width() <= 575) {
            scroll_table_aset = true;
        }

        //JQuery Pencarian Berdasarkan Kriteria
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