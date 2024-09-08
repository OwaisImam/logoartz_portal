<?php
if (!empty($VectorOrders)) {
    if ($VectorOrders->OrderType == 2 || $VectorOrders->OrderType == 4) {
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
    <title>{{ $configuration->WebsiteTitle }} | Vector {{ $type }} Detail</title>
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
                <section class="content">
                    <?= $VectorOrders->Status == 5 || $VectorOrders->AssignStatus == 1 ? '<div class="alert alert-success">Design Assigned to <a href="' . url('admin/designers/details/' . $VectorOrders->DesignerID) . '">' . $VectorOrders->DesignerName . ' </a></div>' : ($VectorOrders->Status == 3 ? '<div class="alert alert-warning">Message Sent to Customer</div>' : '') ?>
                    <?php ?>
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="" style="text-align: center;">Vector {{ $type }} Detail</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-sm btn-default"
                                    onclick="location.href='{{ url('/admin/edit-order-vec/' . $VectorOrders->VectorOrderID) }}'">Edit
                                    {{ $type }}
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#modal-default">Delete {{ $type }}
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="font-size: 18px">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="box-header with-border">
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>
                                                        <label>Order #</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->VectorOrderID }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Design Name</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->DesignName }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>PO Number</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->PONumber }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Width </label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->Width . ' ' . $VectorOrders->Scale }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Height </label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->Height . ' ' . $VectorOrders->Scale }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Required Fromat</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->ReqFormat }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="box-header with-border">
                                            </div>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>
                                                        <label>REQ. COLOR</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->ReqColor }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>No. of Colors </label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->NoOfColors }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Other Format</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->OtherFormat }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Used For:</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->UsedFor }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Separation</label>
                                                    </td>
                                                    <td>
                                                        {{ $VectorOrders->ReqSeparation }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Upload On</label>
                                                    </td>
                                                    <td>
                                                        <?php echo date('d-m-Y', strtotime($VectorOrders->DateAdded)); ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="font-size: 20px">
                                    <div class="form-group">
                                        <label>Current Status</label>
                                        <p><span style="font-size: 18px" class="label label-warning">
                                                {{ $OrderStatuses[$VectorOrders->Status] }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <!-- /.box -->
                    <div class="row" style="font-size: 18px">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Cutomer Price Plan</h3>
                                </div>
                                <div class="box-body m-l-250">
                                    <div class="form-group">
                                        <label>Price Plan:</label>
                                        <h4>{{ $VectorOrders->priceplane }} </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="font-size: 18px">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title" style="text-align: ">Additional Detail</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date dd/mm/yyyy -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <div>
                                                    <h4>{{ $VectorOrders->CustomerName }} </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div><span class="label label-warning">
                                                        {{ $OrderStatuses[$VectorOrders->Status] }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Designer</label>
                                                <div><span class="text text-sm">
                                                        <h4> {{ $VectorOrders->DesignerName }}</h4>
                                                    </span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form group
                                 -->
                                    <!-- Date mm/dd/yyyy -->
                                    <div class="row">
                                        <!--             <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Designer PRICE</label>
                                    <div> <h4><span class="label label-success">${{ $VectorOrders->DesignerPrice }}</span> </h4></div>
                                    
                                    </div>
                                     </div>
                                     <div class="col-md-3">
                                     <div class="form-group pull-right">
                                    <label>Admin PRICE</label>
                                    <div> <h4><span class="label label-success">${{ $VectorOrders->CustomerPrice }}</span> </h4></div>
                                    
                                    </div>
                                    </div>-->
                                        <!-- /.form group -->
                                        <!-- phone mask -->
                                        @if ($VectorOrders->OrderType == 4)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Quote Price</label>
                                                    <div>{{ $VectorOrders->CustomerPrice }} </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Additional Instructions</label>
                                                <div>{{ $VectorOrders->MoreInstructions }} </div>
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
                                                                                <a href="{{ asset('uploads/orders/vector_revision_customer') . '/' . $rev_file->file }}"
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

                                            @endif @if ($VectorOrders->Status == 8)
                                                <div class="col-md-12">
                                                    <label>Final Price</label>
                                                    <br>
                                                    <div style="font-size: 20px"><span class="label label-success">
                                                            {{ $VectorOrders->Price }}$</span></div>
                                                </div>
                                                @endif @if ($VectorOrders->Status == 4 && !empty($VectorOrders->DesignerID))
                                                    <div class="col-md-12">
                                                        {!! Form::open(['url' => 'admin/vec-approve-designer/' . $VectorOrders->VectorOrderID]) !!}
                                                        <button class="btn btn-primary btn-block"
                                                            type="submit">Approve to Designer</button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                @elseif($VectorOrders->Status == 2 || $VectorOrders->Status == 11)
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Designer Message</label>
                                                            <div>{{ $VectorOrders->MessageForAdmin }} </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Designer Price</label>
                                                            <div>{{ $VectorOrders->DesignerPrice }} </div>
                                                        </div>
                                                    </div>
                                                    {!! Form::open(['url' => 'admin/vec-send-quote/' . $VectorOrders->VectorOrderID]) !!}
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
                                                                <label>Files A</label>
                                                                <br>
                                                                <?php } ?>
                                                                <div class="col-md-6" style="margin-bottom:6px;">
                                                                    <input name="FileForCustomer[]"
                                                                        value="{{ $fls->VR_File_ID }}" checked
                                                                        type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                                    <a href="{{ asset('uploads/orders/vector') . '/' . $fls->File }}"
                                                                        class="btn btn-success btn-flat" do
                                                                        wnload=""><i class="fa fa-download"></i>
                                                                        {{ $fls->File }}</a>
                                                                </div>
                                                                <?php $counta++; ?>
                                                                @endif @if ($fls->Category == 'b')
                                                                    <?php if($countb < 1) { ?>
                                                                    <label>Files B</label>
                                                                    <br>
                                                                    <?php } ?>
                                                                    <div class="col-md-6" style="margin-bottom:6px;">
                                                                        <input name="FileForCustomer[]"
                                                                            value="{{ $fls->VR_File_ID }}" checked
                                                                            type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                                        <a href="{{ asset('uploads/orders/vector') . '/' . $fls->File }}"
                                                                            class="btn btn-success btn-flat"
                                                                            download=""><i
                                                                                class="fa fa-download"></i>
                                                                            {{ $fls->File }}</a>
                                                                    </div>
                                                                    <?php $countb++; ?>
                                                                    @endif @if ($fls->Category == 'c')
                                                                        <?php if($countc < 1) { ?>
                                                                        <label>Files C</label>
                                                                        <br>
                                                                        <?php } ?>
                                                                        <div class="col-md-6"
                                                                            style="margin-bottom:6px;">
                                                                            <input name="FileForCustomer[]"
                                                                                value="{{ $fls->VR_File_ID }}" checked
                                                                                type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                                            <a href="{{ asset('uploads/orders/vector') . '/' . $fls->File }}"
                                                                                class="btn btn-success btn-flat"
                                                                                download=""><i
                                                                                    class="fa fa-download"></i>
                                                                                {{ $fls->File }}</a>
                                                                        </div>
                                                                        <?php $countc++; ?>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                    <?php
                                    }
                                    ?>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <label>Enter Your Price</label>
                                                        <input type="number" placeholder="Enter Quote"
                                                            class="form-control" name="CustomerPrice">
                                                        <br>
                                                        <label>Enter Timeline</label>
                                                        <input type="text" placeholder="Enter Timeline"
                                                            class="form-control" name="Timeline">
                                                        <br>
                                                        <button class="btn btn-info btn-block" type="submit">Send
                                                            Quote to Customer</button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                @elseif($VectorOrders->Status == 6)
                                                    {!! Form::open(['url' => 'admin/vec-send-order/' . $VectorOrders->VectorOrderID, 'id' => 'sndorder']) !!}
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
                                                                <label>Files A</label>
                                                                <br>
                                                                <?php } ?>
                                                                <div class="col-md-6" style="margin-bottom:6px;">
                                                                    <input name="FileForCustomer[]"
                                                                        value="{{ $fls->VR_File_ID }}" checked
                                                                        type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                                    <a href="{{ asset('uploads/orders/vector') . '/' . $fls->File }}"
                                                                        class="btn btn-success btn-flat" do
                                                                        wnload=""><i class="fa fa-download"></i>
                                                                        {{ $fls->File }}</a>
                                                                </div>
                                                                <?php $counta++; ?>
                                                                @endif @if ($fls->Category == 'b')
                                                                    <?php if($countb < 1) { ?>
                                                                    <label>Files B</label>
                                                                    <br>
                                                                    <?php } ?>
                                                                    <div class="col-md-6" style="margin-bottom:6px;">
                                                                        <input name="FileForCustomer[]"
                                                                            value="{{ $fls->VR_File_ID }}" checked
                                                                            type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                                        <a href="{{ asset('uploads/orders/vector') . '/' . $fls->File }}"
                                                                            class="btn btn-success btn-flat"
                                                                            download=""><i
                                                                                class="fa fa-download"></i>
                                                                            {{ $fls->File }}</a>
                                                                    </div>
                                                                    <?php $countb++; ?>
                                                                    @endif @if ($fls->Category == 'c')
                                                                        <?php if($countc < 1) { ?>
                                                                        <label>Files C</label>
                                                                        <br>
                                                                        <?php } ?>
                                                                        <div class="col-md-6"
                                                                            style="margin-bottom:6px;">
                                                                            <input name="FileForCustomer[]"
                                                                                value="{{ $fls->VR_File_ID }}" checked
                                                                                type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                                            <a href="{{ asset('uploads/orders/vector') . '/' . $fls->File }}"
                                                                                class="btn btn-success btn-flat"
                                                                                download=""><i
                                                                                    class="fa fa-download"></i>
                                                                                {{ $fls->File }}</a>
                                                                        </div>
                                                                        <?php $countc++; ?>
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
                                                                <div class="col-md-12">
                                                                    @include('admin/includes/front_alerts')
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <?php
                                                                    $qtyfordefault = '';
                                                                    if ($VectorOrders->OrderType != 1 && $VectorOrders->OrderType != 4 && $VectorOrders->OrderType != 9) {
                                                                        $qtyfordefault = 1;
                                                                    } ?>
                                                                    <label>Quantity:</label>
                                                                    <input type="number" placeholder="Enter Quantity"
                                                                        value="{{ $qtyfordefault }}"
                                                                        class="form-control" name="qty"
                                                                        oninput="setPricebyQty(this);" id="qty"
                                                                        <?php if ($VectorOrders->OrderType == 0) {
                                                                            echo 'required';
                                                                        } ?>>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <label>Price $</label>
                                                                    <input type="text" placeholder="Enter Price"
                                                                        oninput="set_final(this);" id="price"
                                                                        class="form-control" name="OrderPrice"
                                                                        <?php if ($VectorOrders->OrderType == 0) {
                                                                            echo 'required';
                                                                        } ?>>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <label>Discount $</label>
                                                                    <input type="text" placeholder="Enter Discount"
                                                                        id="disc" oninput="cal_price(this);"
                                                                        class="form-control" name="Discount">
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <label style="color: blue;">Total $</label>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <input type="text" id="actfinalprice"
                                                                        class="form-control" name="myText"
                                                                        style="display:none" disabled>
                                                                    <input type="hidden" id="fnlprice"
                                                                        name="finalprice">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h4 class="box-title" style="text-align: "><strong>Staff
                                                                Account:</strong></h4>
                                                        <div class="form-group">
                                                            <?php  
                                          if($VectorOrders->SalesPersonID > 0)
                                          {
                                           ?>
                                                            <label>Sales Rep Commission:</label>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <input type="text" placeholder="Enter Price"
                                                                        class="form-control" name="salesorp">
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                            <br>
                                                            <label>Designer Price:</label>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <input type="text" placeholder="Enter Price"
                                                                        class="form-control" name="designorp">
                                                                </div>
                                                            </div>
                                                            <br>
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
                                    <h3 class="box-title">Customer ART Work</h3>
                                </div>
                                <div class="box-body">
                                    <div class='row'>
                                        @if ($VectorOrders->File1 != '')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        1</label>
                                                    <?php
                                          if ($VectorOrders->File1 != "") {
                                          
                                           $File =  explode(".", $VectorOrders->File1);
                                           $ext = end($File);
                                            if (in_array($ext, $allowed_ext)) {
                                          
                                          ?>
                                                    <a download="{{ $VectorOrders->File1 }}"
                                                        href="{{ asset('uploads/orders/vector/' . $VectorOrders->File1) }}"><img
                                                            src="{{ asset('uploads/orders/vector/' . $VectorOrders->File1) }}"
                                                            width="100%" /></a>
                                                    <?php  }else{  ?>
                                                    <a style="margin-left: 10px; margin-top: 10px"
                                                        href="{{ asset('uploads/orders/vector') . '/' . $VectorOrders->File1 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $VectorOrders->File1 }}</a>
                                                    <?php  } }  ?>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($VectorOrders->File2 != '')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        2</label>
                                                    <?php
                                          if ($VectorOrders->File2 != "") {
                                          
                                           $File =  explode(".", $VectorOrders->File2);
                                           $ext = end($File);
                                            if (in_array($ext, $allowed_ext)) {
                                          
                                          ?>
                                                    <a download="{{ $VectorOrders->File2 }}"
                                                        href="{{ asset('uploads/orders/vector/' . $VectorOrders->File2) }}"><img
                                                            src="{{ asset('uploads/orders/vector/' . $VectorOrders->File2) }}"
                                                            width="100%" /></a>
                                                    <?php  }else{  ?>
                                                    <a style="margin-left: 10px; margin-top: 10px"
                                                        href="{{ asset('uploads/orders/vector') . '/' . $VectorOrders->File2 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $VectorOrders->File2 }}</a>
                                                    <?php  } }  ?>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <hr style="border-color:#000;">
                                    <div class="row">
                                        @if ($VectorOrders->File3 != '')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        3</label>
                                                    <?php
                                          if ($VectorOrders->File3 != "") {
                                          
                                           $File =  explode(".", $VectorOrders->File3);
                                           $ext = end($File);
                                            if (in_array($ext, $allowed_ext)) {
                                          
                                          ?>
                                                    <a download="{{ $VectorOrders->File3 }}"
                                                        href="{{ asset('uploads/orders/vector/' . $VectorOrders->File3) }}"><img
                                                            src="{{ asset('uploads/orders/vector/' . $VectorOrders->File3) }}"
                                                            width="100%" /></a>
                                                    <?php  }else{  ?>
                                                    <a style="margin-left: 10px; margin-top: 10px"
                                                        href="{{ asset('uploads/orders/vector') . '/' . $VectorOrders->File3 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $VectorOrders->File3 }}</a>
                                                    <?php  } }  ?>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($VectorOrders->File4 != '')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label">Artwork
                                                        4</label>
                                                    <?php
                                          if ($VectorOrders->File4 != "") {
                                          
                                           $File =  explode(".", $VectorOrders->File4);
                                           $ext = end($File);
                                            if (in_array($ext, $allowed_ext)) {
                                          
                                          ?>
                                                    <a download="{{ $VectorOrders->File4 }}"
                                                        href="{{ asset('uploads/orders/vector/' . $VectorOrders->File4) }}"><img
                                                            src="{{ asset('uploads/orders/vector/' . $VectorOrders->File4) }}"
                                                            width="100%" /></a>
                                                    <?php  }else{  ?>
                                                    <a style="margin-left: 10px; margin-top: 10px"
                                                        href="{{ asset('uploads/orders/vector') . '/' . $VectorOrders->File4 }}"
                                                        class="btn btn-success btn-flat" download=""><i
                                                            class="fa fa-download"></i> {{ $VectorOrders->File4 }}</a>
                                                    <?php  } }  ?>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
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
                                                                    <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
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
                                                                    <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
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
                                                                    <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
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
                                                            <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
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
                                        <h3 class="box-title">Revision History </h3>
                                    </div>
                                    <div class="box-body m-l-250">
                                        <?php $RevCount = 0;
                                        ?>
                                        @foreach ($revision_history as $history)
                                            <div class="form-group" style="margin-bottom: 20px">
                                                <?php  
                                    if($RevCount == 0){
                                    ?>
                                                <h4><strong>Order First Response</strong></h4>
                                                <br>
                                                <?php }else{ ?>
                                                <h4><strong>Revision {{ $RevCount }}</strong></h4>
                                                <br>
                                                <?php } ?>
                                                <label>Designer Massage</label>
                                                <p>
                                                    <?= $history['DesignerMessage'] ?><small
                                                        class="pull-right">{{ $history['DateAdded'] }}</small>
                                                    <br>
                                                    <label>{{ $type }} Files:</label>
                                                    <br>
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
                                                            <label>Files A</label>
                                                            <br>
                                                            <?php } ?>
                                                            <div class="col-md-6">
                                                                <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
                                                                    class="btn btn-success btn-flat" download=""><i
                                                                        class="fa fa-download"></i>
                                                                    {{ $mfile->File }}</a>
                                                            </div>
                                                            <?php $counta++; ?>
                                                        @endif
                                                        <div class="clearfix"></div>
                                                        @if ($mfile->Category == 'b')
                                                            <?php if($countb < 1) { ?>
                                                            <label>Files B</label>
                                                            <br>
                                                            <?php } ?>
                                                            <div class="col-md-6">
                                                                <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
                                                                    class="btn btn-success btn-flat" download=""><i
                                                                        class="fa fa-download"></i>
                                                                    {{ $mfile->File }}</a>
                                                            </div>
                                                            <?php $countb++; ?>
                                                        @endif
                                                        <div class="clearfix"></div>
                                                        @if ($mfile->Category == 'c')
                                                            <?php if($countc < 1) { ?>
                                                            <label>Files C</label>
                                                            <br>
                                                            <?php } ?>
                                                            <div class="col-md-6">
                                                                <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
                                                                    class="btn btn-success btn-flat" download=""><i
                                                                        class="fa fa-download"></i>
                                                                    {{ $mfile->File }}</a>
                                                            </div>
                                                            <?php $countc++; ?>
                                                        @endif
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                                @if ($mfile->Category == '')
                                                    <div class="col-md-6">
                                                        <a href="{{ asset('uploads/orders/vector') . '/' . $mfile->File }}"
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
                                    </div>
                                </div>
                            </div>
                            @endif @if (!$RivisionHistory->IsEmpty())
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Order History </h3>
                                        </div>
                                        <div class="box-body m-l-250">
                                            @foreach ($RivisionHistory as $history)
                                                <div class="form-group">
                                                    <label>{{ $history->From == 3 ? 'Customer' : 'Admin' }}:</label>
                                                    <p>
                                                        <?= $history->Message ?><small
                                                            class="pull-right">{{ $history->DateAdded }}</small>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- /.col (left) -->
                            @if ($VectorOrders->OrderType == 0 || $VectorOrders->OrderType == 2 || $VectorOrders->OrderType == 3)
                                @if ($VectorOrders->Status != 8)
                                    @if ($VectorOrders->Status != 7)
                                        @if ($VectorOrders->Status != 4)
                                            @if ($VectorOrders->Status != 6)
                                                {!! Form::open(['url' => 'admin/vec-assign-designer/' . $VectorOrders->VectorOrderID]) !!}
                                                <div class="col-md-6">
                                                    <div class="box box-primary">
                                                        <div class="box-header">
                                                            <h3 class="box-title">Assigment </h3>
                                                            @include('admin/includes/front_alerts')
                                                        </div>
                                                        <div class="box-body">
                                                            <!-- Date -->
                                                            <div class="form-group">
                                                                <label>Designer:</label>
                                                                {!! Form::select('DesignerID', $Designers, $VectorOrders->VectorOrderID, ['class' => 'form-control']) !!}
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
                                                        <button type="submit"
                                                            class="btn btn-block btn-primary">ASSIGN</button>
                                                    </div>
                                                    <!-- /.form group -->
                                                </div>
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['url' => 'admin/order_revision/' . $VectorOrders->VectorOrderID]) !!}
                                                <div class="col-md-6">
                                                    <div class="box box-primary">
                                                        <div class="box-header">
                                                            <h3 class="box-title">Revise {{ $type }} </h3>
                                                        </div>
                                                        <div class="box-body">
                                                            @include('admin/includes/front_alerts')
                                                            <div class="form-group">
                                                                <label>Current Designer:</label>
                                                                <div><span class="text">
                                                                        {{ $VectorOrders->DesignerName }}</span></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Designer:</label>
                                                                {!! Form::select('DesignerID', $Designers, $VectorOrders->VectorOrderID, ['class' => 'form-control']) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Instruction For Designer:</label>
                                                                {!! Form::textarea('MessageForDesigner', null, [
                                                                    'class' => 'form-control',
                                                                    'placeholder' => 'Enter your Instruction here',
                                                                ]) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit"
                                                                    class="btn btn-block btn-warning">Revise</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            @endif
                                        @else
                                            @if (!empty($VectorOrders->DesignerID))
                                                <div class="col-md-6">
                                                    <div class="box box-primary">
                                                        <div class="box-header">
                                                            <h3 class="box-title">Assigment </h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <h2>Assigned to <a
                                                                    href="{{ url('admin/designers/details/' . $VectorOrders->DesignerID) }}">{{ $VectorOrders->DesignerName }}</a>
                                                            </h2>
                                                            {!! Form::open(['url' => 'admin/vec-assign-designer/' . $VectorOrders->VectorOrderID]) !!}
                                                            <div class="form-group">
                                                                <label>Designer:</label>
                                                                {!! Form::select('DesignerID', $Designers, $VectorOrders->VectorOrderID, ['class' => 'form-control']) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Instruction For Designer:</label>
                                                                {!! Form::textarea('MessageForDesigner', null, [
                                                                    'class' => 'form-control',
                                                                    'placeholder' => 'Enter your Instruction here',
                                                                ]) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit"
                                                                    class="btn btn-block btn-primary">APPROVE TO
                                                                    ANOTHER DESIGNER</button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                {!! Form::open(['url' => 'admin/vec-assign-designer/' . $VectorOrders->VectorOrderID]) !!}
                                                <div class="col-md-6">
                                                    <div class="box box-primary">
                                                        <div class="box-header">
                                                            <h3 class="box-title">Assigment </h3>
                                                            @include('admin/includes/front_alerts')
                                                        </div>
                                                        <div class="box-body">
                                                            <!-- Date -->
                                                            <div class="form-group">
                                                                <label>Designer:</label>
                                                                {!! Form::select('DesignerID', $Designers, $VectorOrders->VectorOrderID, ['class' => 'form-control']) !!}
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
                                                        <button type="submit"
                                                            class="btn btn-block btn-primary">ASSIGN</button>
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
                                                        href="{{ url('admin/designers/details/' . $VectorOrders->DesignerID) }}">{{ $VectorOrders->DesignerName }}</a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @elseif(
                                $VectorOrders->OrderType == 1 &&
                                    $VectorOrders->Status != 6 &&
                                    $VectorOrders->Status != 10 &&
                                    $VectorOrders->Status != 7)
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
                            @elseif($VectorOrders->Status == 7)
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
                            @elseif($VectorOrders->Status == 10)
                                @if ($VectorOrders->OrderType == 1 || $VectorOrders->OrderType == 9)
                                    {!! Form::open(['url' => 'admin/order_revision/' . $VectorOrders->VectorOrderID]) !!}
                                    <div class="col-md-6">
                                        <div class="box box-primary">
                                            <div class="box-header">
                                                <h3 class="box-title">Revise {{ $type }} </h3>
                                            </div>
                                            <div class="box-body">
                                                @include('admin/includes/front_alerts')
                                                <div class="form-group">
                                                    <label>Current Designer:</label>
                                                    <div><span class="text">
                                                            {{ $VectorOrders->DesignerName }}</span></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Designer:</label>
                                                    {!! Form::select('DesignerID', $Designers, $VectorOrders->VectorOrderID, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group">
                                                    <label>Instruction For Designer:</label>
                                                    {!! Form::textarea('MessageForDesigner', null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter your Instruction here',
                                                    ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit"
                                                        class="btn btn-block btn-warning">Revise</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                @elseif($VectorOrders->OrderType == 4)
                                    {!! Form::open(['url' => 'admin/vec-assign-designer-rev/' . $VectorOrders->VectorOrderID]) !!}
                                    <div class="col-md-6">
                                        <div class="box box-primary">
                                            <div class="box-header">
                                                <h3 class="box-title">Revise Quote </h3>
                                            </div>
                                            <div class="box-body">
                                                @include('admin/includes/front_alerts')
                                                <div class="form-group">
                                                    <label>Current Designer:</label>
                                                    <div><span class="text">
                                                            {{ $VectorOrders->DesignerName }}</span></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Designers:</label>
                                                    {!! Form::select('DesignerID', $Designers, $VectorOrders->VectorOrderID, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group">
                                                    <label>Instruction For Designer:</label>
                                                    {!! Form::textarea('MessageForDesigner', null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter your Instruction here',
                                                    ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit"
                                                        class="btn btn-block btn-warning">Revise</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            @endif
                            <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <!-- iCheck -->
                    <!-- /.row -->
                </section>
                <!-- /.content -->
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->
        @include('admin/includes/footer')
        <div class="modal fade" id="modal-default">
            {!! Form::open(['url' => '/admin/vdelete/' . $VectorOrders->VectorOrderID]) !!}
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



            if (qty > 0) {
                price = price * qty;
            }

            if (price != '' || discount != '') {

                if (discount >= price) {


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
                Price = Price - d;
            }

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
