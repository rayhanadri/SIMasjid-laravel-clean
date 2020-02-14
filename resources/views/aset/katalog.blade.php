@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<!-- <script type="text/javascript" src="{{asset('public/dist/assets/js/page/bootstrap-modal.js')}}"></script> -->
<?php

use Carbon\Carbon;

Carbon::setLocale('id');
//hide untuk selain sekretaris dan ketua
$inside_pengelola = in_array($anggota->id, $list_pengelola);
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div>
                <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asetDasbor') }}">Manajemen Aset</a></li>
                    <li class="breadcrumb-item active">Usulan</li>
                </ol>
            </div>
        </div>
        <div class="section-header">
            <h1><i class="fa fa-toolbox"></i> Pengaturan Data</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="section-body" style="min-height: 300px;">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="katalog-tab" data-toggle="tab" href="#katalog" role="tab" aria-controls="home" aria-selected="true"><i class="fas fas fa-list-alt"></i> Katalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fas fa-tags"></i> Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pj-kategori-tab" data-toggle="tab" href="#pj-kategori" role="tab" aria-controls="pj-kategori" aria-selected="false"><i class="fas fa-user-tag"></i> PJ Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-map-marker-alt"></i> Lokasi</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="katalog" role="tabpanel" aria-labelledby="katalog-tab">
                            <div class="col-12" style="margin-left: 0px; margin-top: 0px; margin-bottom:20px; padding: 0px;">
                                <a href="#" class="btn btn-lg btn-info btn-primary" data-toggle="modal" data-target="#tambahModal" style="margin: 10px;"><i class="fas fas fa-plus"></i> Tambah Katalog</a>
                                <table id="table_id" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Nama Barang Katalog</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_katalog as $katalog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $katalog->kategori->nama }}</td>
                                            <td>{{ $katalog->nama }}</td>
                                            <td> <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="#" data-target="#deleteModal" style="width:100%"><i class="fas fa-trash"></i> Hapus</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <a href="#" class="btn btn-lg btn-info btn-primary" data-toggle="modal" data-target="#tambahModal" style="margin: 10px;"><i class="fas fas fa-plus"></i> Tambah Kategori</a>
                            <table id="table_id2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_katalog as $katalog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $katalog->kategori->nama }}</td>
                                        <td>{{ $katalog->nama }}</td>
                                        <td> <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="#" data-target="#deleteModal" style="width:100%"><i class="fas fa-trash"></i> Hapus</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                        </div>
                        <div class="tab-pane fade" id="pj-kategori" role="tabpanel" aria-labelledby="pj-kategori-tab">
                            <a href="#" class="btn btn-lg btn-info btn-primary" data-toggle="modal" data-target="#tambahModal" style="margin: 10px;"><i class="fas fas fa-plus"></i> Tambah PJ Kategori</a>
                            <table id="table_id4" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_katalog as $katalog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $katalog->kategori->nama }}</td>
                                        <td>{{ $katalog->nama }}</td>
                                        <td> <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="#" data-target="#deleteModal" style="width:100%"><i class="fas fa-trash"></i> Hapus</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <a href="#" class="btn btn-lg btn-info btn-primary" data-toggle="modal" data-target="#tambahModal" style="margin: 10px;"><i class="fas fas fa-plus"></i> Tambah Lokasi</a>
                            <table id="table_id3" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lokasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_katalog as $katalog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $katalog->kategori->nama }}</td>
                                        <td> <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="#" data-target="#deleteModal" style="width:100%"><i class="fas fa-trash"></i> Hapus</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div class="col-4">
                <div class="section-body" style="margin-bottom: 10px;">
                    <h6><i class="fa fa-filter"></i> Filter Data</h6>
                    <div class="column-search"></div>
                </div>
            </div> -->
        </div>
    </section>
    <!-- Modal Detail -->
    <div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Usulan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('usulanCreate') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="pengusul" class="col-md-4 col-form-label text-md-right">Pengusul</label>
                            <div class="col-md-6">
                                <input id="pengusul" type="text" class="form-control" name="pengusul" value="{{$anggota->nama}}" readonly disabled>
                                <input id="id_pengusul" type="text" class="form-control" name="id_pengusul" value="{{$anggota->id}}" readonly hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Barang Usulan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_aset" class="col-md-4 col-form-label text-md-right">Jenis Aset</label>
                            <div class="col-md-6">
                                <select class="form-control" id="jenis_aset" name="jenis_aset" required>
                                    <option>Pilih Jenis Aset</option>
                                    <option value=1>Aset Tetap</option>
                                    <option value=2>Persediaan</option>
                                    <option value=3>Buku</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kategori" class="col-md-4 col-form-label text-md-right">Kategori Aset</label>
                            <div class="col-md-6">
                                <select class="form-control" id="id_kategori" name="id_kategori" required>
                                    <option>Pilih Jenis Aset Dahulu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-md-4 col-form-label text-md-right">Jumlah</label>
                            <div class="col-md-6">
                                <input id="jumlah" type="number" class="form-control" name="jumlah" placeholder="Jumlah" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-md-4 col-form-label text-md-right">Harga Satuan</label>
                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control" name="harga" placeholder="Perkiraan Harga Satuan" data-a-dec="," data-a-sep="." required>
                            </div>
                        </div>
                        <!-- <input type="text" id="usulanId" name="usulanId" value="" hidden/> -->
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Buat Usulan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Usulan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/trash.svg" id="detailFoto" class="mx-auto d-block" alt="hapus image" style="width:150px; height:150px;overflow: hidden;">

                <h5 align="center">Apakah Anda yakin ingin menghapus usulan ini?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('usulanDelete') }}" method="post">
                    @csrf
                    <input type="text" id="usulanId" name="usulanId" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Hapus" class="btn btn-danger" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <form method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Usulan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="id_pengelola" type="text" class="form-control" name="id_pengelola" value="{{$anggota->id}}" readonly hidden>

                    <table style="width:90%; margin: auto;">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Usulan Aset</th>
                                <td><input class="form-control" type="text" id="editNama" name="editNama" /></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Aset</th>
                                <td><select id="editJenis" name="editJenis" class="form-control select">
                                        <option value=1>Aset Tetap</option>
                                        <option value=2>Persediaan</option>
                                        <option value=3>Buku</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Kategori Aset</th>
                                <td><select id="editKategori" name="editKategori" class="form-control select">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah</th>
                                <td><input type="number" id="editJumlah" name="editJumlah" class="form-control"></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Satuan</th>
                                <td><input type="number" id="editHarga" name="editHarga" class="form-control" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <input type="text" id="usulanId" name="usulanId" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <input type="submit" value="Konfirmasi Edit" class="btn btn-warning" />
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal Detail -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Usulan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table style="width:90%; margin: auto;">
                    <tbody>
                        <tr>
                            <th scope="row">Nama Usulan Aset</th>
                            <td id="detailNama"></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Aset</th>
                            <td id="detailJenis"></td>
                        </tr>
                        <tr>
                            <th scope="row">Kategori Aset</th>
                            <td id="detailKategori"></td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah</th>
                            <td id="detailJumlah"></td>
                        </tr>
                        <tr>
                            <th scope="row">Harga Satuan</th>
                            <td><span id="detailHarga" data-a-dec="," data-a-sep="."></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Harga</th>
                            <td><span id="detailTotal" data-a-dec="," data-a-sep="."></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Dibuat</th>
                            <td id="dibuat"></td>
                        </tr>
                        <tr>
                            <th scope="row">Diperbarui</th>
                            <td id="diperbarui"></td>
                        </tr>
                        <tr>
                            <th scope="row">Dibuat oleh</th>
                            <td id="dibuatOleh"></td>
                        </tr>
                        <tr>
                            <th scope="row">Diperbarui oleh</th>
                            <td id="diperbaruiOleh"></td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td id="detailStatus" class="font-status"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> -->
                <a id="linkView" href="" class="btn btn-info"><i class="fas fas fa-glasses"></i> Detail Lengkap</a>
                <!-- <input type="text" id="usulanId" name="usulanId" value="" /> -->
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script type="text/javascript">
    //JS halaman aktif
    document.getElementById("katalog-link").classList.add("active");
    document.getElementById("dropdown-aset").classList.add("active");
