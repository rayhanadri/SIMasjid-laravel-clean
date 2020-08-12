@include('layouts.header')
@include('layouts.navbar')

<div class="main-content">
  <section class="section">
    <div class="row">
      <div>
        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
          <li class="breadcrumb-item active">Usulan</li>
        </ol>
      </div>
    </div>
    @include('aset.menu_aset')
    <div class="section-header">
      <h1 style="margin:auto;"><i class="fa fa-lightbulb"></i> Usulan</h1>
    </div>
    <div class="section-body" style="min-height: 800px;">
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
      <form method="post" action="{{ route('asetUsulanCreateHasil') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control">
        </div>
        <div class="form-group">
          <label>Kategori Barang</label>
          <select type="text" name="id_kategori" class="form-control">
            @foreach ($kategoriGroup as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Jumlah Barang</label>
          <input type="number" name="jumlah" class="form-control">
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea name="keterangan" type="text" class="form-control" style="height: 112px;"></textarea>
        </div>
        <button type="submit" class="btn btn-lg btn-info btn-primary">Submit</button>
      </form>
      </br>
      @if($errors->any())
      @foreach ($errors->all() as $error)
      <p style="color:red;"><strong>{{ $error }}</strong></p>
      @endforeach
      @endif
    </div>
  </section>
</div>
@include('layouts.footer')
<script type="text/javascript">
  //JS halaman aktif
  $("body").addClass("sidebar-mini");
  $("#menu_usulan").addClass("active");
  $('#create-tab').addClass('active');
  $("#aset-link").addClass("active");

  $(document).ready(function() {
    $('#harga_satuan').autoNumeric('init', {
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
  });


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
</script>