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
        <title>{{ $configuration->WebsiteTitle }} | Digitizing Orders</title>
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
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .pl-10{
                padding-right: 10px;
            }
            .new{
                background: #3c52bc29 !important;
                font-weight: 700;
            }
            .completed{
                background: #44bc3c29 !important;
            }
            .backcolor2{
                background: #ff6d5f !important;
                color: #ffff;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            @include('designer/includes/header')
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
                        <h1><i class="fa fa-users"></i> ORDERS </h1>
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
                                        <h3 class="box-title"><strong>DIGITIZING ORDERS</strong></h3>
                                        @if(!in_array("revision", $link_array))
                                        {{ Form::select('ReqFormat', array('all' => 'All',
                                                                            '0' => 'New Orders',
                                                                            '1' => 'Order Revision',
                                                                            '6' => 'Completed Orders'),
                                         $page, array('id' => 'status','class' => 'pull-right btn btn-info')) }}
                                        
                                         @endif
                                    </div>
                                    
                                    
                                    
                                      <!--'5' => 'Approved Orders',-->
                                    <div class="box-body table-responsive">
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Order#</th>
                                                    <th>PO Number</th>
                                                    <th>Design Name</th>
                                                    <th>Customer Name</th>
                                                    <th>Order Type</th> 
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($orders))
                                                    @foreach ($orders as $order)
                                                    <tr class="<?= $order->IsRead == 1 ? 'new' : ($order->Status == 8 || $order->Status == 7 || $order->Status == 6 ? 'completed' : '') ?> <?php if($order->OrderStatus == 2 && $order->Status != 7){ echo "backcolor2"; } ?>">
                                                        <td>{{ $order->OrderID }}</td>
                                                        <td>{{ $order->PONumber }}</td>
                                                        <td>{{ $order->DesignName }}</td>
                                                        <td>{{ $order->CustomerName }}</td>
                                                        <td>{{ $OrderTypes[$order->OrderType] }}</td>
                                                        <td><?= $order->Status == 8 ? '<label class="label label-success">Order Done</label>' : ($order->Status == 7 || $order->Status == 6 ? '<label class="label label-primary">Order Sent</label>' : ($order->Status == 5? '<label class="label label-info">Approved Order</label>' : ($order->Status == 4 || $order->Status == 3 || $order->Status == 2? '<label class="label label-warning">Quote Sent</label>' : ($order->Status == 1? '<label class="label label-primary">New Quote</label>' : ($order->Status == 10? '<label class="label label-warning">Order Revision</label>' : ''))))) ?></td>
                                                        <td><Button class="btn btn-primary" onclick="location.href='{{ url('/designer/digi/details/'.$order->OrderID) }}'"> Detail</Button></td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            



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
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script language="javascript">
            
            if(performance.navigation.type == 2){
                location.reload(true);
             }
            
            $('#switch').change(function() {
                location.href='{{url("designer/digi/quote")}}/'+$('#status').val();
              });
            
            var checkAll;
            var checkboxes;

            $(function () {

                var data_list = $('#dataList').dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        'type': 'POST',
                        'url': '{{ url(Request::path()) }}',
                        'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                    },
                    "pageLength": 50,
                    "aLengthMenu": [[10, 25, 50, 100, ], [10, 25, 50, 100, "All"]],
                    aoColumnDefs: [
                        {
                            bSortable: false,
                            aTargets: [0, 8]
                        }
                    ],
                    "order": [[1, 'desc']],
                    "oLanguage": {
                        "sSearch": "",
                        "sProcessing": "<img src='{{ asset('assets/admin') }}/images/loading-spinner-grey.gif'>"
                    },
                    "fnDrawCallback": function () {
                        checkAll = $('input.all');
                        checkboxes = $('input.check');

                        $('input[type="checkbox"], input[type="radio"]').iCheck({
                            checkboxClass: 'icheckbox_minimal-blue',
                            radioClass: 'iradio_minimal-blue'
                        });
                        checkAll.on('ifChecked ifUnchecked', function (event) {
                            if (event.type == 'ifChecked') {
                                checkboxes.iCheck('check');
                            } else {
                                checkboxes.iCheck('uncheck');
                            }
                        });

                        checkboxes.on('ifChanged', function (event) {
                            if (checkboxes.filter(':checked').length == checkboxes.length) {
                                checkAll.prop('checked', 'checked');
                            } else {
                                checkAll.removeProp('checked');
                            }
                            checkAll.iCheck('update');
                        });

                        $(".btnTools").prop("disabled", !(parseInt(data_list.fnGetData().length) > 0));
                    }
                });

                $('#dataList_filter input').attr('placeholder', 'Search...');
            });

            function doDelete()
            {
                if (checkboxes.filter(':checked').length > 0)
                {
                    ok = function () {
                        $("#frm_list").submit();
                    };
                    message_box("Confirm", "This will delete all Customers.<br>Are you sure?", "confirm", ok, null);
                } else
                {
                    message_box("Alert", "Please select Customer to delete", "alert", null, null);
                }
            }
        </script>
        <script>
            $('#status').change(function(){
                location.href=$(this).val();
             });
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
        datasets: [{
                label: '',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(37, 115, 212, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(37,115,212,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: '',
                data: [3, 2, 5, 3, 19, 12],
                backgroundColor: [
                    'rgba(31, 152, 63, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(31,152,63,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: '',
                data: [13, 21, 26, 15, 29, 12],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
        }
    }
});
        </script>
    </body>
</html>
