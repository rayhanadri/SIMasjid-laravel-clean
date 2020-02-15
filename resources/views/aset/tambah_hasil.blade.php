@include('layouts.header')
@include('layouts.navbar')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div>
        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
          <li class="breadcrumb-item"><a href="{{ route('asetCreate') }}">Pencatatan</a></li>
          <li class="breadcrumb-item active">Hasil Pencatatan</li>
          <!-- <li class="breadcrumb-item active">Usulan</li> -->
        </ol>
      </div>
    </div>
    @include('aset.menu_aset')
    <div class="row">
      <div class="col-12">
        <div class="section-header">
          <h1 style="margin: auto;"><i class="fa fa-info-edit"></i> Hasil Pencatatan</h1>
        </div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <h4 style="margin:auto;" id="judul_detail">Detail Aset</h4>
        <br>
      </div>
      <div class="row">
        <br>
        <div class="col-lg-4 col-md-4 col-sm-12 ">
          <img id="foto-barang" src="{{ route('home') }}/{{ $aset->link_foto_barang }}" alt="foto" style="max-width:100%; max-height:500px; margin: 15px;"></img>
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
                <td>{{ $aset->kategori->nama }}</td>
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
                <td class="harga">{{ $aset->harga_satuan }}</td>
              </tr>
              <tr>
                <td>Total Nilai:</td>
                <td class="harga">{{ $aset->jumlah * $aset->harga_satuan }}</td>
              </tr>
              <tr>
                <td>Sumber:</td>
                <td>{{ $aset->sumber }}</td>
              </tr>
              <tr>
                <td>Lokasi:</td>
                <td>{{ $aset->lokasi->nama }}</td>
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
                <th>Oleh</th>
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
          <a href="{{ route('asetCreate') }}" class="btn btn-lg btn-info btn-primary" style="margin: 2em;">Kembali</a>
        </div>
      </div>
    </div>
  </section>
</div>
@include('layouts.footer')
<script type="text/javascript">
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
    $('#menu_index').addClass('active');
    $(".harga").autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aSign: 'Rp. ',
        mDec: '0'
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
</script>