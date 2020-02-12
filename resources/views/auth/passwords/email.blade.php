@include('layouts.header')

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{route('home')}}/public/dist/assets/img/ibnusina.jpg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Reset Password</h4>
                            </div>
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="card-body">
                                <p class="text-muted">Kami akan mengirimkan email berisi link untuk reset password Anda.</p>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>
                                        <div class="col-md-12" style="width:100%">
                                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 offset-md-2" style="width:100%">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Kirim Email Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-2" style="width:100%">
                                        <br>
                                        <a href="{{ route('login') }}" class="btn btn-info"> Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; SIMASJID {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>