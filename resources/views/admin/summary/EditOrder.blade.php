<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $configuration->WebsiteTitle }} | Edit {{ $type }}</title>
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
                    <h1>Edit Digitizing {{ $type }}</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="{{ url('admin') }}">Edit Digitizing {{ $type }}</a></li>
                        <li class="active">Edit</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    {!! Form::open([ 'url' => 'admin/update-order/', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Edit</h3>
                                    <div class="box-tools pull-right">
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                                        <button type="button" class="btn btn-sm btn-warning" onclick="location.href = '{{ url('admin/Norder-details/'.$order->OrderID) }}'"><i class="fa fa-times"></i> Cancel</button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <!-- general form elements -->
                                            <div class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">{{ $type }} Detail</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="OrderID">{{ $type }} # : <span class="mandatory">*</span></label>
                                                                {!! Form::text('OrderNumber', $order->OrderID, ['placeholder' => 'Order Number', 'class' => 'form-control' , 'disabled' , 'id' => 'OrderID']) !!}
                                                                <input type="hidden" name="id" value="{{ $order->OrderID }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="Cell">Design Name:</label>
                                                                {!! Form::text('DesignName', $order->DesignName, ['placeholder' => 'Enter Cell', 'class' => 'form-control', 'id' => 'Cell']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>PO Number</label>
                                                                {!! Form::text('PoNum', $order->PONumber, ['placeholder' => 'Enter PO Number', 'class' => 'form-control', 'id' => 'Email']) !!}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Required Format</label>
                                                            {{ Form::select('ReqFormat', array('' => 'Select', 'PDF' => 'PDF', 'JPEG' => 'JPEG', 'PNG' => 'PNG', 'EMB' => 'EMB', 'DST' => 'DST', 'POF' => 'POF', 'PXF' => 'PXF', 'EXP' => 'EXP', 'CND' => 'CND', 'Other' => 'Other'), $order->ReqFormat, array('class' => 'form-control')) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Fabric </label>

                                                         {{ Form::select('Fabric', array('' => 'Select',
                                                                                    'Pique Polo' => 'Pique Polo',
                                                                                    'Cotton' => 'Cotton',
                                                                                    'Performance Polyester' => 'Performance Polyester',
                                                                                    'Silk' => 'Silk',
                                                                                    'Twill' => 'Twill',
                                                                                    'Towel' => 'Towel',
                                                                                    'Woolen' => 'Woolen',
                                                                                    'Linen' => 'Linen',
                                                                                    'Leather' => 'Leather',
                                                                                    'Felt' => 'Felt',
                                                                                    'Tote' => 'Tote',
                                                                                    'Mesh' => 'Mesh',
                                                                                    'Beanies' => 'Beanies',
                                                                                    'Fleece/Softshell' => 'Fleece/Softshell/',
                                                                                    'Other' => 'Other'),
                                                     null, array('class' => 'form-control')) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Zip">Placement: </label>
                                                            {{ Form::select('Placement', array( '' => 'Select', 'Cap Front' => 'Cap Front', 'Cap Side' => 'Cap Side', 'Cap Back' => 'Cap Back', 'Left Chest' => 'Left Chest', 'Jacket Back' => 'Jacket Back', 'Gloves' => 'Gloves', 'Towel' => 'Towel', 'Visor' => 'Visor', 'Sleeve' => 'Sleeve', 'Socks' => 'Socks', 'Collar' => 'Collar', 'Other' => 'Other' ), $order->Placement, array('class' => 'form-control')) }} </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                </div>
                                                <div class="row">


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Height">Height:</label>
                                                            {!! Form::text('Height', $order->Height, ['placeholder' => 'Enter Height', 'class' => 'form-control', 'id' => 'Height']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="State">Width: </label>
                                                            {!! Form::text('Width', $order->Width, ['placeholder' => 'Enter Width', 'class' => 'form-control', 'id' => 'width']) !!}
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="Address">Scale:</label>
                                                            {{ Form::select('Scale', array('' => 'Select', 'Inch' => 'Inch', 'Centimeter' => 'Centimeter', 'Millimeter' => 'Millimeter', 'Pixel' => 'Pixel'), $order->Scale, array('class' => 'form-control')) }} </div>

                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="NumofClr">Number of Colors</label>
                                                            {{ Form::text('NumofClr', $order->NoOfColors, ['placeholder' => 'Number of Colors', 'class' => 'form-control']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="NumofClr">Color Binding</label>
                                                            {{ Form::select('Clrblending', array( 'Yes' => 'Yes', 'No' => 'No', 'NotSure' => 'Not Sure'), $order->ColorBlending, array('class' => 'form-control')) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="PictureEmbroidery">Picture Embroidery?</label>
                                                            {{ Form::select('PicEmb', array( 'Yes' => 'Yes', 'No' => 'No', 'NotSure' => 'Not Sure'), $order->PictureEmbroidery, array('class' => 'form-control')) }}
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="FabricClr">Background Fill?</label>
                                                            {{ Form::select('BackFill', array( 'Yes' => 'Yes', 'No' => 'No', 'NotSure' => 'Not Sure'), $order->BackgroundFill, array('class' => 'form-control')) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="instraction">Additional Instructions:</label>

                                                            {{ Form::textarea('AddIns', $order->MoreInstructions, ['placeholder' => 'ADDITIONAL INSTRUCTIONS', 'class' => 'form-control']) }}
                                                        </div>
                                                    </div>




                                                </div>

                                                <div class="row">
                                                
                                                    <div class="col-md-4">
                                                            <label>Order Stable Type:</label>
                                                        <?php if($order->OrderStatus == '' || $order->OrderStatus == 0){ $order->OrderStatus = 1;} ?>

                                                             {{ Form::select('StableStatus', $stableStatus, $order->OrderStatus,array('class' => 'form-control')) }}

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                 
                                    <div class="col-md-12">
                                        <div class="box box-primary">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Customer Artwork:</h3>
                                            </div>
                                            <div class="box-body">

                                                <div class="col-md-3">
                                                      <label for="instraction">File One:</label><br>

                                                        <?php
                                                            if ($order->File1 != "") {
                                                                  $file = explode(".", $order->File1);
                                                                  $ext = $file['1'];
                                                                  // dd($ext);
                                                                   if (!in_array($ext, $allowed_ext)) {
                                                                   
                                                    ?>  
                                                       
                                                         <a href="{{asset('uploads/orders/digi').'/'. $order->File1 }}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{  $order->File1 }}</a>

                                                    <?php }else { ?>

                                                          <a download="{{ $order->File1 }}" href="{{  asset('uploads/orders/digi/'.$order->File1) }}"><img src="{{ asset('uploads/orders/digi/'.$order->File1) }}" width="100%" /></a>

                                                    <?php 
                                                } 
                                            }else{
                                             ?>
                                                
                                                  <h3>No Artwork</h3>

                                             <?php } ?>
                                                    <br><br>
<!--                                                        <label >
                                                          <input type="checkbox" class="flat-red">
                                                            Do u Like to Remove this art work?
                                                        </label> -->

                                                       <div class="form-group">
                                                    <label for="Image">Image: <span class="mandatory">*</span></label>
                                                    {!! Form::file('File1') !!}
                                                     </div>


                                                </div>

                                            

                                                <div class="col-md-3">

                                                      <label for="instraction">File Two:</label><br>

                                                        <?php
                                                            if ($order->File2 != "") {
                                                                  $file = explode(".", $order->File2);
                                                                  $ext = $file['1'];
                                                                  // dd($ext);
                                                                   if (!in_array($ext, $allowed_ext)) {
                                                                   
                                                    ?>  
                                                       
                                                         <a href="{{asset('uploads/orders/digi').'/'. $order->File2 }}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{  $order->File2 }}</a>

                                                    <?php }else { ?>

                                                          <a download="{{ $order->File2 }}" href="{{  asset('uploads/orders/digi/'.$order->File2) }}"><img src="{{ asset('uploads/orders/digi/'.$order->File2) }}" width="100%" /></a>

                                                    <?php 
                                                } 
                                            }else{
                                             ?>
                                                   <h3>No Artwork</h3>
                                                  
                                             <?php } ?>
                                                

                                                     <div class="form-group">
                                                    <label for="Image">Image: <span class="mandatory">*</span></label>
                                                    {!! Form::file('File2') !!}
                                                     </div>

                                                    
                                                    
                                                </div>

                                                <div class="col-md-3">

                                                      <label for="instraction">File Three:</label><br>

                                                        <?php
                                                            if ($order->File3 != "") {
                                                                  $file = explode(".", $order->File3);
                                                                  $ext = $file['1'];
                                                                  // dd($ext);
                                                                   if (!in_array($ext, $allowed_ext)) {
                                                                   
                                                    ?>  
                                                       
                                                         <a href="{{asset('uploads/orders/digi').'/'. $order->File3 }}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{  $order->File3 }}</a>

                                                    <?php }else { ?>

                                                          <a download="{{ $order->File3 }}" href="{{  asset('uploads/orders/digi/'.$order->File3) }}"><img src="{{ asset('uploads/orders/digi/'.$order->File3) }}" width="100%" /></a>

                                                    <?php 
                                                } 
                                            }else{
                                             ?>
                                                  <h3>No Artwork</h3>
                                                  
                                             <?php } ?>
                                                

                                                     <div class="form-group">
                                                    <label for="Image">Image: <span class="mandatory">*</span></label>
                                                    {!! Form::file('File3') !!}
                                                     </div>

                                                    
                                                    
                                                </div>

                                                <div class="col-md-3">

                                                      <label for="instraction">File Four:</label><br>

                                                        <?php
                                                            if ($order->File4 != "") {
                                                                  $file = explode(".", $order->File4);
                                                                  $ext = $file['1'];
                                                                  // dd($ext);
                                                                   if (!in_array($ext, $allowed_ext)) {
                                                                   
                                                    ?>  
                                                       
                                                         <a href="{{asset('uploads/orders/digi').'/'. $order->File4 }}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{  $order->File4 }}</a>

                                                    <?php }else { ?>

                                                          <a download="{{ $order->File4 }}" href="{{  asset('uploads/orders/digi/'.$order->File4) }}"><img src="{{ asset('uploads/orders/digi/'.$order->File4) }}" width="100%" /></a>

                                                    <?php 
                                                } 
                                            }else{
                                             ?>
                                                   <h3>No Artwork</h3>
                                                  
                                             <?php } ?>
                                                

                                                     <div class="form-group">
                                                    <label for="Image">Image: <span class="mandatory">*</span></label>
                                                    {!! Form::file('File4') !!}
                                                     </div>


                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="box-tools pull-right">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="location.href = '{{ url('admin/Norder-details/'.$order->OrderID) }}'"><i class="fa fa-times"></i> Cancel</button>
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