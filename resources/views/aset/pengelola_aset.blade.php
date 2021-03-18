@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<!-- <script type="text/javascript" src="{{asset('public/dist/assets/js/page/bootstrap-modal.js')}}"></script> -->
<?php
/* PHP UNTUK PENGATURAN VIEW */
//anggota terautentikasi
$authUser = Auth::user();
//hide untuk selain sekretaris dan ketua
$sekretaris = array(1, 2);
$inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);
?>

<div class="main-content">
    <section class="section">
        <div class="row">
            <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
                <li class="breadcrumb-item active">Pengelola Aset</li>
            </ol>
        </div>
        @include('aset.menu_aset')
        <div class="section-header">
            <div class="row" style="margin:auto;">
                <div class="col-12">
                    <h1 style="margin:auto;"><i class="fa fa-users-cog"></i> Pengelola Aset</h1>
                </div>
            </div>
        </div>
        <div class="section-body" style="min-height: 300px; padding:20px;">
            <div class="row">
                <button style="margin: 1em auto;" class="btn btn-dark" data-toggle="collapse" data-target="#filter-box">
                    <i class="fa fa-filter"></i> Show/Close Filter Data
                </button>
                <div class="col-12">
                    <div id="filter-box" class="collapse">
                        <div class="card-body">
                            <h6 style="text-align:center"><i class="fa fa-filter"></i> Filter Data</h6>
                            <div class="column-search"></div>
                        </div>
                    </div>
                </div>
            </div>
            @if($inside_sekretaris)
            <div class="row">
                <div class="wrapper" style="text-align: center; margin: 10px;">
                    <a href="#" class="btn btn-lg btn-info btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fas fas fa-user-plus"></i> Tambah Pengelola Aset</a>
                    <!-- <button class="btn btn-lg btn-info btn-primary" style="margin: auto;"><i class="fas fa-user-plus"></i> Tambah Pengelola Aset</button> -->
                </div>
            </div>
            @endif
            <table id="table_id" class="table table-striped table-bordered" style="padding-bottom:20px;">
                <thead>
                    <tr>
                        <th class="dt-center">No</th>
                        <th class="dt-center">Nama</th>
                        <th class="dt-center">Jabatan</th>
                        <th class="dt-center">Status</th>
                        <th class="dt-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($pengelolaGroup))
                    @foreach ($pengelolaGroup as $pengelola)
                    <tr>
                        <td class="dt-center">{{ $loop->iteration }}</td>
                        <td>{{ $pengelola->nama }}</td>
                        <td>{{ $pengelola->jabatan }}</td>
                        <td class="font-status">{!!$pengelola->status!!}</td>
                        <td class="dt-center">
                            <div class="btn-group mb-3" role="group" aria-label="Basic example" style="padding-left: 20px;">
                                <a href="#" class="open-detail btn btn-icon btn-sm btn-info" data-toggle="modal" data-id="{{ $pengelola->id_anggota }}" data-target="#detailModal"><i class="fas fa-id-badge"></i> Detail</a>
                                @if($inside_sekretaris)
                                <a href="#" class="open-delete btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $pengelola->id }}" data-target="#deleteModal"><i class="fas fa-times"></i> Hapus Akses</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>


    </section>
</div>

