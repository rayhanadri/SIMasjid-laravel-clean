@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<!-- <script type="text/javascript" src="{{asset('public/dist/assets/js/page/bootstrap-modal.js')}}"></script> -->
<?php

//hide untuk selain sekretaris dan ketua
// $inside_pengelola = in_array(Auth::user()->id, $list_pengelola);
$permission = app('App\Http\Controllers\Aset\PengelolaAsetController')->checkPermission();
?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div>
                <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
                    <li class="breadcrumb-item active">Usulan Aset</li>
                </ol>
            </div>
        </div>
        @include('aset.menu_aset')
        <div class="section-header">
            <h1 style="margin:auto;"><i class="fa fa-lightbulb"></i> Usulan Aset</h1>
        </div>
        <div class="section-body" style="min-height: 800px;">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <a href="#" class="btn btn-lg btn-info btn-primary open-tambah" data-toggle="modal" data-target="#tambahUsulanModal" style="margin: 20px;"><i class="fas fas fa-plus"></i> Tambah Usulan</a>
                </div>
            </div>
            @include('aset.usulan_tab')
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
                    <table id="table_usulan" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th id="th_no_usulan">No. Usulan</th>
                                <th id="th_nama_barang_usulan">Nama Barang</th>
                                <th id="th_jumlah_barang_usulan">Jumlah Barang</th>
                                <th id="th_pengusul">Pengusul</th>
                                <th id="th_keterangan_usulan">Keterangan</th>
                                <th id="th_keterangan_usulan">Status</th>
                                <th id="th_no_usulan">Tanggal Dibuat</th>
                                <th id="th_no_usulan">Tanggal Diperbarui</th>
                                @if ( $tab_active == "Ditolak" || $tab_active == "Dibatalkan")
                                <th id="th_alasan">Alasan</th>
                                @endif
                                @if ($permission == true)
                                @if ( $tab_active == "Belum Diproses" || $tab_active == "Diproses")
                                <th id="th_action_usulan" style="width: 12em;">Action</th>
                                @endif
                                @endif
                            </tr>
                        </thead>
                        @foreach ($usulanGroup as $usulan)
                        <tbody>
                            <tr>
                                <td id="td_no_usulan">{{ $usulan->id }}</td>
                                <td id="td_nama_barang_usulan">{{ $usulan->nama_barang }}</td>
                                <td id="td_jumlah_barang_usulan">{{ $usulan->jumlah }}</td>
                                @if($usulan->pengusul)
                                <td id="td_pengusul">{{ $usulan->pengusul->nama }}</td>
                                @else
                                <td id="td_pengusul">-</td>
                                @endif
                                <td id="td_keterangan_usulan">{{ $usulan->keterangan_usulan }}</td>
                                <td id="td_status_usulan">{{ $usulan->status }}</td>
                                <td id="td_tgl_terjadwal">{{ $usulan->tgl_dibuat->isoFormat('LL') }}</td>
                                <td id="td_tgl_terjadwal">{{ $usulan->tgl_diperbarui->isoFormat('LL') }}</td>
                                @if ( $tab_active == "Ditolak" || $tab_active == "Dibatalkan")
                                <td id="td_alasan">{{ $usulan->alasan }}</td>
                                @endif
                                @if ($permission == true)
                                @if ( $tab_active == "Belum Diproses" || $tab_active == "Diproses")
                                @if ( $usulan-> status == "Belum Diproses")
                                <td id="td_btn">
                                    <div class="btn-group-vertical mb-3" role="group">
                                        <a href="#" class="open-terima btn btn-icon btn-sm btn-primary" data-toggle="modal" data-id="{{ $usulan->id }}" data-target="#terimaModal"><i class="fas fa-forward"></i> Proses Usulan</a>
                                        <a href="#" class="open-tolak btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $usulan->id }}" data-target="#tolakModal"><i class="fas fa-times"></i></i> Tolak Usulan</a>
                                    </div>
                                </td>
                                @endif
                                @if ( $usulan-> status == "Diproses")
                                <td id="td_btn">
                                    <div class="btn-group-vertical mb-3" role="group">
                                        <a href="#" class="open-selesai btn btn-icon btn-sm btn-primary" data-toggle="modal" data-id="{{ $usulan->id }}" data-target="#selesaiModal"><i class="fas fa-check"></i> Selesaikan Usulan</a>
                                        <a href="#" class="open-batal btn btn-icon btn-sm btn-danger" data-toggle="modal" data-id="{{ $usulan->id }}" data-target="#batalModal"><i class="fas fa-times"></i></i> Batalkan Usulan</a>
                                    </div>
                                </td>
                                @endif
                                @endif
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
<!-- Modal Tolak -->
<div class="modal fade" tabindex="-1" role="dialog" id="tolakModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Usulan Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/cancel.svg" id="detailFoto" class="mx-auto d-block" alt="tolak image" style="width:150px; height:150px;overflow: hidden;">
                <h5 align="center">Apakah Anda yakin ingin menolak usulan aset ini?</h5>
                <form action="{{ route('asetUsulanTolak') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="alasan" class="col-md-4 col-form-label text-md-right">Alasan Penolakan</label>
                        <div class="col-md-6">
                            <textarea id="alasan" class="form-control" name="alasan" style="height:82px;" placeholder="Rincian alasan penolakan" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="text" id="id_tolak" name="id" value="" hidden />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <input type="submit" value="Ya, Tolak" class="btn btn-danger" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal Batal -->
