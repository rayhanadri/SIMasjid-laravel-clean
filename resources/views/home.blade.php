@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="row">
      <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
        <li class="breadcrumb-item active"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
      </ol>
    </div>
    <div class="section-header">
      <div class="row" style="margin:auto;">
        <div class="col-lg-12 col-sm-4">
          <h1><i class="fa fa-mosque"></i> Home</h1>
        </div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <h3 style="text-align:center;">Selamat datang di Sistem Informasi Masjid Ibnu Sina!!</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2 col-md-4 col-6" style="padding: 10px;">
          <a href="{{ route('anggotaIndex') }}" class="btn btn-info" style="width: 100%; height: 150px;">
            <div style="font-size: 14px; padding: 30px 0px;">
              <i class="fa fa-users" style="font-size: 32px;"></i>
              <br>
              Keanggotaan
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-6" style="padding: 10px;">
          <a href="{{ route('asetIndex') }}" class="btn btn-info" style="width: 100%; height: 150px;">
            <div style="font-size: 14px; padding: 30px 0px;">
              <i class="fa fa-warehouse" style="font-size: 32px;"></i>
              <br>
              Aset
            </div>
          </a>
        </div>
        <!-- <div class="col-lg-2 col-md-4 col-6" style="padding: 10px;">
          <a href="#" class="btn btn-info not-ready" style="width: 100%; height: 150px;">
            <div style="font-size: 14px; padding: 30px 0px;">
              <i class="fa fa-money-bill-wave" style="font-size: 32px;"></i>
              <br>
              Keuangan
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-6" style="padding: 10px;">
          <a href="#" class="btn btn-info not-ready" style="width: 100%; height: 150px;">
            <div style="font-size: 14px; padding: 30px 0px;">
              <i class="fa fa-comments" style="font-size: 32px;"></i>
              <br>
              Musyawarah
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-md-4 col-6" style="padding: 10px;">
          <a href="#" class="btn btn-info not-ready" style="width: 100%; height: 150px;">
            <div style="font-size: 14px; padding: 15px 0px;">
              <i class="icofont-cow" style="font-size: 48px;"></i>
              <br>
              Kurban
            </div>
          </a>
        </div> -->
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#home-link').addClass('active');
  });
</script>

@include('layouts.footer')