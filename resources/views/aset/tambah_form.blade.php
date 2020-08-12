@include('layouts.header')
@include('layouts.navbar')

<div class="main-content">
  <section class="section">
    <div class="row">
      <div>
        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
          <li class="breadcrumb-item active">Pencatatan</li>
          <!-- <li class="breadcrumb-item active">Usulan</li> -->
        </ol>
      </div>
    </div>
    @include('aset.menu_aset')
    <div class="row">
      <div class="col-12">
        <div class="section-header">
          <h1 style="margin:auto;"><i class="fa fa-edit"></i> Pencatatan</h1>
          <div></div>
        </div>
        <div class="section-body" style="min-height: 250px;">
          <form method="post" action="{{ route('asetCreateHasil') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Nama Barang*</label>
              <input name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
            </div>
            <div class="form-group">
              <label>Kategori*</label>
              <select name="id_kategori" class="form-control select2" style="width:100%;" required>
                @foreach ($kategoriGroup as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Lokasi*</label>
              <select name="id_lokasi" class="form-control select2" style="width:100%;" required>
                @foreach ($lokasiGroup as $lokasi)
                <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Sumber*</label>
              <select name="sumber" class="form-control" required>
                <option value="Pengadaan">Pengadaan</option>
                <option value="Hibah">Hibah</option>
                <option value="Produksi">Produksi</option>
              </select>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" type="text" class="form-control" style="height: 112px;"></textarea>
            </div>
            <div class="form-group">
              <label>Jumlah*</label>
              <input name="jumlah" type="number" class="form-control" placeholder="Jumlah" required>
            </div>
            <div class="form-group">
              <label>Harga Satuan*</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    Rp.
                  </div>
                </div>
                <input name="harga_satuan" type="text" class="form-control currency" required>
              </div>
            </div>
            <div class="form-group">
              <span id="img_uploaded" style="text-align: center;" class="img-thumbnail rounded mx-auto d-block" ">
                <img src=" {{ route('home') }}/foto_aset/not-available.jpg" id="blah" alt="foto profil" style="max-width:250px; overflow: hidden;" required><br>
              </span>
              <label>Upload Foto Aset*</label>
              <input type="file" required name="file" id="fileChooser" accept="image/.gif, .png, .jpg, .jpeg, .bmp" class="form-control" onchange="return ValidateFileUpload()">
            </div>
            <button type="submit" class="btn btn-lg btn-info btn-primary">Submit</button>
          </form>
          </br>
          @if($errors->any())
          @foreach ($errors->all() as $error)
          <p style="color:red;"><strong>{{ $error }}</strong></p>
          @endforeach
          @endif
          <p>* Wajib diisi</p>
        </div>
      </div>
    </div>
  </section>
</div>
@include('layouts.footer')
<script type="text/javascript">
  //JS halaman aktif
  $("body").addClass("sidebar-mini");
  $("#menu_pencatatan").addClass("active");
  $("#aset-link").addClass("active");

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
                maxWidth: 300,
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