</script>

<script type="text/javascript">
    //document function
    $(document).ready(function() {
        //JQuery Pencarian Berdasarkan Kriteria
        $('#table_id4').DataTable({
            language: {
                search: "Cari di tabel:",
                zeroRecords: "Data tidak tersedia",
            }
        });
        $('#table_id3').DataTable({
            language: {
                search: "Cari di tabel:",
                zeroRecords: "Data tidak tersedia",
            }
        });
        $('#table_id2').DataTable({
            language: {
                search: "Cari di tabel:",
                zeroRecords: "Data tidak tersedia",
            }
        });
        $('#table_id').DataTable({
            language: {
                search: "Cari di tabel:",
                zeroRecords: "Data tidak tersedia",
            },
            //kriteria column 0 nama tipe input
            initComplete: function() {
                this.api().columns([1]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select2" style="margin-bottom:10px; width:100%;"><option value="">Filter Nama Kategori</option></select>')
                        // .appendTo($(column.header()).empty())
                        .appendTo($(".column-search"))
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
                this.api().columns([2]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control select" placeholder="Filter Nama Katalog" style="margin-bottom: 10px; margin-top: 10px;"></input>')
                        .appendTo($(".column-search"))
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
<script type="text/javascript">
    // onclick btn delete, show modal
    $(document).on("click", ".open-delete", function() {
        /* passing data dari view button detail ke modal */
        var thisDataUsulan = $(this).data('id');
        $(".modal-footer #usulanId").val(thisDataUsulan);
    });

    // onclick btn edit, show modal
    $(document).on("click", ".open-edit", function() {
        /* passing data dari view button detail ke modal */
        var thisDataUsulan = $(this).data('id');
        $(".modal-footer #usulanId").val(thisDataUsulan);
        var linkDetail = "{{ route('home') }}/aset/usulan/detail/" + thisDataUsulan;
        $.get(linkDetail, function(data) {
            //deklarasi var obj JSON data detail anggota
            var obj = data;
            var kategori = obj.kategori;
            var pengusul = obj.pengusul;
            var pengelola = obj.pengusul;
            // ganti elemen pada dokumen html dengan hasil data json dari jquery
            $("#editNama").val(obj.nama);
            $("#editJenis").val(obj.id_jenis);
            $("#editKategori").ready(function() {
                var jenis = $(editJenis).val();
                if (jenis) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('home') }}/aset/kategori/get/" + jenis,
                        success: function(res) {
                            if (res) {
                                $.each(res, function(key, value) {
                                    $("#editKategori").append('<option value="' + key + '">' + value + '</option>');
                                });
                                $("#editKategori").val(kategori.id);
                            }
                        }
                    });
                }
            });
            $("#editJenis").change(function() {
                var jenis = $(editJenis).val();
                if (jenis) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('home') }}/aset/kategori/get/" + jenis,
                        success: function(res) {
                            if (res) {
                                $("#editKategori").empty();
                                $("#editKategori").append('<option>Pilih Kategori</option>');
                                $.each(res, function(key, value) {
                                    $("#editKategori").append('<option value="' + key + '">' + value + '</option>');
                                });
                            }
                        }
                    });
                }
            });

            $("#editJumlah").val(obj.jumlah);
            $("#editHarga").val(obj.harga);
            // $("#editDibuat").val(obj.created_at);
            // $("#editDiperbarui").val(obj.updated_at);
            // $("#editDibuatOleh").val(pengusul.nama);
            // $("#editDiperbaruiOleh").val(pengelola.nama);
            $("#editStatus").val(obj.status_usulan);
            $('#editHarga').autoNumeric('update', {
                aSign: 'Rp. '
            }); //autonumeric detailharga

            //base root project url + url dari db
            // var link_foto = "{{ route('home') }}/" + obj.link_foto;
            // $("#detailFoto").attr('src', link_foto);
            // console.log(link_foto);

            //ganti warna status
            $(".font-status").filter(function() {
                return $(this).text() === 'Pembelian Gagal';
            }).css('color', 'red');
            $(".font-status").filter(function() {
                return $(this).text() === 'Pembelian';
            }).css('color', 'black');
            $(".font-status").filter(function() {
                return $(this).text() === 'Diterima';
            }).css('color', 'green');
            //status non-aktif ubah warna merah
            $(".font-status").filter(function() {
                return $(this).text() === 'Ditolak';
            }).css('color', 'red');
            //status belum verifikasi ubah warna abu2
            $(".font-status").filter(function() {
                return $(this).text() === 'Menunggu Keputusan';
            }).css('color', '#FFC300');
        });
    });

    // onclick btn detail, show modal
    $(document).on("click", ".open-detail", function() {
        /* passing data dari view button detail ke modal */
        var thisDataUsulan = $(this).data('id');
        $(".modal-footer #usulanId").val(thisDataUsulan);
        var linkView = "{{ route('home') }}/aset/usulan/view/" + thisDataUsulan;
        $("#linkView").attr("href", linkView);
        var linkDetail = "{{ route('home') }}/aset/usulan/detail/" + thisDataUsulan;
        $.get(linkDetail, function(data) {
            //deklarasi var obj JSON data detail anggota
            var obj = data;
            //deklarasi variabel yang ada dalam objek
            var kategori = obj.kategori;
            var jenis_aset = obj.jenis_aset;
            var pengelola = obj.pengelola;
            var pengusul = obj.pengusul;
            // ganti elemen pada dokumen html dengan hasil data json dari jquery
            $("#detailNama").html(obj.nama);
            $("#detailJenis").html(jenis_aset.nama);
            $("#detailKategori").html(kategori.nama);

            $("#detailStatus").html(obj.status_usulan);
            //ganti warna status
            $(".font-status").filter(function() {
                return $(this).text() === 'Diterima';
            }).css('color', 'green');
            //status non-aktif ubah warna merah
            $(".font-status").filter(function() {
                return $(this).text() === 'Ditolak';
            }).css('color', 'red');
            //status belum verifikasi ubah warna abu2
            $(".font-status").filter(function() {
                return $(this).text() === 'Menunggu Keputusan';
            }).css('color', '#FFC300');

            $("#detailJumlah").html(obj.jumlah);
            $("#detailHarga").html(obj.harga);
            $("#detailTotal").html(obj.harga * obj.jumlah);
            $("#dibuat").html(obj.created_at);
            $("#diperbarui").html(obj.updated_at);
            $("#dibuatOleh").html(pengusul.nama);
            if (pengelola == null) {
                $("#diperbaruiOleh").html('-');
            } else {
                $("#diperbaruiOleh").html(pengelola.nama);
            }
            $('#detailHarga').autoNumeric('update', {
                aSign: 'Rp. '
            }); //autonumeric detailharga
            $('#detailTotal').autoNumeric('update', {
                aSign: 'Rp. '
            }); //autonumeric detailtotal
            //base root project url + url dari db
            // var link_foto = "{{ route('home') }}/" + obj.link_foto;
            // $("#detailFoto").attr('src', link_foto);
            // console.log(link_foto);


        });
    });

    // $('#detailTotal').autoNumeric('init');
    $(document).ready(function() {

        //onchange select jenis aset, show opsi kategori
        // $('#selectKategori').ready(function() {
        //     $.ajax({
        //         type: "get",
        //         url: "{{ route('home') }}/aset/kategori/get/" + id,
        //         success: function(res) {
        //             if (res) {
        //                 $("#id_kategori").empty();
        //                 $("#id_kategori").append('<option>Pilih Kategori</option>');
        //                 $.each(res, function(key, value) {
        //                     $("#id_kategori").append('<option value="' + key + '">' + value + '</option>');
        //                 });
        //             }
        //         }
        //     });

        // });
        //ganti ukuran show entry
        $(".custom-select").css('width', '82px');

        //status aktif bold
        $(".font-status").css('font-weight', 'bold');

        /* ganti warna sesuai status */
        //status aktif ubah warna hijau
        $(".font-status").filter(function() {
            return $(this).text() === 'Diterima';
        }).css('color', 'green');
        //status non-aktif ubah warna merah
        $(".font-status").filter(function() {
            return $(this).text() === 'Ditolak';
        }).css('color', 'red');
        //status belum verifikasi ubah warna abu2
        $(".font-status").filter(function() {
            return $(this).text() === 'Menunggu Keputusan';
        }).css('color', '#FFC300');
    });
</script>
@include('layouts.footer')