<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{trans('admin.wow_souq')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loginStyle.css') }}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body
    style="background-image: url('{{Storage::url(settings()->image_login_admin)}}'); margin-bottom: 0;background-size: cover">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="box">
    <h2>Login</h2>
    <form method="post">
        {!! csrf_field() !!}
        <div class="inputBox">
            <label style="color: #ffffff">Username</label>
            <input type="text" name="email" required="required">
        </div>
        <div class="inputBox">
            <label style="color: #ffffff">Password</label>
            <input type="password" name="password" required="required">
        </div>
        <div class="checkbox icheck" style="color: #ffffff;margin-left: 20px;margin-bottom: 20px">
            <label>
                <input type="checkbox" name="rememberme" value="1"> {{trans('admin.remember_me')}}
            </label>
        </div>
        <input type="submit" name="" value="submit">
        <a href="{{ url('admin/password/reset') }}"
           class="col-xs-offset-1">{{trans('admin.I forgot my password')}}</a><br>
    </form>
</div>


<!-- jQuery 3 -->
<script src="{{ asset('') }}adminlte/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('') }}adminlte/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
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
