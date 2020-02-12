@include('layouts.header')
@include('layouts.navbar')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="row">
      <div>
        <ol class="breadcrumb float-sm-left" style="margin-bottom: 10px; margin-left: 15px;">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-mosque"></i> Home</a></li>
          <li class="breadcrumb-item active">Pengaturan Akun</li>
        </ol>
      </div>
    </div>
    <div class="section-header">
      <h1 style="margin:auto;"><i class="fa fa-cog"></i> Pengaturan Akun</h1>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-body">
            @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <form method="POST" action="{{ route('pengaturanAkunUpdate') }}">
              @csrf
              <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                <div class="col-md-6">
                  <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Auth::user()->username }}" required autocomplete="username" autofocus placeholder="Username">
                  @error('username')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>
                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{ Auth::user()->email }}" required autocomplete="email" placeholder="Email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>
                <div class="col-md-6">
                  <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" autocomplete="alamat" style="height: 82px;"> {{ Auth::user()->alamat }}
                  </textarea>
                  @error('alamat')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('No Telp/HP') }}</label>
                <div class="col-md-6">
                  <input id="telp" type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ Auth::user()->telp }}" autocomplete="telp" placeholder="No. Telepon/HP">
                  @error('telp')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-6 offset-lg-4" style="text-align:center;">
                  <button type="submit" class="btn btn-primary" style="width: 100%">
                    {{ __('Simpan') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@include('layouts.footer')