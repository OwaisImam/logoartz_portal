<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Configuration</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/iCheck/minimal/blue.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">


            <!-- Left side column. contains the logo and sidebar -->
            @include('admin/includes/header')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-alert">
                        <div class="row">
                            <div class="col-xs-12" style="padding: 5px 20px;">
                                @include('admin/includes/front_alerts')
                            </div>                            
                        </div>
                    </section>
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>Configuration</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Configuration</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        {!! Form::open([ 'url' => 'admin/configuration', 'files'=>true]) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Configuration</h3>
                                        <div class="box-tools pull-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Edit</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="WebsiteTitle">Website Title <span class="mandatory">*</span></label>
                                                                    {!! Form::text('WebsiteTitle', $mConfiguration->WebsiteTitle, ['class' => 'form-control', 'id' => 'WebsiteTitle']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Contact1">Contact 1 </label>
                                                                    {!! Form::text('Contact1', $mConfiguration->Contact1, ['class' => 'form-control', 'id' => 'Contact1']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Contact2">Contact 2 </label>
                                                                    {!! Form::text('Contact2', $mConfiguration->Contact2, ['class' => 'form-control', 'id' => 'Contact2']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Email1">Email 1 </label>
                                                                    {!! Form::text('Email1', $mConfiguration->Email1, ['class' => 'form-control', 'id' => 'Email1']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Email2">Email 2 </label>
                                                                    {!! Form::text('Email2', $mConfiguration->Email2, ['class' => 'form-control', 'id' => 'Email2']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Facebook">Facebook </label>
                                                                    {!! Form::text('Facebook', $mConfiguration->Facebook, ['class' => 'form-control', 'id' => 'Facebook']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Twitter">Twitter </label>
                                                                    {!! Form::text('Twitter', $mConfiguration->Twitter, ['class' => 'form-control', 'id' => 'Twitter']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Instagram">Instagram </label>
                                                                    {!! Form::text('Instagram', $mConfiguration->Instagram, ['class' => 'form-control', 'id' => 'Instagram']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Address">Address </label>
                                                            {!! Form::textarea('Address', $mConfiguration->Address, ['class' => 'form-control', 'id' => 'Address', 'rows' => 2]) !!}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Images</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label>Logo: </label><br>
                                                            <input type="file" name="Logo" />
                                                        </div>
                                                        <?php
                                                        if ($mConfiguration->Logo != "" && $mConfiguration->Logo != null) {
                                                            ?>
                                                            <div class="form-group">
                                                                {!! \Html::image('/uploads/website/' . $mConfiguration->Logo, $mConfiguration->Logo, ['style' => 'width:120px; background: #ccc;' ]) !!}
                                                            </div>
                                                        <?php } ?>
                                                        <hr /> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="box-tools pull-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {!! FORM::close() !!}
                    </section>
                </div>
            </div>
            @include('admin/includes/footer')
        </div>
        <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/fastclick/fastclick.js') }}"></script>
        <script src="{{ asset('assets/admin/dist/js/app.min.js') }}"></script>
    </body>
</html>
