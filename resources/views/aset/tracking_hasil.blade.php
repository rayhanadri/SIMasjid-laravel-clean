@include('layouts.header')
@include('layouts.navbar')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div>
        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
          <li class="breadcrumb-item"><a href="{{ route('asetTracking') }}">Tracking</a></li>
          <li class="breadcrumb-item active">Hasil Tracking</li>
          <!-- <li class="breadcrumb-item active">Usulan</li> -->
        </ol>
      </div>
    </div>
    @include('aset.menu_aset')
    <div class="row">
      <div class="col-12">
        <div class="section-header">
          <h1 style="margin: auto;"><i class="fa fa-info-circle"></i> Detail</h1>
        </div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <div class="row">
        <?php $permission = app('App\Http\Controllers\Anggota\PengelolaAsetController')->checkPermission(); ?>
        <!-- <a href="#" class="btn btn-icon btn-sm btn-primary open-update" style="width: 7em; margin-left: 20px; margin-bottom: 20px;" data-toggle="modal" data-id="{{ $aset->id }}" data-nama="{{ $aset->nama }}" data-kategori="{{ $aset->id_kategori }}" data-status="{{ $aset->status }}" data-lokasi="{{ $aset->id_lokasi }}" data-jumlah="{{ $aset->jumlah }}" data-harga_satuan="{{ $aset->harga_satuan }}" data-target="#updateModal"><i class="fas fa-sync"></i> Perbarui</a> -->
        <div class="dropdown d-inline">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 7em; margin-left: 20px; margin-bottom: 20px;">
            Action
          </button>
          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 28px, 0px);">
            @if ($permission == true)
            <a href="#" class="dropdown-item has-icon open-update" data-toggle="modal" data-id="{{ $aset->id }}" data-nama="{{ $aset->nama }}" data-kategori="{{ $aset->id_kategori }}" data-status="{{ $aset->status }}" data-lokasi="{{ $aset->id_lokasi }}" data-jumlah="{{ $aset->jumlah }}" data-harga_satuan="{{ $aset->harga_satuan }}" data-target="#updateModal"><i class="fas fa-sync"></i> Perbarui</a>
            @endif
            <a href="#" class="dropdown-item has-icon open-pinjam" data-toggle="modal" data-id="{{ $aset->id }}" data-nama="{{ $aset->nama }}" data-kode="{{ $aset->kode }}" data-jumlah="{{ $aset->jumlah }}" data-target="#tambahPeminjamanModal"><i class="fas fa-hand-holding"></i> Pinjamkan</a>
            @if ($permission == true)
            <a href="#" class="dropdown-item has-icon open-perbaikan" data-toggle="modal" data-id="{{ $aset->id }}" data-nama="{{ $aset->nama }}" data-kode="{{ $aset->kode }}" data-jumlah="{{ $aset->jumlah }}" data-target="#tambahPerbaikanModal"><i class="fas fa-tools"></i> Perbaiki</a>
            <a href="#" class="dropdown-item has-icon open-lepas" data-toggle="modal" data-id="{{ $aset->id }}" data-nama="{{ $aset->nama }}" data-kode="{{ $aset->kode }}" data-jumlah="{{ $aset->jumlah }}" data-target="#tambahPelepasanModal"><i class="fas fa-recycle"></i> Lepaskan</a>
            @endif
          </div>
        </div>
      </div>
      <div class="row">
        <br>
        <h4 style="margin:auto;" id="judul_detail">Detail Aset</h4>
        <br>
      </div>
      <div class="row">
        <br>
        <div class="col-lg-4 col-md-4 col-sm-12 ">
          <!-- <img id="foto-barang" src="{{ route('home') }}/{{ $aset->link_foto_barang }}" alt="foto" style="max-width:100%; max-height:500px; margin: 15px;"></img> -->
          <span id="img_uploaded" style="text-align: center;" class="img-thumbnail rounded mx-auto d-block">
            <img src="{{ route('home') }}/{{ $aset->link_foto_barang. '?=' .  strtotime('now') }}" id="blah" alt="foto aset" style="max-width:100%; overflow: hidden;" required><br>
          </span>
          @if ($permission == true)
          <form action="{{ route('asetUpdateFoto') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Ganti Foto</label>
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              @if (Session::has('message'))
              <div class="alert alert-info">{{ Session::get('message') }}</div>
              @endif
              <input type="file" required name="file" id="fileChooser" accept="image/*" class="form-control" onchange="return ValidateFileUpload()">
              <input type="text" name="id" value="{{ $aset->id }}" hidden>
              <div class="wrapper" style="text-align: center; margin-top:7px">
                <button type="submit" class="btn btn-primary">Upload Foto</button>
              </div>
            </div>
          </form>
          @endif
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 ">
          <table id="table-barang" border="1" style="width: 100%;">
            <tbody>
              <tr>
                <td>Kode Aset:</td>
                <td>{{ $aset->kode }}</td>
              </tr>
              <tr>
                <td>Nama Aset:</td>
                <td>{{ $aset->nama }}</td>
              </tr>
              <tr>
                <td>Kategori:</td>
                @if ($aset->kategori != null)
                <td>{{ $aset->kategori->nama }}</td>
                @else
                <td>-</td>
                @endif
              </tr>
              <tr>
                <td>Penanggung Jawab:</td>
                @if ($aset->kategori != null)
                <td>{{ $aset->kategori->penanggung_jawab->nama }}</td>
                @else
                <td>-</td>
                @endif
              </tr>
              <tr>
                <td>Pencatatan:</td>
                <td>{{ $aset->tgl_pencatatan->isoFormat('LLLL')}}</td>
              </tr>
              <tr>
                <td>Jumlah:</td>
                <td>{{ $aset->jumlah }}</td>
              </tr>
              <tr>
                <td>Harga Satuan:</td>
                <td id="td_harga_satuan" class="harga">{{ $aset->harga_satuan }}</td>
              </tr>
              <tr>
                <td>Total Nilai:</td>
                <td id="td_total_nilai" class="harga">{{ $aset->jumlah * $aset->harga_satuan }}</td>
              </tr>
              <tr>
                <td>Sumber:</td>
                <td>{{ $aset->sumber }}</td>
              </tr>
              <tr>
                <td>Lokasi:</td>
                @if ($aset->lokasi != null)
                <td>{{ $aset->lokasi->nama }}</td>
                @else
                <td>-</td>
                @endif
              </tr>
              <tr>
                <td>Status:</td>
                <td>{{ $aset->status }}</td>
              </tr>
              <tr>
                <td>Keterangan:</td>
                <td>{{ $aset->keterangan }}</td>
              </tr>
              <tr>
                <td>Label QR Code:</td>
                <td style="text-align:center;">
                  <div id="qr-label">
                    <table align="center" border="1" style="display:inline-block;">
                      <tr>
                        <th>{{ $aset->kode }}</th>
                      </tr>
                      <tr>
                        <td><img id="qr-code-img" src="{{ route('home') }}/{{ $aset->link_qr }}" alt="foto qr" style="max-width: 150px;"></td>
                      </tr>
                    </table>
                  </div> <br><label>Jumlah Print QR Code</label>
                  <div class="print-qr input-group">
                    <br>
                    <input type="number" style="width: 70px; height: 40px;" id="print-input-qr" class="form-control" placeholder="Jumlah Print" value="1" />
                    <a href="#" class="btn btn-sm btn-primary input-group-addon" style="width: 70px; height: 40px; display: inline-block;" onclick="printDiv({{ $aset->id }})">
                      <i class="fa fa-print"></i>Print</a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <h4 id="judul_riwayat" style="margin:auto;">Riwayat Aset</h4>
        <div class="col-12">
          <table id="table-riwayat" class="display" style="width:100%">
            <thead>
              <tr>
                <th>Aksi</th>
                <th>Petugas</th>
                <th>Waktu</th>
                <th>Jumlah</th>
                <th>Status Aset</th>
              </tr>
              @foreach( $aset->riwayat_aset as $riwayat_aset)
            </thead>
            <tbody>
              <tr>
                <td>{{ $riwayat_aset->aksi }}</td>
                <td>{{ $riwayat_aset->oleh_anggota->nama }}</td>
                <td>{{ $riwayat_aset->waktu->isoFormat('LLLL') }}</td>
                <td>{{ $riwayat_aset->jumlah }}</td>
                <td>{{ $riwayat_aset->status }}</td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="{{ route('asetIndex') }}" class="btn btn-lg btn-info btn-primary" style="margin: 2em;">Kembali</a>
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
              <input id="nama-barang-pinjam" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="kode" class="col-md-4 col-form-label text-md-right">Kode Barang</label>
            <div class="col-md-6">
              <input id="kode-aset-pinjam" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlah" class="col-md-4 col-form-label text-md-right">Jumlah (Max: <span id="max-jumlah-pinjam"></span>)</label>
            <div class="col-md-6">
              <input id="jumlah-pinjam" type="number" class="form-control" name="jumlah" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="nama-peminjam" class="col-md-4 col-form-label text-md-right">Nama Peminjam</label>
            <div class="col-md-6">
              <input id="nama-peminjam" type="text" class="form-control" name="nama_peminjam" placeholder="Nama Peminjam" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="telp-peminjam" class="col-md-4 col-form-label text-md-right">No. HP/Telp Peminjam</label>
            <div class="col-md-6">
              <input id="telp-peminjam" type="text" class="form-control" name="telp_peminjam" placeholder="Nomor Telepon/HP Peminjam" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="keterangan-pinjam" class="col-md-4 col-form-label text-md-right">Keterangan</label>
            <div class="col-md-6">
              <textarea id="keterangan-pinjam" class="form-control" name="keterangan" style="height:82px;" placeholder="Keterangan lainnya"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <input type="text" id="id-aset-pinjam" name="id_aset" value="" hidden />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@if ($permission == true)
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
              <input id="nama-update" type="text" class="form-control" name="nama" value="{{ $aset->nama }}" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori-update" class="col-md-4 col-form-label text-md-right">Kategori</label>
            <div class="col-md-6">
              <select id="kategori-update" name="id_kategori" class="form-control select" style="width: 100%">
                <?php
                $kategoriGroup = App\Models\Aset\Kategori::get();
                $lokasiGroup = App\Models\Aset\Lokasi::get();
                ?>
                @foreach ($kategoriGroup as $kategori)
                @if ( $kategori->id == $aset->id_kategori)
                <option value="{{ $kategori->id }}" selected>{{ $kategori->kode }} | {{ $kategori->nama }}</option>
                @else
                <option value="{{ $kategori->id }}">{{ $kategori->kode }} | {{ $kategori->nama }}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="lokasi-update" class="col-md-4 col-form-label text-md-right">Lokasi</label>
            <div class="col-md-6">
              <select id="lokasi-update" name="id_lokasi" class="form-control select" style="width:100%;">
                @foreach ($lokasiGroup as $lokasi)
                @if ( $lokasi->id == $aset->id_lokasi)
                <option value="{{ $lokasi->id }}" selected>{{ $lokasi->nama }}</option>
                @else
                <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlah-update" class="col-md-4 col-form-label text-md-right">Jumlah</label>
            <div class="col-md-6">
              <input type="number" name="jumlah" id="jumlah-update" class="form-control" value="{{ $aset->jumlah }}" />
            </div>
          </div>
          <div class="form-group row">
            <label for="harga-update" class="col-md-4 col-form-label text-md-right">Harga Satuan</label>
            <div class="col-md-6">
              <input name="harga_satuan" id="harga_satuan-update" class="form-control harga" value="{{ $aset->harga_satuan }}" />
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <input type="text" id="id-update" name="id" value="{{ $aset->id }}" hidden />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
          <input type="submit" value="Simpan" class="btn btn-primary" />
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal Tambah Perbaikan -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahPerbaikanModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Perbaikan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('asetPerbaikanCreateHasil') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama-barang-perbaikan" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
            <div class="col-md-6">
              <input id="nama-barang-perbaikan" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="kode-aset-perbaikan" class="col-md-4 col-form-label text-md-right">Kode Barang</label>
            <div class="col-md-6">
              <input id="kode-aset-perbaikan" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlah-perbaikan" class="col-md-4 col-form-label text-md-right">Jumlah (Max: <span id="max-jumlah-perbaikan"></span>)</label>
            <div class="col-md-6">
              <input id="jumlah-perbaikan" type="number" class="form-control" name="jumlah" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="keterangan-perbaikan" class="col-md-4 col-form-label text-md-right">Keterangan</label>
            <div class="col-md-6">
              <textarea id="keterangan-perbaikan" class="form-control" name="keterangan" style="height:82px;" placeholder="Keterangan perbaikan" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <input type="text" id="id-aset--perbaikan" name="id_aset" value="" hidden />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Tambah Pelepasan -->
