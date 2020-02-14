@include('layouts.header')
@include('layouts.navbar')

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Instascan &ndash; Demo</title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<div class="main-content">
  <section class="section">
    <div class="row">
      <div>
        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('asetIndex') }}">Manajemen Aset</a></li>
          <li class="breadcrumb-item active">Tracking</li>
          <!-- <li class="breadcrumb-item active">Usulan</li> -->
        </ol>
      </div>
    </div>
    @include('aset.menu_aset')
    <div class="section-header">
      <div class="row" style="margin:auto;">
        <div class="col-12">
          <h1><i class="fa fa-search"></i> Tracking Aset</h1>
          <div></div>
        </div>
      </div>
    </div>
    <div class="section-body" style="min-height: 250px;">
      <div class="row">
        <div class="col-12">
          <form method="get" action="{{ route('asetTrackingHasil') }}">
            <div class="form-group">
              <label>Tracking Aset</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-search"></i>
                  </div>
                </div>
                <input type="text" id="kode_aset_input" name="kode" class="form-control" placeholder="Kode Aset">
              </div>
            </div>
            <button type="submit" class="btn btn-lg btn-info btn-primary">Check</button>
          </form>
          </br>
          @if($errors->any())
          <p style="color:red;"><strong>{{ $errors->first() }}</strong></p>
          @endif
        </div>
      </div>
      <div class="row">
        <button id="button-camera" style="margin: 1em auto;" class="btn btn-dark" data-toggle="collapse" data-target="#camera-box" aria-expanded="false">
          <i class="fa fa-camera"></i> Camera QR Scanner
        </button>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div id="camera-box" class="collapse">
            <div class="card-body">
              <!-- open qrscan -->
              <div class="preview-container">
                <video id="preview" style="width: 100%"></video>
              </div>
              <!-- close qrscan -->
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<!-- <script src="{{ asset('public/qrscan/app.js') }}" type="text/javascript"> </script> -->
<!-- <script type="text/javascript" src="app.js"></script> -->
@include('layouts.footer')
<script type="text/javascript">
  //JS halaman aktif
  $("#menu_tracking").addClass("active");
  // $(document).ready(function() {
  //   var isExpanded = $('#button-camera').attr("aria-expanded");
  //   if (isExpanded) {
  //     console.log('expanded');
  //   } else {
  //     console.log('closed');
  //   }
  // });

  $(document).on("click", "#button-camera", function() {
    let scanner = new Instascan.Scanner({
      video: document.getElementById('preview'),
      mirror: false
    });

    console.log('buka');
    scanner.addListener('scan', function(content) {
      var link = "{{ route('home') }}" + '/aset/tracking_hasil?kode=' + content
      window.location.href = link;
    });
    Instascan.Camera.getCameras().then(function(cameras) {
      if (cameras.length > 0) {
        if(cameras.length == 1){
          scanner.start(cameras[0]);
        }else {
          scanner.start(cameras[1]);
        }
      } else {
        console.error('No cameras found.');
      }
    }).catch(function(e) {
      console.error(e);
    });

  });

  // let scanner = new Instascan.Scanner({
  //   video: document.getElementById('preview'),
  //   mirror: false
  // });
  // scanner.addListener('scan', function(content) {
  //   // $("#kode_aset_input").value(content);
  //   // $("#kode_aset_input").remove();
  //   var link = "{{ route('home') }}" + '/aset/tracking_hasil?kode=' + content
  //   window.location.href = link;
  //   // document.getElementById("input-kode").value = content; // Pass the scanned content value to an input field
  // });
  // Instascan.Camera.getCameras().then(function(cameras) {
  //   if (cameras.length > 0) {
  //     scanner.start(cameras[0]);
  //   } else {
  //     console.error('No cameras found.');
  //   }
  // }).catch(function(e) {
  //   console.error(e);
  // });
  // });

  // 
</script>