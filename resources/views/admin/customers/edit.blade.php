<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Edit Customer</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/iCheck/minimal/blue.css">

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
                        <h1>Customers</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="{{ url('admin/customers') }}">Customers</a></li>
                            <li class="active">Edit</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        {!! Form::open([ 'url' => 'admin/customers/'.$cust->CustomerID, 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Edit</h3>
                                        <div class="box-tools pull-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                                            <button type="button" class="btn btn-sm btn-warning" onclick="location.href = '{{ url('admin/customers') }}'"><i class="fa fa-times"></i> Cancel</button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Info</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="CustomerName">Customer Name: <span class="mandatory">*</span></label>
                                                                    {!! Form::text('CustomerName', $cust->CustomerName, ['placeholder' => 'Enter Customer Name', 'class' => 'form-control', 'id' => 'CustomerName']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Cell">Cell: </label>
                                                                    {!! Form::number('Cell', $cust->Cell, ['placeholder' => 'Enter Cell', 'class' => 'form-control', 'id' => 'Cell']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Email">Email:</label>
                                                                    {!! Form::text('Email', $cust->Email, ['placeholder' => 'Enter Email', 'class' => 'form-control', 'id' => 'Email']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Fax">Fax: </label>
                                                                    {!! Form::text('Fax', $cust->Fax, ['placeholder' => 'Enter Fax', 'class' => 'form-control', 'id' => 'Fax']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Company">Company:</label>
                                                                    {!! Form::text('Company', $cust->Company, ['placeholder' => 'Enter Company', 'class' => 'form-control', 'id' => 'Company']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="State">State: </label>
                                                                    {!! Form::text('State', $cust->State, ['placeholder' => 'Enter State', 'class' => 'form-control', 'id' => 'State']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="City">City:</label>
                                                                    {!! Form::text('City', $cust->City, ['placeholder' => 'Enter City', 'class' => 'form-control', 'id' => 'City']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Zip">Zip: </label>
                                                                    {!! Form::text('Zip', $cust->Zip, ['placeholder' => 'Enter Zip', 'class' => 'form-control', 'id' => 'Zip']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Username">Username: <span class="mandatory">*</span></label>
                                                                    {!! Form::text('Username', $cust->Username, ['placeholder' => 'Enter Username', 'class' => 'form-control', 'id' => 'Username']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Password">Password: <span class="mandatory">(Leave blank if you do not want to change)</span></label>
                                                                    {!! Form::password('Password', ['placeholder' => 'Enter Password', 'class' => 'form-control', 'id' => 'Password']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Address">Address:</label>
                                                            {!! Form::text('Address', $cust->Address, ['placeholder' => 'Enter Address', 'class' => 'form-control', 'id' => 'Address']) !!}
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="CsNote">Customer Note:</label>
                                                            {!! Form::text('CsNote', $cust->CsNote, ['placeholder' => 'Enter Note', 'class' => 'form-control', 'id' => 'CsNote']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="CsNote">Price Plan:</label>
                                                            {!! Form::textarea('Pplane', $cust->priceplane, ['placeholder' => 'Enter Price Plan','rows' => 4, 'cols' => 54, 'class' => 'form-control', 'id' => 'CsNote']) !!}
                                                         </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Setting</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="CountryID">Country: <span class="mandatory">*</span></label>
                                                            {!! Form::select('CountryID', $countries_dd, $cust->CountryID, ['class' => 'form-control select2', 'id' => 'CountryID']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Status">Status</label><br>
                                                            <label>
                                                                {!! FORM::radio('Status', 1, ($cust->Status == 1 ? true : null)) !!}
                                                                Active
                                                            </label>
                                                            <label>
                                                                {!! FORM::radio('Status', 0, ($cust->Status == 0 ? true : null)) !!}
                                                                Deactive
                                                            </label>
                                                        </div>

                                                        <?php  if($cust->SalesPersonID == 0){ ?> 

                                                           <div class="form-group">
                                                                <label>Salesperson:</label>


                                                                {!! Form::select('SalesPerson', $salesperson, $cust->SalesPersonID, ['class' => 'form-control']) !!}

                                                                <!-- /.input group -->
                                                            </div>
                                                        <?php }else{
                                                        ?>

                                                               <div class="form-group">
                                                                <label>Salesperson:</label>

                                                         {!! Form::select('SalesPerson', $salesperson, $cust->SalesPersonID, ['class' => 'form-control']) !!}
                                                     
                                                 <?php } ?>


                                                        <br>
                                                        <div class="form-group">
                                                            <label for="Image">Image: <span class="mandatory">*</span></label>
                                                            {!! Form::file('Image') !!}
                                                        </div>

                                                        <?php
                                                        if ($cust->DP != "") {
                                                            ?>
                                                            <img src="<?php echo asset('uploads') . '/customers/' . $cust->DP ?>" style="width:200px; height: auto;" />
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="box-tools pull-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                                            <button type="button" class="btn btn-sm btn-warning" onclick="location.href = '{{ url('admin/customers') }}'"><i class="fa fa-times"></i> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- /.col (right) -->
                        </div>
                        <!-- /.row -->
                        {!! FORM::close() !!}
                    </section>
                    <!-- /.content -->
                </div>
            </div>

            @include('admin/includes/footer')
        </div>
        <!-- ./wrapper -->

        <script src="{{ asset('assets/admin/') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('assets/admin/') }}/bootstrap/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/admin/') }}/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/admin/') }}/dist/js/app.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/dist/js/demo.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <script>
                                                $('input[type="checkbox"], input[type="radio"]').iCheck({
                                                checkboxClass: 'icheckbox_minimal-blue',
                                                        radioClass: 'iradio_minimal-blue'
                                                });
        </script>
    </body>
</html>