<div class="modal fade" tabindex="-1" role="dialog" id="tambahPelepasanModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pelepasan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('asetPelepasanCreateHasil') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama-barang-lepas" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
            <div class="col-md-6">
              <input id="nama-barang-lepas" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="kode-aset-lepas" class="col-md-4 col-form-label text-md-right">Kode Barang</label>
            <div class="col-md-6">
              <input id="kode-aset-lepas" type="text" class="form-control" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlah" class="col-md-4 col-form-label text-md-right">Jumlah (Max: <span id="max-jumlah"></span>)</label>
            <div class="col-md-6">
              <input id="jumlah-lepas" type="number" class="form-control" name="jumlah" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="keterangan-lepas" class="col-md-4 col-form-label text-md-right">Keterangan</label>
            <div class="col-md-6">
              <textarea id="keterangan-lepas" class="form-control" name="keterangan" style="height:82px;" placeholder="Keterangan pelepasan" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <input type="text" id="id-aset-lepas" name="id_aset" value="" hidden />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@include('layouts.footer')
<script type="text/javascript">
  //ganti foto
  function ValidateFileUpload() {
    var fuData = document.getElementById('fileChooser');
    var FileUploadPath = fuData.value;

    //To check if user upload any file
    if (FileUploadPath == '') {
      alert("Silakan pilih dan upload gambar");

    } else {
      var Extension = FileUploadPath.substring(
        FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

      //The file uploaded is an image

      if (Extension == "gif" || Extension == "png" || Extension == "bmp" ||
        Extension == "jpeg" || Extension == "jpg") {

        // To Display
        if (fuData.files && fuData.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            var loadingImage = loadImage(
              fuData.files[0],
              function(img) {
                // $('#blah').remove();
                $('#img_uploaded').html(img);
              }, {
                maxWidth: $('#img_uploaded').width(),
                orientation: true
              }
            );

            // $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(fuData.files[0]);
        }
      }

      //The file upload is NOT an image
      else {
        alert("Format foto yang diperbolehkan hanya GIF, PNG, JPG, JPEG dan BMP. ");
      }
    }
  }
  //print qr
  function printDiv(id) {
    var div_qr_label = "qr-label";
    var input_print = "print-input-qr";
    var num = document.getElementById(input_print).value;
    if (num == null || num == 0 || num < 0) {
      num = 1;
    }
    var divToPrintQR = document.getElementById(div_qr_label);
    var newWin = window.open('', 'Print-window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">');
    for (i = 0; i < num; i++) {
      newWin.document.write(divToPrintQR.innerHTML);
    }
    newWin.document.write('</body></html>');

    newWin.document.close();
    setTimeout(function() {
      newWin.document.close();
    }, 10);
  }

  $(document).ready(function() {
    $('#menu_tracking').addClass('active');
    $(".harga").autoNumeric('init', {
      aSep: '.',
      aDec: ',',
      aSign: 'Rp. ',
      mDec: '0'
    });

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



    //init scroll boolean
    var scroll_table = false;

    if ($(window).width() <= 480) {
      $('#foto-barang').css("max-height", 240);
      $('#qr-code-img').css("max-width", 125);
      $('#foto-barang').css("float", "none");
      $('#table-barang').css("width", "100%");
      scroll_table = true;
    }

    $('#table-riwayat').DataTable({
      "scrollX": scroll_table,
      "lengthChange": false,
      "language": {
        "zeroRecords": "Tidak ditemukan",
        "infoEmpty": "Tidak ada data",
        "search": "_INPUT_",
        "searchPlaceholder": "Cari data...",
      }
    });
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
</script>