<!-- Modal Detail -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="detailFoto" class="img-thumbnail rounded mx-auto d-block" alt="foto profil" style="max-width:250px; overflow: hidden;">
                <table class="table table-borderless" style="width:90%; margin: auto;">
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td id="detailNama"></td>
                        </tr>
                        <tr>
                            <th scope="row">Jabatan</th>
                            <td id="detailJabatan"></td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td class="font-status" id="detailStatus"></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td id="detailEmail"></td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat</th>
                            <td id="detailAlamat"></td>
                        </tr>
                        <tr>
                            <th scope="row">Telp/HP</th>
                            <td id="detailTelp"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Akses Pengelola Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/cancel.svg" id="detailFoto" class="mx-auto d-block" alt="hapus image" style="width:150px; height:150px;overflow: hidden;">
                <h5 align="center">Apakah Anda yakin ingin menghapus akses Pengelola Aset pengguna ini?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('asetPengelolaAsetDelete') }}" method="post">
                    @csrf
                    <input type="text" id="id_delete" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Hapus" class="btn btn-danger submit-btn" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
    <div class="modal-dialog" role="document">
        <form action="{{ route('asetPengelolaAsetCreate') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengelola Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup.">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table style="width:100%; margin: auto;">
                        <tbody>
                            <th>Pilih Anggota Takmir atau Remas</th>
                            <tr>
                                <td><select id="editJabatan" name="id_anggota" class="form-control select2" style="width:100%; margin: auto;">
                                        <?php foreach ($bukanPengelolaGroup as $bukanPengelola) {
                                            echo '<option value="' . $bukanPengelola->id . '">' . $bukanPengelola->nama . '</option>';
                                        } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <input type="submit" value="Pilih Pengelola Aset" class="btn btn-warning" />
                </div>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script type="text/javascript">
    //JQuery DataTables Pencarian Berdasarkan Kriteria
    $(document).ready(function() {
        $('#menu_pengelola_aset').addClass('active');
        $scroll_table = false;
        if ($(window).width() <= 480) {
            $scroll_table = true;
        }
        $('#table_id').DataTable({
            scrollX: $scroll_table,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            },
            //kriteria column 0 nama tipe input
            initComplete: function() {
                this.api().columns([1]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control select" placeholder="Nama..." style="margin-bottom:10px;"></input>')
                        .appendTo($(".column-search"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                //kriteria column 0 nama tipe select
                this.api().columns([2]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select" style="margin-bottom:10px;"><option value="">Jabatan...</option></select>')
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
                this.api().columns([3]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select" style="margin-bottom:10px;"><option value="">Status...</option></select>')
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
            }
        });
    });

    $('form').submit(function() {
        $('.submit-btn').prop( "disabled", true );
    });

    // onclick btn delete, show modal
    $(document).on("click", ".open-delete", function() {
        /* passing data dari view button detail ke modal */
        var thisDataAnggota = $(this).data('id');
        $(".modal-footer #id_delete").val(thisDataAnggota);
    });

    // onclick btn detail, show modal
    $(document).on("click", ".open-detail", function() {
        /* passing data dari view button detail ke modal */
        var thisDataAnggota = $(this).data('id');
        // $(".modal-body #id").val(thisDataAnggota);
        var linkDetail = "{{ route('home') }}/anggota/detail/" + thisDataAnggota;
        $.get(linkDetail, function(data) {
            //deklarasi var obj JSON data detail anggota
            var obj = data;
            // ganti elemen pada dokumen html dengan hasil data json dari jquery
            $("#detailNama").html(obj.nama);
            $("#detailJabatan").html(obj.jabatan);
            $("#detailStatus").html(obj.status);
            $("#detailEmail").html(obj.email);
            $("#detailAlamat").html(obj.alamat);
            $("#detailTelp").html(obj.telp);

            //base root project url + url dari db
            var link_foto = "{{ route('home') }}/" + obj.link_foto;
            $("#detailFoto").attr('src', link_foto);
            // console.log(link_foto);

            status_colorized();
        });
    });

    $(document).ready(function() {
        //ganti ukuran show entry
        $(".custom-select").css('width', '82px');
        status_colorized();
    });

    function status_colorized() {
        //status aktif bold
        $(".font-status").css('font-weight', 'bold');
        /* ganti warna sesuai status */
        //status aktif ubah warna hijau
        $(".font-status").filter(function() {
            return $(this).text() === 'Aktif';
        }).css('color', 'green');
        //status non-aktif ubah warna merah
        $(".font-status").filter(function() {
            return $(this).text() === 'Non-Aktif';
        }).css('color', 'red');
        //status belum verifikasi ubah warna abu2
        $(".font-status").filter(function() {
            return $(this).text() === 'Belum Verifikasi';
        }).css('color', '#dbcb18');
    }
</script>
@include('layouts.footer')