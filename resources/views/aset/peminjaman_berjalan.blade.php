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
                                <th id="th_action_peminjaman" style="width: 12em;">Action</th>
                            </tr>
                        </thead>
                        @foreach ($peminjamanGroup as $peminjaman)
                        <tbody>
                            <tr>
                                <td id="td_no_peminjaman">{{ $peminjaman->id }}</td>
                                <td id="td_nama_barang_peminjaman">{{ $peminjaman->barang->kode }}</td>
                                <td id="td_kode_barang_peminjaman">{{ $peminjaman->barang->nama }}</td>
                                <td id="td_jumlah_peminjaman">{{ $peminjaman->jumlah }}</td>
                                <td id="td_pembuat_peminjaman">{{ $peminjaman->pembuat->nama }}</td>
                                <td id="td_nama_peminjam">{{ $peminjaman->nama_peminjam }}</td>
                                <td id="td_telp_peminjam">{{ $peminjaman->telp_peminjam }}</td>
                                <td id="td_keterangan_peminjaman">{{ $peminjaman->keterangan }}</td>
                                <td id="td_tgl_peminjaman">{{ $peminjaman->tgl_dibuat }}</td>
                                <td id="td_btn">
                                    <div class="btn-group-vertical mb-3" role="group">
                                        <a href="#" class="btn btn-icon btn-sm btn-secondary" onclick="printBukti(['{{ $peminjaman->id }}', '{{ $peminjaman->barang->kode }}', '{{ $peminjaman->barang->nama }}', '{{ $peminjaman->jumlah }}', '{{ $peminjaman->tgl_dibuat }}', '{{ $peminjaman->pembuat->nama }}', '{{ $peminjaman->nama_peminjam }}', '{{ $peminjaman->telp_peminjam }}', '{{ $peminjaman->keterangan }}'])"><i class="fas fa-print"></i> Print Bukti</a>
                                        <a href="#" class="open-selesai btn btn-icon btn-sm btn-primary" data-toggle="modal" data-id="{{ $peminjaman->id }}" data-target="#selesaiModal"><i class="fas fa-flag-checkered"></i> Selesaikan</a>
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
<!-- Modal Verif Terima -->
<div class="modal fade" tabindex="-1" role="dialog" id="selesaiModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menyelesaikan Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 style="text-align: center; font-size: 148px"><i class="fa fa-flag-checkered"></i></h1>
                <h5 align="center">Apakah Anda yakin ingin peminjaman ini telah selesai dan barang sudah dikembalikan?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form action="{{ route('asetPeminjamanSelesai') }}" method="post">
                    @csrf
                    <input type="text" id="id_selesai" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak, Batalkan</button>
                    <input type="submit" value="Ya, Selesaikan" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script type="text/javascript">
    // onclick verif, show modal
    $(document).on("click", ".open-selesai", function() {
        /* passing data dari view button detail ke modal */
        var thisDataPeminjaman = $(this).data('id');
        $("#id_selesai").val(thisDataPeminjaman);
    });

    function printBukti(arrayBukti) {
        var bukti =
            '<table align="center" border="0">' +
            '<tr>' +
            '<td>' +
            '<img src="{{route("home")}}/public/dist/assets/img/ibnusina.jpg" alt="logo" width="75">' +
            '</td>' +
            '<td>' +
            '<h2 align="center" > Masjid Ibnu Sina </h2>' +
            '<h3 align="center" style="text-align:center;"> Bukti Peminjaman Barang </h3>' +
            '</td>' +
            '</tr>' +
            '</table>' +
            '<hr>' +
            '<table align="center" border="1" style="text-align:center;">' +
            '<tr>' +
            '<th>Nomor Peminjaman</th>' +
            '<th>Kode Barang</th>' +
            '<th>Nama Barang</th>' +
            '<th>Jumlah Barang</th>' +
            '</tr>' +
            '<tr>' +
            '<td>' + arrayBukti[0] + '</td>' +
            '<td>' + arrayBukti[1] + '</td>' +
            '<td>' + arrayBukti[2] + '</td>' +
            '<td>' + arrayBukti[3] + '</td>' +
            '</tr>' +
            '</table>' +
            '<table align="center" border="1" style="text-align:center;">' +
            '<tr>' +
            '<th>Tanggal</th>' +
            '<th>Takmir/Remas</th>' +
            '<th>Nama Peminjam</th>' +
            '<th>Telp/HP Peminjam</th>' +
            '<th>Keterangan</th>' +
            '</tr>' +
            '<br>' +
            '<tr>' +
            '<td>' + arrayBukti[4] + '</td>' +
            '<td>' + arrayBukti[5] + '</td>' +
            '<td>' + arrayBukti[6] + '</td>' +
            '<td>' + arrayBukti[7] + '</td>' +
            '<td>' + arrayBukti[8] + '</td>' +
            '</tr>' +
            '</table>' +
            '</tr>' +
            '<br><hr style="border-top: 2px dashed;">' +
            '</div>';
        var newWin = window.open('', 'Print-window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">');
        newWin.document.write(bukti);
        newWin.document.write('</body></html>');
        newWin.document.close();
        setTimeout(function() {
            newWin.document.close();
        }, 10);
    }

    //document function
    $(document).ready(function() {
        $('#menu_peminjaman').addClass('active');
        $('#berjalan-tab').addClass('active');
        $('.bukti-peminjaman').remove();
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