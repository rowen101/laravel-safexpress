<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Safexpress</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('../../assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('../../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('../../assets/dist/css/adminlte.min.css') }}">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <style>
        .logo img {
            max-height: 85px;

        }

        .header-card-bgcontainer {
            background: #0C2D74;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">


        <div class="card header-card-bgcontainer">
            <div class="card-header text-center ">
                <div class="d-flex align-items-center">
                    <a href="{{ url('admin') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('img/logo.png') }}" alt="safexpress">
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Register') }}</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocusid="email"
                        placeholder="{{ __('Name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" id="email" placeholder="{{ __('Email Address') }}"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                        placeholder="{{ __('Password') }}"class="form-control
                        @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" placeholder="{{ __('Confirm Password') }}" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="role_id" value="2" />
                <div class="row">

                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block"> {{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->

                </div>
            </form>
            <a href="/login" class="text-center">I already have a membership</a>
        </div>
    </div>
    <!-- /.login-card-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('../../assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('../../assets/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
