<?php
if (!empty($DigiOrders)) {
    if ($DigiOrders->OrderType == 2 || $DigiOrders->OrderType == 4) {
        $type = 'Quote';
    } else {
        $type = 'Order';
    }
}

$allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', 'PNG', 'gif', 'GIF'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $configuration->WebsiteTitle }} | Digi Order Details</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}">
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
    <style>
        .alert {
            opacity: 0.5;
        }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        @include('designer/includes/header')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container">



                <section class="content">




                    <?php if($DigiOrders->Status == 5 ){ ?>
                    <div class="alert alert-warning">Approved Order to Complete</div>
                    <?php }elseif($DigiOrders->Status == 10){ ?>
                    <div class="alert alert-warning">{{ $type }} Revision</div>
                    <?php }elseif($DigiOrders->Status == 1){ ?>
                    <div class="alert alert-info">New {{ $type }}</div>
                    <?php }else{ ?>
                    <div class="alert alert-success">{{ $type }} Sent</div>
                    <?php }  ?>



                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="" style="text-align: center;">Digitizing {{ $type }} Detail</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-sm btn-warning"
                                    onclick="location.href = '{{ url('designer/dashboard') }}'"><i
                                        class="fa fa-times"></i> Cancel</button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body" style="font-size: 18px;">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Design Code </label>
                                        <p>{{ App\Http\Helper::getPrefix('digitizing', $DigiOrders->OrderType ) . '-' .$DigiOrders->OrderID }} </p>

                                    </div>
                                </div>
                                <!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Design Name</label>
                                        <p>{{ $DigiOrders->DesignName }} </p>
                                    </div>
                                </div>



                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>PO Number</label>
                                        <p>{{ $DigiOrders->PONumber }} </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Required Format</label>
                                        <p>{{ $DigiOrders->ReqFormat }} </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Other Format</label>
                                        <p> {{ $DigiOrders->OtherFormat }}</p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fabric </label>
                                        <p>{{ $DigiOrders->Fabric }}</p>
                                    </div>
                                </div>

                                <!-- /.col --

           
              <!-- /.form-group -->

                                <!-- /.col -->
                            </div>


                            <div class="row">


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fabric Color</label>
                                        <p>{{ $DigiOrders->FabricColor }} </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Width</label>
                                        <p>{{ $DigiOrders->Width }} {{ $DigiOrders->Scale }}</p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Height</label>
                                        <p>{{ $DigiOrders->Height }} {{ $DigiOrders->Scale }}</p>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Placement</label>
                                        <p>{{ $DigiOrders->Placement }} </p>
                                    </div>
                                </div>






                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>No. of Colors</label>
                                        <p>{{ $DigiOrders->NoOfColors }} </p>

                                    </div>
                                </div>
                                <!-- /.form-group -->


                                <!--
                             <div class="col-md-2">
                            <div class="form-group">
                              <label>Color Blending</label>
                                 <p> {{ $DigiOrders->ColorBlending }} </p>
                                </div>
                                </div>



                             <div class="col-md-2">
                            <div class="form-group">
                              <label>Picture Embroidery</label>
                                 <p> {{ $DigiOrders->PictureEmbroidery }} </p>
                                </div>
                                </div>


                             <div class="col-md-2">
                            <div class="form-group">
                              <label>Background FILL</label>
                                 <p> {{ $DigiOrders->BackgroundFill }} </p>
                                </div>
                                </div> -->



                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Upload on</label>
                                        <p>{{ $DigiOrders->DateAdded }} </p>
                                    </div>
                                </div>


                            </div>


                            <!-- /.col --

           
              <!-- /.form-group -->

                            <!-- /.col -->





                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->

                    <div class="row" style="font-size: 18px;">
                        <div class="col-md-6">

                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title" style="text-align: ">Additional Detail</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date dd/mm/yyyy -->

                                    <div class="row">


                                        @if ($DigiOrders->OrderType == 2 || $DigiOrders->OrderType == 4)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Designer Quote</label>
                                                    <div><span class="label label-warning" id="prices"> Rs.
                                                            {{ $DigiOrders->DesignerPrice }}</span></div>
                                                </div>
                                            </div>
                                        @endif


                                    </div>
                                    <!-- /.form group
               -->

                                    <!-- Date mm/dd/yyyy -->

                                    <div class="row">


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Admin Message</label>
                                                <div>{{ $DigiOrders->MessageForDesigner }} </div>
                                            </div>
                                        </div>
                                        @if ($DigiOrders->OrderType == 1 || $DigiOrders->OrderType == 9)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Other Message's)</label>
                                                    @foreach ($Revision as $revise)
                                                        <div>
                                                            <h4>
                                                                {{ $revise->Message }}
                                                                <small
                                                                    class="pull-right">{{ $revise->DateAdded }}</small>
                                                            </h4>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                    </div>



                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Customer Artwork</h3>
                                </div>

                                <div class="row">
                                    @if ($DigiOrders->File1 != '')
                                        <div class="col-md-6">

                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        1</label>

                                                    <?php
                                          
                                                 
                                               if ($DigiOrders->File1 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File1);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                    <a download="{{ $DigiOrders->File1 }}"
                                                        href="{{ asset('uploads/orders/digi/' . $DigiOrders->File1) }}"><img
                                                            src="{{ asset('uploads/orders/digi/' . $DigiOrders->File1) }}"
                                                            width="80" height="60" /></a>
                                                    <?php  }else{  ?>

                                                    <a href="{{ asset('uploads/orders/digi') . '/' . $DigiOrders->File1 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $DigiOrders->File1 }}</a>

                                                    <?php  } }  ?>

                                                </div>
                                            </div>

                                        </div> <!--Col Close-->
                                    @endif

                                    @if ($DigiOrders->File2 != '')
                                        <div class="col-md-6">


                                            <div class="box-body">


                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        2</label>


                                                    <?php
                                          
                                                 
                                               if ($DigiOrders->File2 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File2);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                    <a download="{{ $DigiOrders->File2 }}"
                                                        href="{{ asset('uploads/orders/digi/' . $DigiOrders->File2) }}"><img
                                                            src="{{ asset('uploads/orders/digi/' . $DigiOrders->File2) }}"
                                                            width="80" height="60" /></a>
                                                    <?php  }else{  ?>

                                                    <a href="{{ asset('uploads/orders/digi') . '/' . $DigiOrders->File2 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $DigiOrders->File2 }}</a>

                                                    <?php  } }  ?>

                                                </div>

                                            </div>

                                        </div> <!--Col Close-->
                                    @endif

                                </div> <!--Row Close-->




                                <div class="row">
                                    @if ($DigiOrders->File3 != '')
                                        <div class="col-md-6">

                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        3</label>


                                                    <?php
                                          
                                                 
                                               if ($DigiOrders->File3 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File3);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                    <a download="{{ $DigiOrders->File3 }}"
                                                        href="{{ asset('uploads/orders/digi/' . $DigiOrders->File3) }}"><img
                                                            src="{{ asset('uploads/orders/digi/' . $DigiOrders->File3) }}"
                                                            width="80" height="60" /></a>
                                                    <?php  }else{  ?>

                                                    <a href="{{ asset('uploads/orders/digi') . '/' . $DigiOrders->File3 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $DigiOrders->File3 }}</a>

                                                    <?php  } }  ?>

                                                </div>
                                            </div>

                                        </div> <!--End Col -->
                                    @endif

                                    @if ($DigiOrders->File4 != '')
                                        <div class="col-md-6">

                                            <div class="box-body">


                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        4</label>

                                                    <?php
                                          
                                                 
                                               if ($DigiOrders->File4 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File4);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                    <a download="{{ $DigiOrders->File4 }}"
                                                        href="{{ asset('uploads/orders/digi/' . $DigiOrders->File4) }}"><img
                                                            src="{{ asset('uploads/orders/digi/' . $DigiOrders->File4) }}"
                                                            width="80" height="60" /></a>
                                                    <?php  }else{  ?>

                                                    <a href="{{ asset('uploads/orders/digi') . '/' . $DigiOrders->File4 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $DigiOrders->File4 }}</a>

                                                    <?php  } }  ?>

                                                </div>

                                            </div>


                                        </div> <!--End Col -->
                                    @endif
                                </div>
                                <!-- /.box-body -->





                            </div>
                            <!-- /.box -->

                        </div>
                        <!-- iCheck -->

                        
                        <!--  Order 1st Release Detail Only -->
                        @if ($RivisionHistory->IsEmpty())
                            @if ($revision_history != null)

                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Order Release History</h3>
                                        </div>
                                        <div class="box-body m-l-250">

                                            @foreach ($revision_history as $history)
                                                <div class="form-group" style="margin-bottom: 20px">

                                                    <label>Designer Message</label>
                                                    <p><?= $history['DesignerMessage'] ?><small
                                                            class="pull-right">{{ $history['DateAdded'] }}</small><br>
                                                            @if(count($history['Files']) > 0)
                                                            <label>Order Files:</label><br>
                                                            @endif


                                                        <?php
                                              $counta = 0;
                                              $countb = 0;
                                              $countc = 0;
                                                    if(!empty($history['Files'])) {
                                                        foreach($history['Files'] as $mfile) {   
                                                    ?>

                                                    <div class="col-md-12">

                                                        <div class="form-group">

                                                            @if ($mfile->Category == 'a')
                                                                <?php if($counta < 1) { ?>
                                                                <label>Files A</label><br>
                                                                <?php } ?>
                                                                <div class="col-md-6" style="margin-top: 5px">
                                                                    <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                        class="btn btn-success btn-flat"
                                                                        download=""><i class="fa fa-download"></i>
                                                                        {{ $mfile->File }}</a>
                                                                </div>
                                                                <?php $counta++; ?>
                                                                <div class="clearfix"></div>
                                                            @endif




                                                            @if ($mfile->Category == 'b')
                                                                <?php if($countb < 1) { ?>
                                                                <label>Files B</label><br>
                                                                <?php } ?>
                                                                <div class="col-md-6" style="margin-top: 5px">
                                                                    <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                        class="btn btn-success btn-flat"
                                                                        download=""><i class="fa fa-download"></i>
                                                                        {{ $mfile->File }}</a>
                                                                </div>
                                                                <?php $countb++; ?>
                                                                <div class="clearfix"></div>
                                                            @endif

                                                            @if ($mfile->Category == 'c')
                                                                <?php if($countc < 1) { ?>
                                                                <label>Files C</label><br>
                                                                <?php } ?>
                                                                <div class="col-md-6" style="margin-top: 5px">
                                                                    <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                        class="btn btn-success btn-flat"
                                                                        download=""><i class="fa fa-download"></i>
                                                                        {{ $mfile->File }}</a>
                                                                </div>
                                                                <?php $countc++; ?>
                                                                <div class="clearfix"></div>
                                                            @endif

                                                        </div>
                                                    </div>


                                                    @if ($mfile->Category == '')
                                                        <div class="col-md-6" style="margin-top: 5px">
                                                            <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                class="btn btn-success btn-flat" download=""><i
                                                                    class="fa fa-download"></i>
                                                                {{ $mfile->File }}</a>
                                                        </div>
                                                    @endif

                                                    <?php 
                                                }
                                                    }else{  ?>


                                                    <h3 class="box-title">No File</h3>
                                                    <?php   }
                                                    ?>

                                                    <div class="clearfix"></div>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div><br>
                                    </div>
                                </div>



                            @endif
                        @endif


                        @if (!$RivisionHistory->IsEmpty())
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Order History </h3>
                                </div>
                                <div class="box-body m-l-250">
                                    @foreach ($RivisionHistory as $history)
                                        <div class="form-group">
                                            <label>{{ $history->From == 3 ? 'Customer' : 'Admin' }}:</label>
                                            <p><?= $history->Message ?><small
                                                    class="pull-right">{{ $history->DateAdded }}</small></p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    

                        @if (!$RivisionHistory->IsEmpty())

                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revision History </h3>
                                    </div>
                                    <div class="box-body m-l-250">
                                        <?php $RevCount = 0;
                                        $Rev_heading = 'Order History';
                                        ?>

                                        @foreach ($revision_history as $history)
                                            <div class="form-group" style="margin-bottom: 20px">
                                                <?php  
                                                if($RevCount == 0){
                                            ?>
                                                <h4><strong>Order First Response</strong></h4><br>
                                                <?php }else{ ?>

                                                    @if(count($history['Files']) > 0)
                                                     <h4><strong>Revision {{ $RevCount }}</strong></h4><br>
                                                    @endif
                                                
                                                <?php } ?>
                                                <label>Designer Message</label>
                                                <p><?= $history['DesignerMessage'] ?><small
                                                        class="pull-right">{{ $history['DateAdded'] }}</small><br>
                                                    <label>Files:</label><br>
                                                    <?php
                                                $counta = 0;
                                                $countb = 0;
                                                $countc = 0;
                                                $quotecount= 0;
                                                    if(!empty($history['Files'])) {
                                                        foreach($history['Files'] as $mfile) {   
                                                    ?>


                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        @if ($mfile->Category == 'a')
                                                            <?php if($counta < 1) { ?>
                                                            <label>Files A</label><br>
                                                            <?php } ?>
                                                            <div class="col-md-6" style="margin-top: 5px">
                                                                <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                    class="btn btn-success btn-flat" download=""><i
                                                                        class="fa fa-download"></i>
                                                                    {{ $mfile->File }}</a>
                                                            </div>
                                                            <?php $counta++; ?>
                                                        @endif


                                                        @if ($mfile->Category == 'b')
                                                            <?php if($countb < 1) { ?>
                                                            <label>Files B</label><br>
                                                            <?php } ?>
                                                            <div class="col-md-6" style="margin-top: 5px">
                                                                <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                    class="btn btn-success btn-flat" download=""><i
                                                                        class="fa fa-download"></i>
                                                                    {{ $mfile->File }}</a>
                                                            </div>
                                                            <?php $countb++; ?>
                                                            <div class="clearfix"></div>
                                                        @endif

                                                        @if ($mfile->Category == 'c')
                                                            <?php if($countc < 1) { ?>
                                                            <label>Files C</label><br>
                                                            <?php } ?>

                                                            <div class="col-md-6" style="margin-top: 5px">
                                                                <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                    class="btn btn-success btn-flat" download=""><i
                                                                        class="fa fa-download"></i>
                                                                    {{ $mfile->File }}</a>
                                                            </div>
                                                            <?php $countc++; ?>
                                                            <div class="clearfix"></div>
                                                        @endif


                                                        @if ($mfile->Category == '')
                                                            <div class="col-md-6" style="margin-top: 5px">
                                                                <a href="{{ asset('uploads/orders/digi') . '/' . $mfile->File }}"
                                                                    class="btn btn-success btn-flat" download=""><i
                                                                        class="fa fa-download"></i>
                                                                    {{ $mfile->File }}</a>
                                                            </div>
                                                        @endif



                                                    </div>
                                                </div>


                                                <?php 
                                                }
                                                    }
                                                    ?>
                                                <?php $RevCount++; ?>
                                                <div class="clearfix"></div>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div><br>
                                </div>
                            </div>
                        @endif





                        @if (
                            $DigiOrders->OrderType == 0 ||
                                $DigiOrders->OrderType == 2 ||
                                $DigiOrders->OrderType == 3 ||
                                $DigiOrders->OrderType == 9)
                            @if ($DigiOrders->Status == 1)
                                {!! Form::open(['url' => 'designer/digi/price/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
                                <div class="col-md-6">


                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Quote Price </h3>
                                            @include('admin/includes/front_alerts')
                                        </div>

                                        <div class="box-body">
                                            <!-- Date -->
                                            <div class="form-group">


                                                <div class="input-group">
                                                    <span class="input-group-addon">Rs.</span>
                                                    {!! Form::text('Price', null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Quote Price here',
                                                        'id' => 'price',
                                                    ]) !!}
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Message For
                                                        Admin</label>
                                                    {!! Form::textarea('Reply', null, ['class' => 'form-control', 'placeholder' => 'Enter Message For Admin here']) !!}
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"
                                                        style="text-align: center;"> UPLOAD FILES<span
                                                            class="mandatory"></span></label>
                                                    <label for="txtarea1" class="col-sm-12 control-label">OPTION: A
                                                        <span class="mandatory"></span></label>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control', 'multiple']) !!}
                                                        </div>

                                                    </div>

                                                    <label for="txtarea1" class="col-sm-12 control-label">OPTION: B
                                                        <span class="mandatory"></span></label>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control', 'multiple']) !!}
                                                        </div>

                                                    </div>
                                                    <label for="txtarea1" class="col-sm-12 control-label">OPTION: C
                                                        <span class="mandatory"></span></label>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            {!! Form::file('Filec[]', $attributes = ['class' => 'form-control', 'multiple']) !!}
                                                        </div>


                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>

                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->

                                        <!-- Date and time range -->
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-block btn-primary">Send
                                                Quote</button>
                                        </div>
                                        <!-- /.form group -->

                                    </div>

                                    <!-- /.box-body -->
                                </div>
                                {!! Form::close() !!}
                            @elseif($DigiOrders->Status == 2 || $DigiOrders->Status == 3 || $DigiOrders->Status == 4)
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Quote Status </h3>
                                        </div>
                                        <div class="box-body">
                                            <h3>Quote Sent to Admin</h3>
                                        </div>
                                    </div>
                                </div>
                            @elseif($DigiOrders->Status == 5)
                                {!! Form::open(['url' => 'designer/digi/completed/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Send Design to Admin</h3>
                                        </div>

                                        <div class="box-body">
                                            <!-- Date -->
                                            @include('designer/includes/front_alerts')
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Message For
                                                        Admin</label>
                                                    {!! Form::textarea('DesignerMessage', null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Message For Admin here',
                                                    ]) !!}
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> UPLOAD
                                                        FILES<span class="mandatory"></span></label>
                                                    <label for="txtarea1" class="col-sm-12 control-label">OPTION: A
                                                        <span class="mandatory"></span></label>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div class="col-md-6">
                                                            {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                                        </div>



                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>


                                            <br>
                                            <label for="txtarea1" class="col-sm-12 control-label">OPTION: B <span
                                                    class="mandatory"></span></label>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-md-6">
                                                    {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>


                                            </div>


                                            <br>
                                            <label for="txtarea1" class="col-sm-12 control-label">OPTION: C <span
                                                    class="mandatory"></span></label>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-md-6">
                                                    {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                                </div>


                                            </div>


                                        </div>
                                        <!-- /.col-->
                                    </div>





                                    <!-- /.input group -->

                                    <!-- /.form group -->

                                    <!-- Date and time range -->
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-block btn-primary">Send Design to
                                            Admin</button>
                                    </div>
                                    <!-- /.form group -->

                                </div>

                                <!-- /.box-body      || $DigiOrders->Status == 7 || $DigiOrders->OrderType == 1 && $DigiOrders->Status == 6 -->
                    </div>
                    {!! Form::close() !!}
                @elseif($DigiOrders->Status == 6)
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Order Status </h3>
                            </div>
                            <div class="box-body">
                                <h3>Design Sent to Admin</h3>
                            </div>
                        </div>
                    </div>
                @elseif($DigiOrders->Status == 8)
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Order Status </h3>
                            </div>
                            <div class="box-body">
                                <h3>Order Done</h3>
                            </div>
                        </div>
                    </div>
                @elseif($DigiOrders->Status == 9)
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Order Status </h3>
                            </div>
                            <div class="box-body">
                                <h3>Order Cancelled</h3>
                            </div>
                        </div>
                    </div>
                @elseif($DigiOrders->Status == 10)
                    {!! Form::open(['url' => 'designer/digi/completed/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Send Revised Design to Admin</h3>
                            </div>

                            <div class="box-body">
                                <!-- Date -->
                                @include('designer/includes/front_alerts')
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="txtarea1" class="col-sm-12 control-label"> Message For
                                            Admin</label>
                                        {!! Form::textarea('DesignerMessage', null, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Message For Admin here',
                                        ]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="txtarea1" class="col-sm-12 control-label"> UPLOAD FILES<span
                                                class="mandatory"></span></label>
                                        <label for="txtarea1" class="col-sm-12 control-label">OPTION: A <span
                                                class="mandatory"></span></label>

                                        <div class="row">

                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="col-md-6">
                                                {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                            </div>



                                        </div>

                                    </div>
                                    <!-- /.col-->
                                </div>


                                <br>
                                <label for="txtarea1" class="col-sm-12 control-label">OPTION: B <span
                                        class="mandatory"></span></label>

                                <div class="row">

                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>



                                </div>



                                <br>
                                <label for="txtarea1" class="col-sm-12 control-label">OPTION: C <span
                                        class="mandatory"></span></label>

                                <div class="row">

                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>



                                </div>

                            </div>
                            <!-- /.col-->


                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- Date and time range -->
                        <div class="form-group">

                            <button type="submit" class="btn btn-block btn-primary">Send Design to Admin</button>
                        </div>
                        <!-- /.form group -->

                    </div>

                    <!-- /.box-body -->
            </div>
            {!! Form::close() !!}
            @endif
        @elseif($DigiOrders->OrderType == 1 && $DigiOrders->Status == 10)
            {!! Form::open(['url' => 'designer/digi/completed/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Send Revised Design to Admin</h3>
                    </div>

                    <div class="box-body">
                        <!-- Date -->
                        @include('designer/includes/front_alerts')
                        <div class="form-group">
                            <div class="form-group">
                                <label for="txtarea1" class="col-sm-12 control-label"> Message For Admin</label>
                                {!! Form::textarea('DesignerMessage', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Message For Admin here',
                                ]) !!}
                            </div>

                            <div class="form-group">
                                <label for="txtarea1" class="col-sm-12 control-label"> UPLOAD FILES<span
                                        class="mandatory"></span></label>
                                <label for="txtarea1" class="col-sm-12 control-label">OPTION: A <span
                                        class="mandatory"></span></label>
                                <div class="row">

                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control']) !!}
                                    </div>


                                </div>

                            </div>
                            <!-- /.col-->
                        </div>


                        <br>
                        <label for="txtarea1" class="col-sm-12 control-label">OPTION B <span
                                class="mandatory"></span></label>

                        <div class="row">

                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control']) !!}
                            </div>


                        </div>


                        <br>
                        <label for="txtarea1" class="col-sm-12 control-label">OPTION: C <span
                                class="mandatory"></span></label>
                        <div class="row">

                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::file('Filec[]', $attributes = ['class' => 'form-control']) !!}
                            </div>


                        </div>






                    </div>
                    <!-- /.col-->



                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Date and time range -->
                <div class="form-group">

                    <button type="submit" class="btn btn-block btn-primary">Send Design to Admin</button>
                </div>
                <!-- /.form group -->

            </div>

            <!-- /.box-body -->
        </div>
        {!! Form::close() !!}
        @endif
        @if ($DigiOrders->OrderType == 4 && $DigiOrders->Status == 10)
            {!! Form::open(['url' => 'designer/digi/price/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Revise Quote Price </h3>
                        @include('admin/includes/front_alerts')
                    </div>

                    <div class="box-body">
                        <!-- Date -->
                        <div class="form-group">


                            <div class="input-group">
                                <span class="input-group-addon">Rs.</span>
                                {!! Form::text('Price', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Quote Price here',
                                    'id' => 'price',
                                ]) !!}
                                <span class="input-group-addon">.00</span>
                            </div>
                            <div class="form-group">
                                <label for="txtarea1" class="col-sm-12 control-label">Instruction For Admin</label>
                                {!! Form::textarea('Reply', null, ['class' => 'form-control', 'placeholder' => 'Enter Message For Admin here']) !!}
                            </div>

                            <div class="form-group">
                                <label for="txtarea1" class="col-sm-12 control-label" style="text-align: center;">
                                    UPLOAD FILES<span class="mandatory"></span></label>
                                <label for="txtarea1" class="col-sm-12 control-label">OPTION: A <span
                                        class="mandatory"></span></label>
                                <div class="row">

                                    <div class="col-md-6">
                                        {!! Form::file('Filea[]', $attributes = ['class' => 'form-control', 'multiple']) !!}
                                    </div>


                                </div>

                                <label for="txtarea1" class="col-sm-12 control-label">OPTION: B <span
                                        class="mandatory"></span></label>

                                <div class="row">

                                    <div class="col-md-6">
                                        {!! Form::file('Fileb[]', $attributes = ['class' => 'form-control', 'multiple']) !!}
                                    </div>


                                </div>
                                <label for="txtarea1" class="col-sm-12 control-label">OPTION: C <span
                                        class="mandatory"></span></label>

                                <div class="row">

                                    <div class="col-md-6">
                                        {!! Form::file('Filec[]', $attributes = ['class' => 'form-control', 'multiple']) !!}
                                    </div>


                                </div>

                            </div>
                            <!-- /.col-->
                        </div>

                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- Date and time range -->
                    <div class="form-group">

                        <button type="submit" class="btn btn-block btn-primary">Send Quote</button>
                    </div>
                    <!-- /.form group -->

                </div>

                <!-- /.box-body -->
            </div>
            {!! Form::close() !!}
        @endif







        </section>
        <!-- /.content -->


        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ASSIGN</h4>
                    </div>
                    <div class="modal-body">
                        <p>DONE</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>



        <!-- /.content -->
    </div>
    </div>
    <!-- /.content-wrapper -->
    @include('admin/includes/footer')

    </div>
    <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!--<script src="{{ asset('assets/admin/plugins/chartjs/Chart.min.js') }}"></script>-->
    <script src="{{ asset('assets/admin/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/Chart.min.js') }}"></script>
    <script></script>
</body>

</html>
