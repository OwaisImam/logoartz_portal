<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Administrator Login</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box" >
           
            <div class="login-box-body" style="background: -webkit-linear-gradient(top, #ffff, #6bd6ff73)">
                <br>   
                 <div class="login-logo"> <a href="{{ url('/admin/login') }}"><img src="{{ asset('logovec.png') }}" width="200px" /></a> </div><br>
                <h3 class="login-box-msg" style="color: white"><b> Administrator Login</b> </h3>
                @include('admin/includes/front_alerts')
                <form action="{{ url('/admin/login') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <label >User Name</label>
                        <input type="text" maxlength="50" name="Username" value="{{ old('Username') }}" class="form-control" placeholder="Username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span> </div>
                    <div class="form-group has-feedback">
                          <label>Password</label>
                        <input type="password" maxlength="50" name="Password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
                   <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><b> Sign In </b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>