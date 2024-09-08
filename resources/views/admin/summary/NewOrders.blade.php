<?php
    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $page = end($link_array);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Digitizing</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon">
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
        /* New */
          .new0{
                background: #3c52bc29 !important;
                font-weight: 700;
            }
            .font4{
                font-weight: 1500;  !important;
            }
            /* Complete */
            .newclass8{
                background: #a9d2ef !important;
                font-weight: 400;
            }
             /* New */
             .newclass4{
                background: #008a8361 !important;
                 font-weight: 1500;
            }
            /* Ready */
            .newclass6{
                background: #7fffa7 !important;
                 font-weight: 400;
            }

            /* revision */
            .newclass10 {
                background: #e6da34b3 !important;
            }

            .backcolor2{
                background: #ff6d5f !important;
                color: #ffff;
            }
                .center{
                 text-align: center;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

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
                        <h1><i class="fa fa-users"></i>Today's Order </h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Customers</li>
                        </ol>
                    </section>
                    <!-- Main content -->
                    


                    <section class="content">


   <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>DIGITIZING </strong></h3>
                                        @if(strpos($link, '/orders/') !== false)
                                        {{ Form::select('ReqFormat', array('all' => 'All',
                                                                            '0' => 'New Order',
                                                                            '1' => 'Order Revisions',
                                                                            '2' => 'New Quote',
                                                                            '3' => 'Free Orders',
                                                                            '4' => 'Quote Revisions',
                                                                            '9' => 'Free Revision'),
                                         $page, array('id' => 'status','class' => 'pull-right btn btn-info')) }}
                                         @endif
                                    </div>
                                    <div class="box-body table-responsive">
                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0" style="text-align: center;">
                                        

                                  <thead>
                                               <tr>
                                                    <th class="center">Order #</th>
                                                    <th class="center">PO #</th>
                                                    <th class="center">Design Name</th>
                                                    <th class="center">Customer Name</th>
                                                    <th class="center">Order Type</th> 
                                                    <th class="center">Designer</th>
                                                     <th>Sales Rep</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Date</th>
                                                    <th class="center">Action</th>
                                            
                                                </tr>
                                   </thead>
           


  <?php  
                   if(count($DigiOrders) > 0) {
                      foreach ($DigiOrders as $OrderData) {
                   ?>

                                              <tr class="newclass<?php echo $OrderData->Status ?> new<?php echo $OrderData->IsRead ?> font<?php echo $OrderData->IsRead ?> <?php if($OrderData->OrderStatus == 2 && $OrderData->Status != 7){ echo "backcolor2"; } ?>"> 


                                                  <td>{{ App\Http\Helper::getPrefix('digitizing', $OrderData->OrderType ) . '-'. $OrderData->OrderID }}</td>
                                                  <td>{{ $OrderData->PONumber }}</td>
                                                  <td>{{ $OrderData->DesignName }}</td>
                                                  <td><a href="{{ url('admin/customers/sortdetails/'.$OrderData->CusId) }}"> {{ $OrderData->CustomerName }}</a> </td>
                                                  <td>{{ $OrderTypes[$OrderData->OrderType] }}</td>
                                                  <td>{{ $OrderData->DesignerName }}</td>
                                                   <td>{{ $OrderData->salesrep }}</td>
                                                  <td>{{ $OrderStatuses[$OrderData->Status] }}</td>
                                                  
                                                <td> {{date('d-M-Y h:i:s:A', strtotime($OrderData->DateAdded))}}</td>
                                                  <td>

                                                    <select class="pull-right btn btn-primary" onchange="javascript:takeAction({{$OrderData->OrderID}})" id="action-{{$OrderData->OrderID}}">
                                                        <option value="">Select Action</option>
                                                        <option value="view" on>View</option>
                                                        <option value="update_type">Update Type</option>
                                                    </select>

                                                    {{-- <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="Filesattach" rows="2"><b>Change Order Type </b>
                                                                <span class="mandatory">(Leave blank if you do not want to
                                                                    change)</span>
                                                            </label>
        
                                                            <select class="form-control" name="OrderType">
                                                                <option value="">Select Option</option>
                                                                @foreach ($OrderTypes as $key => $type)
                                                                    <option value="{{ $key }}">{{ $type }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> --}}

                                                
                                                </td> 

                                                </tr>

                                                 <?php  }} ?> 
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            
</div>

                    <!-- /.content -->
                </div>
            </div>

            <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal_label" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_modal_label">Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modal_body">
                            <form method="POST" id="updateForm" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="Filesattach" rows="2">Update Order Type</label>
                                        <select class="form-control" name="OrderType">
                                            <option value="">Select Option</option>
                                                <option value="0">New Order</option>
                                                <option value="1">Order Revision
                                                </option>
                                                <option value="2">New Quote
                                                </option>
                                                <option value="3">Free Order
                                                </option>
                                                <option value="4">Quote Revision
                                                </option>
                                                <option value="5">Extra Time
                                                </option>
                                                <option value="7">On Hold
                                                </option>
                                                <option value="9">Free Order Revision
                                                </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 16px">
                                <button type="submit" class="mt-4 btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
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
    window.setInterval('refresh()', 60000);     // CALL A FUNCTION EVERY 10000 MILLISECONDS OR 10 SECONDS.

    // REFRESH OR RELOAD PAGE.
    function refresh() {
        window.location.reload();
    }
</script>
        
        
        <script>
            $('#status').change(function(){
                location.href=$(this).val();
             });

             function takeAction(id) {
                var value = $('#action-' + id + '').val();
                if (value == 'update_type') {
                    // $('#modal_body').html(data.html);
                    // $('#edit_modal_label').html(data.title);
                    url = "{{ url('/admin/Norder-details/:id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'GET',
                        url: url,
                        beforeSend: function () {
                            // setting a timeout
                        },
                        success: function (data) {
                            $('#edit_modal_label').html("Edit Order -"+data.data.DigiOrders.OrderID);
                          var actionURL ="{{ url('admin/digi/order_update/:id') }}";
                          actionURL = actionURL.replace(':id', data.data.DigiOrders.OrderID);
                          $('#updateForm').attr('action', actionURL);

                          $('#edit_modal').modal('show');

                        },
                        error: function (xhr) { // if error occured
                            alert("Error occured.please try again");
                        },
                        complete: function () {
                        },
                    });

                } else if (value == 'view') {
                    url = "{{ url('/admin/Norder-details/:id') }}";
                    url = url.replace(':id', id);
                    return window.location.href = url;
                } else {
                    alert("Error occured.please try again");
                }
            }
        </script>
    </body>
</html>