<div class="modal fade" tabindex="-1" role="dialog" id="batalModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Batalkan Usulan Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/cancel.svg" id="detailFoto" class="mx-auto d-block" alt="tolak image" style="width:150px; height:150px;overflow: hidden;">
                <h5 align="center">Apakah Anda yakin ingin membatalkan usulan aset ini?</h5>
                <form action="{{ route('asetUsulanBatal') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="alasan" class="col-md-4 col-form-label text-md-right">Alasan Pembatalan</label>
                        <div class="col-md-6">
                            <textarea id="alasan" class="form-control" name="alasan" style="height:82px;" placeholder="Rincian alasan pembatalan" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="text" id="id_batal" name="id" value="" hidden />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <input type="submit" value="Ya, Batalkan" class="btn btn-danger" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal Proses -->
<div class="modal fade" tabindex="-1" role="dialog" id="terimaModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Proses Usulan Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/checked.svg" id="detailFoto" class="mx-auto d-block" alt="verif image" style="width:150px; height:150px;overflow: hidden;">
                <h5 align="center">Apakah Anda yakin ingin memproses usulan aset ini?</h5>
                <form action="{{ route('asetUsulanProses') }}" method="post">
                    @csrf
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <input type="text" id="id_terima" name="id" value="" hidden />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <input type="submit" value="Ya, Proses Usulan" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Selesai -->
<div class="modal fade" tabindex="-1" role="dialog" id="selesaiModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Menyelesaikan Usulan Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ route('home') }}/public/dist/assets/img/svg/checked.svg" id="detailFoto" class="mx-auto d-block" alt="verif image" style="width:150px; height:150px;overflow: hidden;">
                <h5 align="center">Apakah Anda yakin usulan aset ini sudah selesai?</h5>
                <form action="{{ route('asetUsulanSelesai') }}" method="post">
                    @csrf
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <input type="text" id="id_selesai" name="id" value="" hidden />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <input type="submit" value="Ya, Usulan Selesai" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahUsulanModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Usulan Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('asetUsulanCreate') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" placeholder="Nama Barang" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Jumlah</label>
                        <div class="col-md-6">
                            <input id="jumlah" type="number" class="form-control" name="jumlah" placeholder="Jumlah" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Keterangan</label>
                        <div class="col-md-6">
                            <textarea id="keterangan" type="text" class="form-control" name="keterangan" placeholder="Keterangan detail barang usulan" style="height: 82px;"></textarea>
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

<!-- SCRIPT -->
<script type="text/javascript">
    // onclick verif, show modal
    $(document).on("click", ".open-tolak", function() {
        /* passing data dari view button detail ke modal */
        var thisDataUsulan = $(this).data('id');
        $("#id_tolak").val(thisDataUsulan);
    });
    // onclick verif, show modal
    $(document).on("click", ".open-batal", function() {
        /* passing data dari view button detail ke modal */
        var thisDataUsulan = $(this).data('id');
        $("#id_batal").val(thisDataUsulan);
    });
    // onclick verif, show modal
    $(document).on("click", ".open-terima", function() {
        /* passing data dari view button detail ke modal */
        var thisDataUsulan = $(this).data('id');
        $("#id_terima").val(thisDataUsulan);
    });
    // onclick verif, show modal
    $(document).on("click", ".open-selesai", function() {
        /* passing data dari view button detail ke modal */
        var thisDataUsulan = $(this).data('id');
        $("#id_selesai").val(thisDataUsulan);
    });


    //document function
    $(document).ready(function() {
        $('#menu_usulan').addClass('active');
        //read tab active
        var tab = "{{ $tab_active }}";
        switch (tab) {
            case "Belum Diproses":
                $("#belum-diproses-tab").addClass("active");
                break;
            case "Diproses":
                $("#diproses-tab").addClass("active");
                break;
            case "Selesai":
                $("#selesai-tab").addClass("active");
                break;
            case "Ditolak":
                $("#ditolak-tab").addClass("active");
                break;
            case "Dibatalkan":
                $("#dibatalkan-tab").addClass("active");
                break;
            default:
                break;
        }
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
        var table = $('#table_usulan').DataTable({
            "scrollX": scroll_table,
            "lengthChange": false,
            "pageLength": 50,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Kata Kunci Pencarian...",
                zeroRecords: "Data tidak tersedia",
            }
        });
    });
</script>
@include('layouts.footer')