<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forget Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rtl/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/rtl/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/rtl/rtl.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('login') }}"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Forget Password</p>
        <div class="card-header">{{ __('Reset Password') }}</div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                <h1>{{ session('success') }}</h1>
            </div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
                <label for="email"
                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    {{--                                    @error('email')--}}
                    {{--                                    <span class="invalid-feedback" role="alert">--}}
                    {{--                                        <strong>{{ $message }}</strong>--}}
                    {{--                                    </span>--}}
                    {{--                                    @enderror--}}
                </div>
            </div>

            <div class="form-group row">
                <label for="password"
                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           required autocomplete="new-password">

                    {{--                                    @error('password')--}}
                    {{--                                    <span class="invalid-feedback" role="alert">--}}
                    {{--                                        <strong>{{ $message }}</strong>--}}
                    {{--                                    </span>--}}
                    {{--                                    @enderror--}}
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </form>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="{{ asset('') }}adminlte/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('') }}adminlte/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{ asset('') }}adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('') }}adminlte/plugins/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('') }}adminlte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('') }}adminlte/js/demo.js"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
