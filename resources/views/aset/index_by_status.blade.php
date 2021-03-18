@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<!-- <script type="text/javascript" src="{{asset('public/dist/assets/js/page/bootstrap-modal.js')}}"></script> -->
<?php
//check permission pengelola
$permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission();
//hide untuk selain sekretaris dan ketua
// $inside_pengelola = in_array(Auth::user()->id, $list_pengelola);
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                <li class="breadcrumb-item active">Manajemen Aset</li>
            </ol>
        </div>
        @include('aset.menu_aset')
        <div class="section-header">
            <h1 style="margin:auto;"><i class="fa fa-table"></i> Data Aset</h1>
            <div></div>
        </div>
        <div class="section-body" style="min-height: 800px;">
            @include('aset.data_tab')
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="filter-box">
                        <div class="card-body">
                            <div id="filter-nama" style="margin:10px"></div>
                            <div id="filter-kategori" style="margin:10px"></div>
                            <div id="filter-lokasi" style="margin:10px"></div>
                        </div>
                    </div>
                    <table id="table_aset" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th id="th_no_aset">No</th>
                                <th id="th_kode_aset">Kode Aset</th>
                                <th id="th_nama_aset">Nama Barang</th>
                                <th id="th_kategori_aset">Kategori</th>
                                <th id="th_pencatatan">Tanggal Pendaftaran</th>
                                <th id="th_last_update">Tanggal Terakhir Update</th>
                                <th id="th_merek_aset">Merek</th>
                                <th id="th_tipe_aset">Tipe</th>
                                <th id="th_status_aset">Status</th>
                                <th id="th_lokasi_aset">Lokasi</th>
                                <th id="th_action_aset" style="width:6em;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asetGroup as $aset)
                            <tr data-child-value="{{ $aset->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $aset->kode }}</td>
                                <td>{{ $aset->katalog->nama_barang }}</td>
                                @if ($aset->katalog->kategori != null)
                                <td>{{ $aset->katalog->kategori->nama }}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>{{ $aset->tgl_pendaftaran->isoFormat('LL') }}</td>
                                <td>{{ $aset->tgl_diperbarui->isoFormat('LL') }}</td>
                                <td>{{ $aset->merek }}</td>
                                <td>{{ $aset->tipe }}</td>
                                <td>{{ $aset->status }}</td>
                                @if ($aset->lokasi != null)
                                <td>{{ $aset->lokasi->nama }}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>
                                    <a class="btn btn-icon icon-left btn-info" href="{{ route('home').'/aset/detail/'.$aset->id }}"><i class="fas fa-info-circle"></i> Detail</a>
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
<!-- SCRIPT -->
<script type="text/javascript">
    //JS halaman aktif
    document.getElementById("aset-link").classList.add("active");
</script>

