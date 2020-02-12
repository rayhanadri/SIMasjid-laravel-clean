@include('layouts.header')

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ route('home') }}/public/dist/assets/img/ibnusina.jpg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h4 style="margin: auto; padding: auto;">SI Masjid Ibnu Sina</h4>
              </div>
              <div class="card-body">
                <h5>Registrasi Akun Sukses!</h5>
                <br>
                Terima kasih telah mendaftar di Sistem Informasi Masjid Ibnu Sina.
                <br><br>
                Akun akan diverifikasi oleh Ketua atau Sekretaris Takmir Masjid.
                <br><br>
                Setelah verifikasi sukses, akun anda akan aktif dan dapat login.
                <br><br>
                <a href="{{ route('login') }}" class="btn btn-info">Kembali</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

    </div>
  </div>
</div> -->