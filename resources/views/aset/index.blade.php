@include('layouts.header')
@include('layouts.navbar')
<<<<<<< HEAD
=======
<!-- Main Content -->
<!-- <script type="text/javascript" src="{{asset('public/dist/assets/js/page/bootstrap-modal.js')}}"></script> -->
<?php

//hide untuk selain sekretaris dan ketua
// $inside_pengelola = in_array(Auth::user()->id, $list_pengelola);
?>
>>>>>>> first commit
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
<<<<<<< HEAD
            @include('aset.data_tab')
=======
>>>>>>> first commit
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="filter-box" class="collapse">
                        <div class="card-body">
                            <h6 style="text-align:center"><i class="fa fa-filter"></i> Filter Data</h6>
<<<<<<< HEAD
                            <div id="filter-nama" style="margin:10px"></div>
                            <div id="filter-kategori" style="margin:10px"></div>
                            <div id="filter-jumlah" style="margin:10px"></div>
=======
                            <div id="filter-kode" style="margin:10px"></div>
                            <div id="filter-nama" style="margin:10px"></div>
                            <div id="filter-kategori" style="margin:10px"></div>
                            <div id="filter-pencatatan" style="margin:10px"></div>
                            <div id="filter-jumlah" style="margin:10px"></div>
                            <div id="filter-status" style="margin:10px"></div>
                            <div id="filter-lokasi" style="margin:10px"></div>
>>>>>>> first commit
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table id="table_aset" class="table table-striped table-bordered">
                        <thead>
                            <tr>
<<<<<<< HEAD
                                <th id="th_no_aset">No</th>
                                <th id="th_nama_aset">Nama Barang</th>
                                <th id="th_kategori_aset">Kategori</th>
                                <th id="th_nilai_aset">Jumlah</th>
                                <th id="th_action_btn">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($katalogGroup as $katalog)
                            <tr data-child-value="{{ $katalog->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $katalog->nama_barang }}</td>
                                @if ($katalog->kategori != null)
                                <td>{{ $katalog->kategori->nama }}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>{{ $katalog->jumlah }}</td>
                                <td><a href="{{ route('asetIndex') }}/katalog/{{ $katalog->id }}" class="btn btn-sm btn-primary"><i class="fa fa-boxes"></i> Daftar Barang</a></td>
=======
                                <th>-</th>
                                <th id="th_no_aset">No</th>
                                <th id="th_kode_aset">Kode Aset</th>
                                <th id="th_nama_aset">Nama Barang</th>
                                <th id="th_kategori_aset">Kategori</th>
                                <th id="th_pencatatan">Pencatatan</th>
                                <th id="th_nilai_aset">Jumlah</th>
                                <th id="th_status_aset">Status</th>
                                <th id="th_lokasi_aset">Lokasi</th>
                                <th id="th_action_aset" style="width:6em;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asetGroup as $aset)
                            <tr data-child-value="{{ $aset->id }}">
                                <td class="details-control"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $aset->kode }}</td>
                                <td>{{ $aset->nama }}</td>
                                @if ($aset->kategori != null)
                                <td>{{ $aset->kategori->nama }}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>{{ $aset->tgl_pencatatan->isoFormat('LL') }}</td>
                                <td>{{ $aset->jumlah }}</td>
                                <td>{{ $aset->status }}</td>
                                @if ($aset->lokasi != null)
                                <td>{{ $aset->lokasi->nama }}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <a href="{{ route('home').'/aset/detail/'.$aset->id }}" class="btn btn-icon btn-sm btn-info" style="width: 7em; margin: 2px;"><i class="fas fa-info-circle"></i> Detail</a>
                                        <a href="#" class="btn btn-icon btn-sm btn-primary open-update" style="width: 7em; margin: 2px;" data-toggle="modal" data-id="{{ $aset->id }}" data-nama="{{ $aset->nama }}" data-kategori="{{ $aset->id_kategori }}" data-status="{{ $aset->status }}" data-lokasi="{{ $aset->id_lokasi }}" data-jumlah="{{ $aset->jumlah }}" data-harga_satuan="{{ $aset->harga_satuan }}" data-target="#updateModal"><i class="fas fa-sync"></i> Perbarui</a>
                                        <!-- <a href="#" class="btn btn-icon btn-sm btn-danger" style="width: 7em; margin: 2px;" data-toggle="modal" data-id="{{ $aset->id }}" data-target="#lepasModal"><i class="fas fa-recycle"></i> Lepas</a> -->
                                    </div>
                                </td>
