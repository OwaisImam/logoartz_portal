<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Designer Details</title>
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
                        <h1>Designer Details</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="{{ url('admin/customers') }}">Designers</a></li>
                            <li class="active">Details</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">Details</h4>
                                        <div class="box-tools pull-right">
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Info</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="CustomerName">Designer Name: </label>
                                                                    <h4>{!!$design->DesignerName!!}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Cell">Cell: </label>
                                                                    <h4>{!!$design->Cell!!}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Email">Email:</label>
                                                                    <h4>{!!$design->Email!!}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Fax">Fax: </label>
                                                                    <h4>{!!$design->Fax!!}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="catogary">Catogary:</label>
                                                                    <h4>{!!$design->Category!!}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="State">State: </label>
                                                                    <h4>{!!$design->State!!}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="City">City:</label>
                                                                    <h4>{!!$design->City!!}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Zip">Zip: </label>
                                                                    <h4>{!!$design->Zip!!}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Username">Username: </label>
                                                                    <h4>{!!$design->Username!!}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Address">Address:</label>
                                                            <h4>{!!$design->Address!!}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">Setting</h4>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="CountryID">Country: </label>
                                                            {!! Form::select('CountryID', $countries_dd, $design->CountryID, ['class' => 'form-control select2', 'id' => 'CountryID', 'disabled' => 'disabled']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Status">Status</label><br>
                                                            <h4>
                                                                {!! ($design->Status == 1 ? 'Active' : '') !!}
                                                            </h4>
                                                            <h4>
                                                                {!! ($design->Status == 0 ? 'Deactive' : '') !!}
                                                            </h4>
                                                        </div>

                                                        <?php
                                                        if ($design->DP != "") {
                                                            ?>
                                                            <img src="<?php echo asset('uploads') . '/designers/' . $design->DP ?>" style="width:200px; height: auto;" />
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                    </div>
                                </div>
                            </div>


                            <!-- /.col (right) -->
                        </div>
                        <!-- /.row -->
                    </section>
                    <!-- /.content -->
                </div>
            </div>

            @include('admin/includes/footer')
        </div>
        <!-- ./wrapper -->

        <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/admin/plugins/fastclick/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/admin/dist/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

        <script>
                                                $('input[type="checkbox"], input[type="radio"]').iCheck({
                                                checkboxClass: 'icheckbox_minimal-blue',
                                                        radioClass: 'iradio_minimal-blue'
                                                });
        </script>
    </body>
</html>
