<body>

  <?php
  /* PHP UNTUK PENGATURAN VIEW */
  //anggota terautentikasi
  $authUser = Auth::user();
  //hide untuk selain sekretaris dan ketua
  $sekretaris = array(1, 2);
  $inside_sekretaris = in_array($authUser->id_jabatan, $sekretaris);

  //pengaturan notifikasi
  use App\Models\Notifikasi;
  use Illuminate\Support\Facades\Auth;

  $notifs = Notifikasi::where('id_penerima', '=', Auth::user()->id)->skip(0)->take(5)->orderBy('id', 'desc')->get();
  ?>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li id="toggle-bar"><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i class="fas fa-tasks"></i></a></li> -->
          <?php
          //belum baca 0
          $array_sudah_baca = [];
          foreach ($notifs as $notif) {
            //jumlah belum baca ditambah jumlah sudah baca dari db
            $sudah_baca = $notif->sudah_baca;
            array_push($array_sudah_baca, $sudah_baca);
          }
          $not_read_yet = in_array(0,  $array_sudah_baca); //jika masih ada berarti ada yg blm dibaca
          ?>
          @if ( $not_read_yet == true )
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            @else
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i class="far fa-bell"></i></a>
            @endif
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
<<<<<<< HEAD
              <div class="dropdown-header">Notifikasi
                <div class="float-right">
                  <!-- <a href="#">Mark All As Read</a> -->
=======
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
>>>>>>> first commit
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                @foreach ( $notifs as $notif )
                @if ( $notif->sudah_baca == 0 )
<<<<<<< HEAD
                <a href="{{ $notif->link }}" class="notif dropdown-item dropdown-item-unread" data-id="{{ $notif->id }}" data-link="{{ $notif->link }}">
=======
                <a href="#" class="notif dropdown-item dropdown-item-unread" data-id="{{ $notif->id }}">
>>>>>>> first commit
                  @else
                  <a href="{{ $notif->link }}" class="dropdown-item">
                    @endif
                    <div class="dropdown-item-icon {{ $notif->bg }} text-white">
                      <i class="{{ $notif->icon }}"></i>
                    </div>
                    <div class="dropdown-item-desc">
                      <strong>{{ $notif->jenis }}</strong>
                      </br>
                      <?php
                      if (isset($notif->id_pembuat)) {
                        echo $notif->pembuat->nama . ' ' . $notif->msg;
                      } else {
                        echo 'SYSTEM' . ' ' . $notif->msg;
                      }
                      ?>
                      <div class="time text-primary">{{ $notif->tgl_dibuat->diffForHumans() }}</div>
                    </div>
                  </a>
                  @endforeach
              </div>
              <div class="dropdown-footer text-center">
<<<<<<< HEAD
                <!-- <a href="#">View All <i class="fas fa-chevron-right"></i></a> -->
=======
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
>>>>>>> first commit
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="
              <?php
              if ($authUser->link_foto != null) {
                echo route('home') . '/' . $authUser->link_foto . '?=' . strtotime("now");
              } else {
                echo route('home') . '/' . 'public\dist\assets\img\avatar\avatar-1.png';
              }
              ?>" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block"> {{$authUser->nama}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ route('profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="{{ route('pengaturanAkun') }}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Pengaturan Akun
              </a>
<<<<<<< HEAD
              <!-- <div class="form-group">
                <label class="custom-switch mt-2">
                  <input type="checkbox" id="dark-mode-switch" name="custom-switch-checkbox" class="custom-switch-input">
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description">Dark Mode</span>
                </label>
              </div> -->
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar (Log out)
=======
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
>>>>>>> first commit
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <!-- <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"> -->
              <!-- @csrf
              <i class="fas fa-sign-out-alt"></i> Logout
              </a> -->
            </div>
          </li>
        </ul>
      </nav>
<<<<<<< HEAD
      <div class="main-sidebar" id="main-sidebar">
=======
      <div class="main-sidebar">
>>>>>>> first commit
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('home') }}">SI MASJID IBNU SINA</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
<<<<<<< HEAD
            <a href="{{ route('home') }}"><img src="{{ route('home')}}/public/dist/assets/img/ibnusina.jpg" style="width: 3em;"></a>
=======
            <a href="{{ route('home') }}">SIM</a>
>>>>>>> first commit
          </div>
          <ul class="sidebar-menu">
            <!-- <li class="menu-header">Dashboard</li> -->
            <li id='home-link'><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-mosque"></i><span>Home</span></a></li>
            <li id='keanggotaan-link'><a class="nav-link" href="{{ route('anggotaIndex') }}"><i class="fas fa-users"></i><span>Keanggotaan</span></a></li>
            <li id='aset-link'><a class="nav-link" href="{{ route('asetIndex') }}"><i class="fas fa-warehouse"></i><span>Aset</span></a></li>
<<<<<<< HEAD
            <!-- <li id='keuangan-link'><a class="nav-link not-ready" href="#"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></li>
            <li id='musyawarah-link'><a class="nav-link not-ready" href="#"><i class="fas fa-comments"></i><span>Musyawarah</span></a></li>
            <li id='kurban-link'><a class="nav-link not-ready" href="#"><i class="icofont-cow" style="font-size: 30px;"></i><span>Kurban</span></a></li> -->
=======
            <li id='keuangan-link'><a class="nav-link not-ready" href="#"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></li>
            <li id='musyawarah-link'><a class="nav-link not-ready" href="#"><i class="fas fa-comments"></i><span>Musyawarah</span></a></li>
            <li id='kurban-link'><a class="nav-link not-ready" href="#"><i class="fas fa-money-bill-wave"></i><span>Kurban</span></a></li>
>>>>>>> first commit
        </aside>
      </div>
      <script>
        $(document).ready(function() {
          $("body").addClass("sidebar-mini");
          $('.not-ready').click(function() {
            alert('Fitur ini belum tersedia');
          });
<<<<<<< HEAD
          if (typeof Android !== "undefined" && Android !== null) {
            $('.main-sidebar').css({
              'z-index': 1002
            });
            $('.navbar').css({
              position: "fixed",
              top: 0,
              'z-index': 1000
            });
            $('.navbar-bg').css({
              position: "fixed",
              top: 0,
              'z-index': 999
            });
          }
        });
        $('.notif').click(function(e) {
          e.preventDefault();
          var id = $(this).data('id');
          var link = $(this).data('link');
=======
        });

        $('.notif').click(function() {
          var id = $(this).data('id');
>>>>>>> first commit
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: "{{ route('notifReadJSON') }}",
            data: {
              id: id
            },
            type: 'POST',
            success: function(data) {
<<<<<<< HEAD
              window.location.href = link;
=======
>>>>>>> first commit
              console.log(data.success);
            }
          });
        });
      </script>