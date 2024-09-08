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
    <title>{{ $configuration->WebsiteTitle }} | {{ $type }} Details</title>
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

        .m-l-250 {
            max-height: 250px;
            overflow-y: auto;
        }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        @include('admin/includes/header')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container">

                {!! Form::open(['url' => 'admin/order/ddelete', 'id' => 'frm_list']) !!}

                <section class="content">
                    <?= $DigiOrders->Status == 5 || $DigiOrders->AssignStatus == 1 ? '<div class="alert alert-success">Design Assigned to <a href="' . url('admin/designers/details/' . $DigiOrders->DesignerID) . '">' . $DigiOrders->DesignerName . ' </a></div>' : ($DigiOrders->Status == 3 ? '<div class="alert alert-warning">Message Sent to Customer</div>' : '') ?>


                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-default">
                            <div class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center;">
                                <!-- Date aligned to the left -->
                                <div style="display: inline-block;">
                                    <label style="margin-right: 5px;">Upload On:</label>
                                    <p style="display: inline; margin: 0;"><?php echo date('d-m-Y', strtotime($DigiOrders->DateAdded)); ?></p>
                                </div>
                                <!-- Heading aligned to the center -->
                                <h3 style="margin: 0; text-align: center; flex-grow: 1;">Digitizing {{ $type }} Detail</h3>
                        
                                <!-- Tools aligned to the right -->
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-sm btn-default" onclick="location.href='{{ url('/admin/edit-order/'.$DigiOrders->OrderID) }}'">Edit {{ $type }}</button>
                                    <!-- 
                                    <button type="button" class="btn btn-sm btn-default" value="Print" onclick="window.print()">Print {{ $type }}</button>  
                                    -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-default">Delete {{ $type }}</button>
                                </div>
                            </div>
                        
                        {!! FORM::close() !!}
                        <!-- /.box-header -->




                        <div class="box-body" style="font-size: 18px">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header with-border">
                                            <!-- <h3 class="box-title">Bordered Table</h3> -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table class="table table-bordered">

                                                <tr>

                                                    <td><label>{{$type}} #</label></td>
                                                    <td>
                                                        {{ App\Http\Helper::getPrefix('digitizing', $DigiOrders->OrderType) .'-'. $DigiOrders->OrderID }}
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td><label>PO Number</label></td>
                                                    <td>
                                                        {{ $DigiOrders->PONumber }}
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td><label>Design Name</label></td>
                                                    <td>
                                                        {{ $DigiOrders->DesignName }}
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td> <label>Width </label> </td>
                                                    <td>
                                                        {{ $DigiOrders->Width . ' ' . $DigiOrders->Scale }}
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td> <label>Height </label> </td>
                                                    <td>
                                                        {{ $DigiOrders->Height . ' ' . $DigiOrders->Scale }}
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td> <label>Fabric </label></td>
                                                    <td>
                                                        {{ $DigiOrders->Fabric }}
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td><label>Fabric Color</label></td>
                                                    <td>
                                                        {{ $DigiOrders->FabricColor }}
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td><label>No. of Colors </label></td>
                                                    <td>
                                                        {{ $DigiOrders->NoOfColors }}
                                                    </td>

                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix">

                                        </div>
                                    </div>
                                    <!-- /.box -->


                                    <!-- /.box -->
                                </div>



                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header with-border">
                                            <!-- <h3 class="box-title">Bordered Table</h3> -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table class="table table-bordered">



                                                <tr>
                                                    <td><label>Requried Format</label></td>
                                                    <td>
                                                        {{ $DigiOrders->ReqFormat }}
                                                    </td>

                                                </tr>
                                                <tr>

                                                    <td><label>Other Format</label></td>
                                                    <td>
                                                        {{ $DigiOrders->OtherFormat }}
                                                    </td>

                                                </tr>

                                                <tr>


                                                    <td><label>Color Blending</label></td>
                                                    <td>
                                                        {{ $DigiOrders->ColorBlending }}
                                                    </td>

                                                </tr>

                                                <tr>


                                                    <td><label>Background Fill </label></td>
                                                    <td>
                                                        {{ $DigiOrders->BackgroundFill }}
                                                    </td>

                                                </tr>

                                                <tr>


                                                    <td><label>Placement </label></td>
                                                    <td>
                                                        {{ $DigiOrders->Placement }}
                                                    </td>

                                                </tr>


                                                <tr>


                                                    <td><label>Picture Embroidery </label></td>
                                                    <td>
                                                        {{ $DigiOrders->PictureEmbroidery }}
                                                    </td>

                                                </tr>

                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer clearfix">

                                        </div>
                                    </div>
                                    <!-- /.box -->


                                    <!-- /.box -->
                                </div>
                            </div>


                            <div class="row">



                                <div class="col-md-6" style="font-size: 20px">
                                    <div class="form-group">
                                        <label>Current Status</label>
                                        <p><span style="font-size: 18px" class="label label-warning">
                                                {{ $OrderStatuses[$DigiOrders->Status] }}</span></p>


                                    </div>
                                </div>
                                <div class="col-md-6" style="font-size: 20px">
                                    <div class="form-group">
                                        <label>Order Type</label>
                                        <p><span style="font-size: 18px" class="label label-warning">
                                                {{ $OrderTypes[$DigiOrders->OrderType] }}</span></p>
                                    </div>
                                </div>






                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <p>{{ $DigiOrders->CsNote }} </p>
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
                    <div class="row" style="font-size: 18px">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!--<h3 class="box-title">Customer Price Plan</h3>-->
                                </div>
                                <div class="box-body m-l-250">

                                    <div class="form-group">
                                        <label>Price Plan:</label>
                                        <h4>{{ $DigiOrders->priceplane }} </h4>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    @include('admin/includes/front_alerts')

                    <div class="row" style="font-size: 18px">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title" style="text-align: "><strong>Additional Detail</strong></h3>
                                </div>

                                <div class="box-body">
                                    <!-- Date dd/mm/yyyy -->
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <div>
                                                    <h4>{{ $DigiOrders->CustomerName }} </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div><span class="label label-warning">
                                                        {{ $OrderStatuses[$DigiOrders->Status] }}</span></div>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Designer</label>
                                                <div><span class="text text-sm">
                                                        <h4>{{ $DigiOrders->DesignerName }}</h4>
                                                    </span></div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <!-- phone mask -->
                                        @if ($DigiOrders->OrderType == 4)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Quote Price</label>
                                                    <div>{{ $DigiOrders->CustomerPrice }} </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Additional Instructions</label>
                                                <div
                                                    style="inline-size: 100%;
                                                            overflow: hidden;
                                                            overflow-wrap: break-word !important">
                                                    {{ $DigiOrders->MoreInstructions }} </div>
                                            </div>
                                        </div>

                                        @if ($firstDesignerResponse != '')
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label style="color: blue">Designer Response</label>
                                                    <div style="color: red; font-size: 20px">
                                                        {{ $firstDesignerResponse }}</div>
                                                </div>
                                            </div>
                                        @endif



                                        @if (!empty($Revision))
                                            <div class="col-xs-12">
                                                <div class="box box-success">
                                                    <div class="box-header with-border" style="text-align: center;">
                                                        <h3 class="box-title"><strong>Client Revision
                                                                Instructions</strong></h3>

                                                    </div>
                                                    <div class="box-body table-responsive">
                                                        <table id="dataList"
                                                            class="display table table-bordered table-striped table-hover"
                                                            cellspacing="0">


                                                            <thead>
                                                                <tr>
                                                                    <th>Message</th>
                                                                    <th>Revision Files</th>
                                                                    <th>Date Time</th>

                                                                    <th></th>
                                                                </tr>
                                                            </thead>

                                                            @foreach ($Revision as $revise)
                                                                <tr class="">

                                                                    <td> {{ $revise['CustomerMessage'] }}</td>
                                                                    <td>
                                                                        @if ($revise['Files']->count() > 0)
                                                                            @foreach ($revise['Files'] as $rev_file)
                                                                                <a href="{{ asset('uploads/orders/digi_revision_customer') . '/' . $rev_file->file }}"
                                                                                    style="padding: 3px; margin: 3px"
                                                                                    class="btn btn-success btn-flat"
                                                                                    download=""><i
                                                                                        class="fa fa-download"></i>
                                                                                    {{ $rev_file->file }}</a>
                                                                            @endforeach
                                                                        @else
                                                                            <h4> <strong>No File</strong> </h4>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y h:i', strtotime($revise['DateAdded'])) }}
                                                                    </td>

                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                    <div class="box-footer"></div>
                                                </div>
                                            </div>


                                        @endif


                                        @if ($DigiOrders->Status == 8)
                                            <div class="col-md-12">
                                                <label>Final Price</label><br>
                                                <div style="font-size: 20px"><span class="label label-success">
                                                        {{ $DigiOrders->Price }}$</span></div>
                                            </div>
                                        @endif
                                        `
                                        @if ($DigiOrders->Status == 4 && !empty($DigiOrders->DesignerID))
                                            <div class="col-md-12">
                                                {!! Form::open(['url' => 'admin/digi-approve-designer/' . $DigiOrders->OrderID]) !!}
                                                <button class="btn btn-primary btn-block" type="submit">Approve to
                                                    Designer</button>
                                                {!! Form::close() !!}
                                            </div>
                                        @elseif($DigiOrders->Status == 2 || $DigiOrders->Status == 11)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Designer Message</label>
                                                    <div>{{ $DigiOrders->MessageForAdmin }} </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Designer Price</label>
                                                    <div>{{ $DigiOrders->DesignerPrice }} </div>
                                                </div>
                                            </div>
                                            {!! Form::open(['url' => 'admin/digi-send-quote/' . $DigiOrders->OrderID]) !!}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Files:</label>
                                                    <div>
                                                        <?php
                                              $counta = 0;
                                              $countb = 0;
                                              $countc = 0;
                                            foreach ($DesignFiles as $fls) {
                                                $extArr = explode('.', $fls->File);
                                                $ext = end($extArr);
                                            ?>

                                                        <div class="col-md-12">

                                                            <div class="form-group">

                                                                @if ($fls->Category == 'a')
                                                                    <?php if($counta < 1) { ?>
                                                                    <label>Files A</label><br>
                                                                    <?php } ?>
                                                                    <div class="col-md-6" style="margin-bottom:3px;">
                                                                        <input name="FileForCustomer[]"
                                                                            value="{{ $fls->DR_File_ID }}" checked
                                                                            type="checkbox"> &nbsp;
                                                                        <a href="{{ asset('uploads/orders/digi') . '/' . $fls->File }}"
                                                                            class="btn btn-success btn-flat"
                                                                            download=""><i
                                                                                class="fa fa-download"></i>
                                                                            {{ $fls->File }}</a>
                                                                    </div>
                                                                    <?php $counta++; ?>
                                                                @endif



                                                                @if ($fls->Category == 'b')
                                                                    <?php if($countb < 1) { ?>
                                                                    <label>Files B</label><br>
                                                                    <?php } ?>
                                                                    <div class="col-md-6" style="margin-bottom:3px;">
                                                                        <input name="FileForCustomer[]"
                                                                            value="{{ $fls->DR_File_ID }}" checked
                                                                            type="checkbox"> &nbsp;
                                                                        <a href="{{ asset('uploads/orders/digi') . '/' . $fls->File }}"
                                                                            class="btn btn-success btn-flat"
                                                                            download=""><i
                                                                                class="fa fa-download"></i>
                                                                            {{ $fls->File }}</a>
                                                                    </div>

                                                                    <?php $countb++; ?>
                                                                @endif

                                                                @if ($fls->Category == 'c')
                                                                    <?php if($countc < 1) { ?>
                                                                    <label>Files C</label><br>
                                                                    <?php } ?>

                                                                    <div class="col-md-6" style="margin-bottom:3px;">
                                                                        <input name="FileForCustomer[]"
                                                                            value="{{ $fls->DR_File_ID }}" checked
                                                                            type="checkbox"> &nbsp;
                                                                        <a href="{{ asset('uploads/orders/digi') . '/' . $fls->File }}"
                                                                            class="btn btn-success btn-flat"
                                                                            download=""><i
                                                                                class="fa fa-download"></i>
                                                                            {{ $fls->File }}</a>
                                                                    </div>
                                                                    <?php $countc++; ?>
                                                                    <div class="clearfix"></div>
                                                                @endif

                                                            </div>
                                                        </div>


                                                        <?php
                                            }
                                            ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-5">

                                                <label>Price $</label>
                                                <input type="number" placeholder="Enter Quote" class="form-control"
                                                    name="CustomerPrice"><br>
                                                <label>Timeline</label>
                                                <input type="text" placeholder="Enter Timeline"
                                                    class="form-control" name="Timeline"><br>

                                                <button class="btn btn-info btn-block" type="submit">Send Quote to
                                                    Customer</button>
                                                {!! Form::close() !!}
                                            </div>
                                        @elseif($DigiOrders->Status == 6)
                                            {!! Form::open([
                                                'url' => 'admin/digi-send-order/' . $DigiOrders->OrderID,
                                                'files' => 'true',
                                                'id' => 'sndorder',
                                            ]) !!}


                                            <?php
                                              $counta = 0;
                                              $countb = 0;
                                              $countc = 0;
                                            foreach ($DesignFiles as $fls) {
                                                $extArr = explode('.', $fls->File);
                                                $ext = end($extArr);
                                            ?>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    @if ($fls->Category == 'a')
                                                        <?php if($counta < 1) { ?>
                                                        <label>Files A</label><br>
                                                        <?php } ?>
                                                        <div class="col-md-6" style="margin-bottom:6px;">
                                                            <input name="FileForCustomer[]"
                                                                value="{{ $fls->DR_File_ID }}" checked
                                                                type="checkbox"> &nbsp;
                                                            <a href="{{ asset('uploads/orders/digi') . '/' . $fls->File }}"
                                                                class="btn btn-success btn-flat" download=""><i
                                                                    class="fa fa-download"></i>
                                                                {{ $fls->File }}</a>
                                                        </div>
                                                        <?php $counta++; ?>
                                                    @endif



                                                    @if ($fls->Category == 'b')
                                                        <?php if($countb < 1) { ?>
                                                        <label>Files B</label><br>
                                                        <?php } ?>
                                                        <div class="col-md-6" style="margin-bottom:6px;">
                                                            <input name="FileForCustomer[]"
                                                                value="{{ $fls->DR_File_ID }}" checked
                                                                type="checkbox"> &nbsp;
                                                            <a href="{{ asset('uploads/orders/digi') . '/' . $fls->File }}"
                                                                class="btn btn-success btn-flat" download=""><i
                                                                    class="fa fa-download"></i>
                                                                {{ $fls->File }}</a>
                                                        </div>

                                                        <?php $countb++; ?>
                                                    @endif

                                                    @if ($fls->Category == 'c')
                                                        <?php if($countc < 1) { ?>
                                                        <label>Files C</label><br>
                                                        <?php } ?>

                                                        <div class="col-md-6" style="margin-bottom:6px;">
                                                            <input name="FileForCustomer[]"
                                                                value="{{ $fls->DR_File_ID }}" checked
                                                                type="checkbox"> &nbsp;
                                                            <a href="{{ asset('uploads/orders/digi') . '/' . $fls->File }}"
                                                                class="btn btn-success btn-flat" download=""><i
                                                                    class="fa fa-download"></i>
                                                                {{ $fls->File }}</a>
                                                        </div>
                                                        <?php $countc++; ?>
                                                        <div class="clearfix"></div>
                                                    @endif

                                                </div>
                                            </div>


                                            <?php
                                            }
                                            ?>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Send Instruction to Customer</label>
                                                    <textarea placeholder="Enter Instruction For Customer" class="form-control" name="MessageForCustomer"
                                                        rows="5"></textarea>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $qtyfordefault = '';
                                                            if ($DigiOrders->OrderType != 1 && $DigiOrders->OrderType != 4 && $DigiOrders->OrderType != 9) {
                                                                $qtyfordefault = 1;
                                                            } ?>
                                                            <label>Quantity:</label>
                                                            <input type="number" placeholder="Enter Quantity"
                                                                value="{{ $qtyfordefault }}" class="form-control"
                                                                name="qty" oninput="setPricebyQty(this);"
                                                                id="qty" <?php if ($DigiOrders->OrderType != 1 && $DigiOrders->OrderType != 9) {
                                                                    echo 'required';
                                                                } ?>>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Price $</label>
                                                            <input type="text" placeholder="Enter Price"
                                                                oninput="set_final(this);" id="price"
                                                                class="form-control" name="OrderPrice"
                                                                <?php if ($DigiOrders->OrderType == 0) {
                                                                    echo 'required';
                                                                } ?>><br>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Discount $</label>
                                                            <input type="text" placeholder="Enter Discount"
                                                                id="disc" oninput="cal_price(this);"
                                                                class="form-control" name="Discount"><br>
                                                        </div>
                                                    </div>

                                                    <label style="color: blue;">Total $</label><br>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="text" id="actfinalprice"
                                                                class="form-control" name="myText"
                                                                style="display:none" disabled>
                                                            <input type="hidden" id="fnlprice" name="finalprice">
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <h4 class="box-title" style="text-align: "><strong>Staff
                                                        Account:</strong></h4>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php  

                                                    if($DigiOrders->SalesPersonID > 0)
                                                    {
                                                     ?>
                                                        <div class="col-md-5">
                                                            <label>Sales Rep Commission:</label>
                                                            <input type="text" placeholder="Enter Price"
                                                                class="form-control" name="salesorp">
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-5">
                                                        <label>Designer Price:</label>
                                                        <input type="text" placeholder="Enter Price"
                                                            class="form-control" name="designorp">
                                                    </div>
                                                </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="Filesattach" rows="2"><b>CC This order to
                                                        </b></label>
                                                    <input type="email" name="CCOrder" value=""
                                                        placeholder="CC This order to" class="form-control">
                                                </div>
                                            </div>
                                    </div>
                                </div>


                                <div class="col-md-5">
                                    <button class="btn btn-primary btn-block" id="releaseSubmit"
                                        type="submit">Release Order</button>
                                </div>


                                {!! Form::close() !!}
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


                        <div class="box-body">

                                        <div class='row'>
                                            @if($DigiOrders->File1 != "")
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork 1</label>
                                                   
                                                     <?php
                                               if ($DigiOrders->File1 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File1);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $DigiOrders->File1 }}" href="{{  asset('uploads/orders/digi/'.$DigiOrders->File1) }}"><img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File1) }}" width="80" height="60" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a href="{{asset('uploads/orders/digi').'/'.$DigiOrders->File1}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->File1 }}</a>
                                         
                                                        <?php  } }  ?>   
                                                  
                                                </div>
                                            </div>
                                            @endif
                                             @if($DigiOrders->File2 != "")
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork 2</label>
                                                    
                                                     <?php
                                          
                                                 
                                               if ($DigiOrders->File2 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File2);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $DigiOrders->File2 }}" href="{{  asset('uploads/orders/digi/'.$DigiOrders->File2) }}"><img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File2) }}" width="80" height="60" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a href="{{asset('uploads/orders/digi').'/'.$DigiOrders->File2}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->File2 }}</a>
                                         
                                                        <?php  } }  ?> 
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <hr style="border-color:#000;">
                                        <div class="row">
                                             @if($DigiOrders->File3 != "")
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork 3</label>
                                                  
                                                     <?php
                                          
                                                 
                                               if ($DigiOrders->File3 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File3);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $DigiOrders->File3 }}" href="{{  asset('uploads/orders/digi/'.$DigiOrders->File3) }}"><img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File3) }}" width="80" height="60" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a href="{{asset('uploads/orders/digi').'/'.$DigiOrders->File3}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->File3 }}</a>
                                         
                                                        <?php  } }  ?>  
                                                </div>
                                            </div>
                                            @endif
                                             @if($DigiOrders->File4 != "")
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork 4</label>
                                                 
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
                                            @endif
                                        </div>

                        </div>

                        <!-- /.box -->

                    </div>
            </div>


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
                                            <label>Order Files:</label><br>


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
                                                            class="btn btn-success btn-flat" download=""><i
                                                                class="fa fa-download"></i> {{ $mfile->File }}</a>
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
                                                            class="btn btn-success btn-flat" download=""><i
                                                                class="fa fa-download"></i> {{ $mfile->File }}</a>
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
                                                                class="fa fa-download"></i> {{ $mfile->File }}</a>
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
                                                        class="fa fa-download"></i> {{ $mfile->File }}</a>
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

                                    <h4><strong>Revision {{ $RevCount }}</strong></h4><br>
                                    <?php } ?>
                                    <label>Designer Message</label>
                                    <p><?= $history['DesignerMessage'] ?><small
                                            class="pull-right">{{ $history['DateAdded'] }}</small><br>
                                        <label>Order Files:</label><br>


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
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $mfile->File }}</a>
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
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $mfile->File }}</a>
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
                                                            class="fa fa-download"></i> {{ $mfile->File }}</a>
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
                                                    class="fa fa-download"></i> {{ $mfile->File }}</a>
                                        </div>
                                    @endif

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


            <!-- /.col (left) -->
            @if ($DigiOrders->OrderType == 0 || $DigiOrders->OrderType == 2 || $DigiOrders->OrderType == 3)
                @if ($DigiOrders->Status != 8)
                    @if ($DigiOrders->Status != 7)
                        @if ($DigiOrders->Status != 4)
                            @if ($DigiOrders->Status != 6)
                                {!! Form::open(['url' => 'admin/digi-assign-designer/' . $DigiOrders->OrderID]) !!}
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title"><strong>Assigment</strong></h3>

                                        </div>
                                        <div class="box-body">
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Designer:</label>


                                                {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}

                                                <!-- /.input group -->
                                            </div>

                                            <div class="form-group">
                                                <label>Instruction For Designer:</label>
                                                {!! Form::textarea('MessageForDesigner', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter your Instruction here',
                                                ]) !!}
                                            </div>
                                            <!-- /.col-->
                                        </div>

                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- Date and time range -->
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-block btn-primary">ASSIGN</button>
                                    </div>
                                    <!-- /.form group -->

                                </div>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['url' => 'admin/digi_order_revision/' . $DigiOrders->OrderID]) !!}
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Revise Order</h3>

                                        </div>

                                        <div class="box-body">
                                            <!-- Date -->

                                            <div class="form-group">
                                                <label>Current Designer:</label>
                                                <div><span class="text"> {{ $DigiOrders->DesignerName }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Designer:</label>
                                                {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group">
                                                <label>Instruction For Designer:</label>
                                                {!! Form::textarea('MessageForDesigner', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter your message here',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-warning">ASSIGN</button>
                                    </div>
                                    <!-- /.form group -->

                                </div>
                                {!! Form::close() !!}
                            @endif
                        @else
                            @if (!empty($DigiOrders->DesignerID))
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title"><strong>Assigment For Complete Order</strong></h3>
                                        </div>
                                        <div class="box-body">
                                            <h2>Assigned to <a
                                                    href="{{ url('admin/designers/details/' . $DigiOrders->DesignerID) }}">{{ $DigiOrders->DesignerName }}</a>
                                            </h2>
                                            {!! Form::open(['url' => 'admin/digi-assign-designer/' . $DigiOrders->OrderID]) !!}
                                            <div class="form-group">
                                                <label>Designer:</label>
                                                {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group">
                                                <label>Instruction For Designer:</label>
                                                {!! Form::textarea('MessageForDesigner', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter your Instruction here',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-primary">APPROVE TO
                                                    DESIGNER</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            @else
                                {!! Form::open(['url' => 'admin/digi-assign-designer/' . $DigiOrders->OrderID]) !!}
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title"><strong>Assigment </strong></h3>

                                        </div>
                                        <div class="box-body">
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Designer:</label>
                                                {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group">
                                                <label>Instruction For Designer:</label>
                                                {!! Form::textarea('MessageForDesigner', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter your Instruction here',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary">ASSIGN</button>
                                    </div>
                                    <!-- /.form group -->

                                </div>
                                {!! Form::close() !!}
                            @endif
                        @endif
                    @else
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Status </h3>
                                </div>
                                <div class="box-body">
                                    <h2>Order Sent To Customer</h2>

                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Status </h3>
                            </div>
                            <div class="box-body">
                                <h2>Order Completed By <a
                                        href="{{ url('admin/designers/details/' . $DigiOrders->DesignerID) }}">{{ $DigiOrders->DesignerName }}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endif
            @elseif($DigiOrders->OrderType == 1 && $DigiOrders->Status != 6 && $DigiOrders->Status != 10 && $DigiOrders->Status != 7)
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Status </h3>
                        </div>
                        <div class="box-body">
                            <h2>Order Sent for Revision</h2>
                        </div>
                    </div>
                </div>
            @elseif($DigiOrders->Status == 7)
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Status </h3>
                        </div>
                        <div class="box-body">
                            <h2>Order Sent To Customer</h2>

                        </div>
                    </div>
                </div>
            @elseif($DigiOrders->Status == 10)
                @if ($DigiOrders->OrderType == 1 || $DigiOrders->OrderType == 9)
                    {!! Form::open(['url' => 'admin/digi_order_revision/' . $DigiOrders->OrderID]) !!}
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Revise {{ $type }}</h3>

                            </div>


                            <div class="box-body">
                                <!-- Date -->

                                <div class="form-group">
                                    <label>Current Designer:</label>
                                    <div><span class="text"> {{ $DigiOrders->DesignerName }}</span></div>


                                </div>
                                <div class="form-group">
                                    <label>Designer:</label>
                                    {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    <label>Instruction For Designer:</label>
                                    {!! Form::textarea('MessageForDesigner', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter your Instruction here',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-warning">ASSIGN</button>
                        </div>
                        <!-- /.form group -->

                    </div>
                    {!! Form::close() !!}




                    <!--         OLD WORK DIRECT ASSIGN TO EXITS DESIGNER

                            {!! Form::open(['url' => 'admin/digi_order_revision/' . $DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revise Order </h3>
                                    </div>
                                    <div class="box-body">
                                      
                                        <div class="form-group">
                                            <label>Message For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, [
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter your message here',
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-warning">Revise</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}


 -->
                @elseif(($DigiOrders->OrderType == 4 && $DigiOrders->Status == 10) || $DigiOrders->Status == 11 || $DigiOrders->Status != 6)
                    {!! Form::open(['url' => 'admin/digi-assign-designer-rev/' . $DigiOrders->OrderID]) !!}
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><strong>Assigment For Revision</strong></h3>

                            </div>
                            <div class="box-body">
                                <!-- Date -->
                                <div class="form-group">
                                    <label>Designer:</label>
                                    {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    <label>Instruction For Designer:</label>
                                    {!! Form::textarea('MessageForDesigner', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter your Instruction here',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">ASSIGN</button>
                        </div>
                        <!-- /.form group -->

                    </div>
                    {!! Form::close() !!}
                @endif
            @endif
            <!-- /.box-body -->




            @if ($DigiOrders->OrderType == 4 && $DigiOrders->Status == 6)
                {!! Form::open(['url' => 'admin/digi_order_revision/' . $DigiOrders->OrderID]) !!}
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Revise {{ $type }}</h3>

                        </div>
                        <div class="box-body">
                            <!-- Date -->
                            <div class="form-group">
                                <label>Designer:</label>
                                {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label>Instruction For Designer:</label>
                                {!! Form::textarea('MessageForDesigner', null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter your Instruction here',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-warning">ASSIGN</button>
                    </div>
                    <!-- /.form group -->

                </div>
                {!! Form::close() !!}
            @endif








        </div>
        <!-- /.box -->




        <!-- iCheck -->

        <!-- /.row -->

        </section>
        <!-- /.content -->


        <div class="modal fade" id="modal-default">
            {!! Form::open(['url' => '/admin/ddelete/' . $DigiOrders->OrderID]) !!}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete {{ $type }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you Want to Delete this {{ $type }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-danger">Delete {{ $type }}</button>
                    </div>
                    {!! Form::close() !!}
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
    <script>
        function cal_price(text) {

            var price = '';
            var discount = '';
            var price = document.getElementById('price').value;
            var discount = document.getElementById('disc').value;
            var qty = document.getElementById('qty').value;
            var price = parseInt(price);
            var discount = parseInt(discount);

            if (price == '') {
                alert('Please Enter Price First!!');
            }

            // alert(price+' P yaha D '+discount);

            if (qty > 0) {
                price = price * qty;
            }


            if (price != '' || discount != '') {

                if (discount >= price) {

                    // alert('Discount Bara Ha Price say'); 

                    document.getElementById("sndorder").reset();
                    alert('Discount Price Not Bigger than actual price amount please check');
                } else if (discount < price) {
                    var actualprice = price - discount;
                    document.getElementById("fnlprice").value = actualprice;
                    document.getElementById("actfinalprice").value = actualprice;
                    document.getElementById("actfinalprice").style.display = 'block';


                } else if (price != '' && discount == '') {
                    document.getElementById("fnlprice").value = price;
                    document.getElementById("actfinalprice").style.display = 'block';
                }
            } else {
                alert('Check Prices Please');
            }


        }

        function setPricebyQty(text) {
            var vp = document.getElementById('price').value;
            var qty = document.getElementById('qty').value;
            var d = document.getElementById('disc').value;
            if (vp === '') {

            } else {
                finalprice = vp * qty;
                if (d !== '') {
                    finalprice = finalprice - d;
                }
                document.getElementById("actfinalprice").value = finalprice;
                document.getElementById("actfinalprice").style.display = 'block';

            }
        }

        function set_final(text) {
            var p = document.getElementById('price').value;
            var d = document.getElementById('disc').value;
            var qty = document.getElementById('qty').value;
            var Price = 0;
            d = parseInt(d);

            if (qty > 0) {
                p = parseInt(p);
                qty = parseInt(qty);
                Price = p * qty;
            }
            if (d > 0) {
                // alert('GALAT H AYA');
                Price = Price - d;
            }

            //  alert('Its Answer of Price: ' + Price);
            document.getElementById("actfinalprice").value = Price;
            document.getElementById("actfinalprice").style.display = 'block';


        }

        $(document).ready(function() {
            $("#sndorder").submit(function() {
                $("#releaseSubmit").attr("disabled", true);
                return true;
            });
        });
    </script>



</body>

</html>
