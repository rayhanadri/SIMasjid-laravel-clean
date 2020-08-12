@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="row">
      <div>
        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div>
    </div>
    <div class="section-header">
      <h1 style="margin:auto;"><i class="fa fa-user-circle"></i> Profile</h1>
    </div>
    <div class="row">
      <div class="col-lg-8 col-md-6 col-sm-12">
        <div class="section-body" style="min-height: 300px; padding:0px;">
          <table class="table table-borderless" style="width:70%; margin: auto;">
            <tbody>
              <tr>
                <th scope="row">Nama</th>
                <td><?php echo $anggota->nama ?></td>
              </tr>
              <tr>
                <th scope="row">Jabatan</th>
                <td><?php echo $anggota->jabatan ?></td>
              </tr>
              <tr>
                <th scope="row">Status</th>
                <td class="font-status"><?php echo $anggota->status ?></td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td><?php echo $anggota->email ?></td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td><?php echo $anggota->alamat ?></td>
              </tr>
              <tr>
                <th scope="row">Telp/HP</th>
                <td><?php echo $anggota->telp ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="section-body" style="min-height: 300px">
          <img src="
          <?php
          if ($anggota->link_foto != null) {
            echo route('home') . '/' . $anggota->link_foto . '?=' .  strtotime("now");
          } else {
            echo route('home') . '/' . 'public\dist\assets\img\avatar\avatar-1.png';
          }
          ?>
          " id="blah" class="img-thumbnail rounded mx-auto d-block" alt="foto profil" style="max-width:250px; overflow: hidden;"><br>
          <br>
          <form action="{{ route('uploadFotoProfile') }}" method="POST" enctype="multipart/form-data">
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
              <div class="wrapper" style="text-align: center; margin-top:7px">
                <button type="submit" class="btn btn-primary">Upload Foto</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- JS Styler Warna Status -->
<script type="text/javascript">
  $(document).ready(function() {
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
  });
</script>
<!-- JS pencegah format tidak sesuai -->
<script type="text/javascript">
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
        Extension == "jpeg" || Extension == "jpg" || Extension == "svg") {

        // To Display
        if (fuData.files && fuData.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(fuData.files[0]);
        }
      }

      //The file upload is NOT an image
      else {
        alert("Format foto yang diperbolehkan hanya JPG, JPEG, GIF, PNG, dan BMP. ");
      }
    }
  }
</script>
@include('layouts.footer')