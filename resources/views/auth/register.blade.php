@include('layouts.header')
<<<<<<< HEAD

=======
>>>>>>> first commit
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="{{route('home')}}/public/dist/assets/img/ibnusina.jpg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group row">
                    <label for="id_jabatan" class="col-md-4 col-form-label text-md-right">{{ __('Akses Akun') }}</label>
                    <div class="col-md-6">
                      <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                        <option value=4>Takmir Masjid</option>
                        <option value=5>Remaja Masjid</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                    <div class="col-md-6">
                      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
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
                  <hr>
                  <h5 style="text-align:center"> Biodata </h5>
                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>
                    <div class="col-md-6">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Nama">
                      @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                    <div class="col-md-6">
                      <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" autocomplete="alamat" style="height: 82px;">
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
                      <input id="telp" type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" autocomplete="telp" placeholder="No. Telepon/HP">
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
<<<<<<< HEAD
                        {{ __('Simpan') }}
=======
                        {{ __('Register') }}
>>>>>>> first commit
                      </button>
                    </div>
                  </div>
                </form>
                <br><br>
                <div class="row">
                  <div class="col-lg-6">
                    <a class="btn btn-sm btn-outline-info" href="{{ route('login') }}" style="width:100%; margin-top: 5px;">
<<<<<<< HEAD
                      {{ __('Sudah punya akun? Masuk di sini.') }}
=======
                      {{ __('Sudah punya akun? Login di sini.') }}
>>>>>>> first commit
                    </a>
                  </div>
                  <div class="col-lg-6">
                    <a class="btn btn-sm btn-outline-success" href="{{ route('password.request') }}" style="width:100%; margin-top: 5px;">
                      {{ __('Lupa Password? Klik di sini.') }}
                    </a>
                  </div>
                </div>

              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>