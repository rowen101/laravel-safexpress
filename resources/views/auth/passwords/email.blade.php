<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Safexpress</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/public/favicon.png') }}" />
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

</head>

<body class="hold-transition login-page">
    <div class="login-box">




                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a href="{{ url('admin') }}" class="h1 text-primary"><b>Safe</b>Express</a>
                    </div>
                    <div class="card-body login-card-body">

                        <p class="login-box-msg">Forgot Password</p>
                        <form method="POST" class="my-login-validation" novalidate=""
                            action="{{ route('password.email') }}">
                            @csrf

                            @if (session('status'))
                                <div class="alert alert-ssuccess">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" placeholder="Enter your email">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Send Password Link
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="text-center">
                    Copyright &copy; {{ now()->year }}
                </div>







</body>

</html>