>>>>>>> first commit
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<<<<<<< HEAD
=======

<!-- Modal Perbarui -->
<div class="modal fade" tabindex="-1" role="dialog" id="updateModal">
    <div class="modal-dialog" role="document">
        <form action="{{ route('asetUpdate') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perbarui Data Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama-barang" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
                        <div class="col-md-6">
                            <input id="nama-update" type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori-update" class="col-md-4 col-form-label text-md-right">Kategori</label>
                        <div class="col-md-6">
                            <select id="kategori-update" name="id_kategori" class="form-control select" style="width: 100%">
                                @foreach ($kategoriGroup as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->kode }} | {{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi-update" class="col-md-4 col-form-label text-md-right">Lokasi</label>
                        <div class="col-md-6">
                            <select id="lokasi-update" name="id_lokasi" class="form-control select" style="width:100%;">
                                @foreach ($lokasiGroup as $lokasi)
                                <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah-update" class="col-md-4 col-form-label text-md-right">Jumlah</label>
                        <div class="col-md-6">
                            <input type="number" name="jumlah" id="jumlah-update" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah-update" class="col-md-4 col-form-label text-md-right">Jumlah</label>
                        <div class="col-md-6">
                            <input name="harga_satuan" id="harga_satuan-update" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <input type="text" id="id-update" name="id" value="" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <input type="submit" value="Simpan" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
</div>
</div>

>>>>>>> first commit
<!-- SCRIPT -->
<script type="text/javascript">
    //JS halaman aktif
    document.getElementById("aset-link").classList.add("active");
</script>

<script type="text/javascript">
    function printDiv(id) {
        var div_id = "qr-label-" + id;
        var input_print = "print-input-qr-" + id;
        var num = document.getElementById(input_print).value;
        if (num == null || num == 0 || num < 0) {
            num = 1;
        }
        var divToPrint = document.getElementById(div_id);
        var newWin = window.open('', 'Print-window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">');
        for (i = 0; i < num; i++) {
            newWin.document.write(divToPrint.innerHTML);
        }
        newWin.document.write('</body></html>');

        newWin.document.close();
        setTimeout(function() {
            newWIn.close();
        }, 10);
    }

<<<<<<< HEAD
    //document function
    $(document).ready(function() {
        $("#menu_index").addClass("active");
        $("#katalog-tab").addClass("active");
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

=======
    function status_colorized() {
        //status aktif bold
        $(".font-status").css('font-weight', 'bold');
        //ganti warna status
        $(".font-status").filter(function() {
            return $(this).text() === 'Pembelian Gagal';
        }).css('color', 'red');
        $(".font-status").filter(function() {
            return $(this).text() === 'Tidak Terdaftar';
        }).css('color', 'red');

        //warna biru
        $(".font-status").filter(function() {
            return $(this).text() === 'Dalam Proses';
        }).css('color', 'blue');

        //warna hijau
        $(".font-status").filter(function() {
            return $(this).text() === 'Disetujui';
        }).css('color', 'green');
        $(".font-status").filter(function() {
            return $(this).text() === 'Selesai';
        }).css('color', 'green');

        //warna merah
        $(".font-status").filter(function() {
            return $(this).text() === 'Ditolak';
        }).css('color', 'red');
        $(".font-status").filter(function() {
            return $(this).text() === 'Gagal';
        }).css('color', 'red');

        //status kuning
        $(".font-status").filter(function() {
            return $(this).text() === 'Menunggu Keputusan';
        }).css('color', '#FFC300');
        $(".font-status").filter(function() {
            return $(this).text() === 'Menunggu Barang Diterima';
        }).css('color', '#FFC300');

    }


    function format(value) {
        var link = "{{ route('home') }}/aset/get_json/" + value;
        var d;

        // var xhReq = new XMLHttpRequest();
        // xhReq.open("GET", link, false);
        // xhReq.send(null);
        // var d = JSON.parse(xhReq.responseText);

        $.ajax({
            dataType: "json",
            url: link,
            async: false,
            success: function(result) {
                d = result;
            }
        });

        var img_link = "{{ route('home') }}/" + d.link_foto_barang;

        var m_width_height = 300;
        if ($(window).width() <= 480) {
            m_width_height = 200;
        };

        return '<table>' +
            '<tr>' +
            '<td rowspan="11">' + '<img src="' + img_link + '" alt="foto" style="max-width:' + m_width_height + 'px; max-height:' + m_width_height + 'px;">' + '</td>' +
            '<td>Kode Aset:</td>' +
            '<td>' + d.kode + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Nama Barang:</td>' +
            '<td>' + d.nama + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Kategori:</td>' +
            '<td>' + d.kategori.nama + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Pencatatan:</td>' +
            '<td>' + d.parse_tgl_pencatatan + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Jumlah:</td>' +
            '<td>' + d.jumlah + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Sumber:</td>' +
            '<td>' + d.sumber + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Status:</td>' +
            '<td>' + d.status + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Lokasi:</td>' +
            '<td>' + d.lokasi.nama + '</td>' +
            '</tr>' +
            '<tr>' +
            '</tr>' +
            '<tr>' +
            '<td>Harga Satuan:</td>' +
            '<td class="nilai_aset">' + d.harga_satuan + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Keterangan:</td>' +
            '<td>' + d.keterangan + '</td>' +
            '</tr>' +
            '</table>';
    }

    //document function
    $(document).ready(function() {
        $("#menu_index").addClass("active");
        $(".custom-select").css('width', '82px');

>>>>>>> first commit
        //JQuery Pencarian Berdasarkan Kriteria


        //init table dynamic 
        //mobile and desktop
        var scroll_table = false;
        if ($(window).width() <= 760) {
            scroll_table = true;
        }
        var table = $('#table_aset').DataTable({
<<<<<<< HEAD
            pageLength: 50,
=======
            columnDefs: [{
                "orderable": false,
                "targets": 0
            }],
            pageLength: 25,
>>>>>>> first commit
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    messageTop: 'Data Aset',
<<<<<<< HEAD
                    exportOptions: {
                        columns: [0, 1, 2, 3]
=======
                    orientation: 'landscape',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
>>>>>>> first commit
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    messageTop: 'Data Aset',
                    exportOptions: {
<<<<<<< HEAD
                        columns:  [0, 1, 2, 3]
=======
                        columns: [1, 2, 3, 4, 5, 6, 7]
>>>>>>> first commit
                    },
                    customize: function(win) {

                        var last = null;
                        var current = null;
                        var bod = [];

<<<<<<< HEAD
                        var css = '@page { size: potrait; }',
=======
                        var css = '@page { size: landscape; }',
>>>>>>> first commit
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
<<<<<<< HEAD
=======
            "order": [
                [1, 'asc']
            ],
>>>>>>> first commit
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            },
            //kriteria column 0 nama tipe input
            initComplete: function() {
                //kriteria column 0 nama tipe select
<<<<<<< HEAD
                this.api().columns([1]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Nama Barang" style="margin-bottom:10px;"></input>')
=======
                this.api().columns([2]).every(function() {
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
                this.api().columns([3]).every(function() {
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Nama Aset" style="margin-bottom:10px;"></input>')
>>>>>>> first commit
                        .appendTo($("#filter-nama"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
<<<<<<< HEAD
                this.api().columns([2]).every(function() {
=======
                this.api().columns([4]).every(function() {
>>>>>>> first commit
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
<<<<<<< HEAD
                this.api().columns([3]).every(function() {
=======
                this.api().columns([5]).every(function() {
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
                this.api().columns([6]).every(function() {
>>>>>>> first commit
                    var column = this;
                    var input = $('<input class="form-control" placeholder="Jumlah" style="margin-bottom:10px;"></input>')
                        .appendTo($("#filter-jumlah"))
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column
                                    .search(this.value)
                                    .draw();
                            }
                        });
                });
<<<<<<< HEAD
            }
        });

        //Android Remove Download PDF and Print Button Datatables
        if (typeof Android !== "undefined" && Android !== null) {
            $('.dt-buttons').remove();
        }
=======
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
                this.api().columns([8]).every(function() {
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
>>>>>>> first commit

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
<<<<<<< HEAD
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
=======

    // action listener click detail

>>>>>>> first commit
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
<<<<<<< HEAD
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
=======
    });
>>>>>>> first commit

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