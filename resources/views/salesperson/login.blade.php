<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sales Person Login</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo"> <a href="{{ url('/designer/login') }}"><img src="{{ asset('assets/admin/images/header-logo-v2.png') }}" /></a> </div>
            <div class="login-box-body">
                <h3 class="login-box-msg">Sales Person Login</h3>
                @include('admin/includes/front_alerts')
                <form action="{{ url('/salesperson/login') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <input type="text" maxlength="50" name="Username" value="{{ old('Username') }}" class="form-control" placeholder="Username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span> </div>
                    <div class="form-group has-feedback">
                        <input type="password" maxlength="50" name="Password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>