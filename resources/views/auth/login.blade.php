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
<<<<<<< HEAD
                <h4 style="margin: auto; padding: auto;">Masuk SI Masjid Ibnu Sina</h4>
=======
                <h4 style="margin: auto; padding: auto;">Login SI Masjid Ibnu Sina</h4>
>>>>>>> first commit
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group row">
<<<<<<< HEAD
=======
                    <!-- <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label> -->

>>>>>>> first commit
                    <div class="col-md-12">
                      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username">
                      @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                    <div class="col-md-12">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-lg-12">
                      <button type="submit" class="btn btn-primary" style="width:100%; margin-bottom:15px;">
<<<<<<< HEAD
                        {{ __('Masuk (Log in)') }}
=======
                        {{ __('Login') }}
>>>>>>> first commit
                      </button>
                    </div>

                    @if (Route::has('password.request'))
                    <div class="col-lg-12">
                      <a class="btn btn-sm btn-outline-info" href="{{ route('password.request') }}" style="width:100%; margin-top: 5px;">
                        {{ __('Lupa Password? Klik di sini.') }}
                      </a>
                    </div>
                    @endif
                    @if (Route::has('register'))
                    <div class="col-lg-12">
                      <a class="btn btn-sm btn-outline-success" href="{{ route('register') }}" style="width:100%; margin-top: 5px;">
                        {{ __('Belum punya akun? Daftar di sini.') }}
                      </a>
                    </div>
                    @endif
                  </div>
                </form>
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