<script type="text/javascript">
    //document function
    $(document).ready(function() {
        $("#menu_index").addClass("active");
        //read tab active
        var tab = "{{ $tab_active }}";
        switch (tab) {
            case "Baik":
                $("#baik-tab").addClass("active");
                break;
            case "Rusak":
                $("#rusak-tab").addClass("active");
                break;
            case "Diperbaiki":
                $("#diperbaiki-tab").addClass("active");
                break;
            case "Dipinjam":
                $("#dipinjam-tab").addClass("active");
                break;
            case "Dilepas":
                $("#dilepas-tab").addClass("active");
                break;
            default:
                break;
        }
        //
        $(".custom-select").css('width', '82px');

        $('form').submit(function() {
            var form = $(this);
            $('input').each(function(i) {
                var self = $(this);
                try {
                    var v = self.autoNumeric('get');
                    self.autoNumeric('destroy');
                    self.val(v);
                } catch (err) {
                    console.log("Not an autonumeric field: " + self.attr("name"));
                }
            });
            return true;
        });

        //JQuery Pencarian Berdasarkan Kriteria
        //init table dynamic 
        //mobile and desktop
        var scroll_table = false;
        if ($(window).width() <= 760) {
            scroll_table = true;
        }
        var table = $('#table_aset').DataTable({
            pageLength: 50,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    messageTop: 'Data Aset',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    messageTop: 'Data Aset',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    },
                    customize: function(win) {

                        var last = null;
                        var current = null;
                        var bod = [];

                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.media = 'print';

                        if (style.styleSheet) {
                            style.styleSheet.cssText = css;
                        } else {
                            style.appendChild(win.document.createTextNode(css));
                        }

                        head.appendChild(style);
                    }
                },
            ],
            "scrollX": scroll_table,
            "lengthChange": false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            },
            //kriteria column 0 nama tipe input
            initComplete: function() {
                //kriteria column 0 nama tipe select
                this.api().columns([1]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Kode Aset" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-kode"))
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
                    var select = $('<select class="form-control select2" id="select2-nama" style="margin: 5px; width:100%;"><option value="">Nama Barang</option></select>')
                        .appendTo($("#filter-nama"))
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
                this.api().columns([4]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Pencatatan" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-pencatatan"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                this.api().columns([5]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Merek" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-merek"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                this.api().columns([6]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Tipe/Model" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-tipe"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
                this.api().columns([7]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select2" id="select2-status" style="margin-bottom:10px; width:100%;"><option value = "">Status</option></select>')
                        // .appendTo($(column.header()).empty())
                        .appendTo($("#filter-status"))
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
                this.api().columns([9]).every(function() {
                    var column = this;
                    var select = $('<select class="form-control select2" id="select2-lokasi" style="margin-bottom:10px; width:100%;"><option value = "">Lokasi</option></select>')
                        // .appendTo($(column.header()).empty())
                        .appendTo($("#filter-lokasi"))
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

        $('#table_aset').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
                $('.nilai_aset').autoNumeric('init', {
                    aSep: '.',
                    aDec: ',',
                    aSign: 'Rp. ',
                    mDec: '0'
                });

            }
        });

        //Android Remove Download PDF and Print Button Datatables
        if (typeof Android !== "undefined" && Android !== null) {
            $('.dt-buttons').remove();
        }

        //mobile
        if ($(window).width() <= 595) {
            $('#th_no_aset').hide();
            $('#th_kategori_aset').hide();
            $('#th_status_aset').hide();
            table.columns([1, 4, 5, 6, 7]).visible(false);
            $('.section-body').css({
                "padding": "0px"
            });
        }

        //tab or mobile landscape
        if ($(window).width() < 1280 && $(window).width() > 480) {
            table.columns([6, 7]).visible(false);
        }
    });
    /* open action button listener */
    // action listener button
    $(document).on("click", ".open-pinjam", function() {
        /* passing data dari view button detail ke modal */
        var id_aset = $(this).data('id');
        var nama_barang = $(this).data('nama');
        var kode_aset = $(this).data('kode');
        var jumlah = $(this).data('jumlah');
        $("#id-aset-pinjam").val(id_aset);
        $("#nama-barang-pinjam").val(nama_barang);
        $("#kode-aset-pinjam").val(kode_aset);
        $("#jumlah-pinjam").val(jumlah);
        $("#max-jumlah-pinjam").html(jumlah);
    });
    $(document).on("click", ".open-update", function() {
        /* passing data dari view button detail ke modal */
        var this_id = $(this).data('id');
        $(".modal-footer #id-update").val(this_id);
        var this_nama = $(this).data('nama');
        $("#nama-update").val(this_nama);
        var this_kategori = $(this).data('kategori');
        $("#kategori-update").val(this_kategori);
        $('#kategori-update').select2({
            dropdownParent: $('#updateModal')
        });
        var this_lokasi = $(this).data('lokasi');
        $("#lokasi-update").val(this_lokasi);
        $('#lokasi-update').select2({
            dropdownParent: $('#updateModal')
        });
        var this_jumlah = $(this).data('jumlah');
        $("#jumlah-update").val(this_jumlah);
        var this_harga_satuan = $(this).data('harga_satuan');
        $("#harga_satuan-update").val(this_harga_satuan);
        //autoNumeric
        $(".harga").autoNumeric('update', {
            aSep: '.',
            aDec: ',',
            aSign: 'Rp. ',
            mDec: '0'
        });
    });
    $(document).on("click", ".open-perbaikan", function() {
        /* passing data dari view button detail ke modal */
        var id_aset = $(this).data('id');
        var nama_barang = $(this).data('nama');
        var kode_aset = $(this).data('kode');
        var jumlah = $(this).data('jumlah');
        $("#id-aset-perbaikan").val(id_aset);
        $("#nama-barang-perbaikan").val(nama_barang);
        $("#kode-aset-perbaikan").val(kode_aset);
        $("#jumlah-perbaikan").val(jumlah);
        $("#max-jumlah-perbaikan").html(jumlah);
    });
    $(document).on("click", ".open-lepas", function() {
        /* passing data dari view button detail ke modal */
        var id_aset = $(this).data('id');
        var nama_barang = $(this).data('nama');
        var kode_aset = $(this).data('kode');
        var jumlah = $(this).data('jumlah');
        $("#id-aset-lepas").val(id_aset);
        $("#nama-barang-lepas").val(nama_barang);
        $("#kode-aset-lepas").val(kode_aset);
        $("#jumlah-lepas").val(jumlah);
        $("#max-jumlah-lepas").html(jumlah);
    });

    /* close action button listener */

    $(document).on("click", "#filter-btn", function() {
        $('#filter-box').show();
    });

    //autoNumeric
    $(".td_nilai_aset").autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aSign: 'Rp. '
    });
</script>
@include('layouts.footer')