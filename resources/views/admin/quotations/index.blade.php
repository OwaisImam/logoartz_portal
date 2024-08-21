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
        <link rel="shortcut icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/iCheck/minimal/blue.css">

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
                        <h1><i class="fa fa-users"></i>Website Quotations </h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Website Quotations</li>
                        </ol>
                    </section>
                    <!-- Main content -->
                    


                    <section class="content">


   <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>Quotations </strong></h3>
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
                                                    <th class="center">#</th>
                                                    <th class="center">Full Name</th>
                                                    <th class="center">Email</th>
                                                    <th class="center">Phone</th>
                                                    <th class="center">Need By</th> 
                                                    <th class="center">Date</th>
                                                    <th class="center">Action</th>
                                                    <th></th>
                                                </tr>
                                   </thead>
           


  <?php  
                   if(count($quotations) > 0) {
                      foreach ($quotations as $quotation) {
                   ?>

                                              <tr class="newclass4 new3 font3"> 


                                                  <td>{{ $quotation->id }}</td>
                                                  <td>{{ $quotation->full_name }}</td>
                                                  <td>{{ $quotation->email }}</td>
                                                  <td>{{ $quotation->phone }}</td>
                                                  <td>{{ $quotation->needby }}</td>
                                                  
                                                <td> {{date('d-M-Y h:i:s:A', strtotime($quotation->created_at))}}</td>
                                                  <td>
                                                    <Button class="btn btn-primary" onclick="location.href='{{ url('/admin/website_quotations/'.$quotation->id) }}'"> Detail</Button>
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
            <!-- /.content-wrapper -->
            @include('admin/includes/footer')

        </div>
        <script src="{{ asset('assets/admin/') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/fastclick/fastclick.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!--<script src="{{ asset('assets/admin/') }}/plugins/chartjs/Chart.min.js"></script>-->
        <script src="{{ asset('assets/admin/') }}/dist/js/app.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/Chart.bundle.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/Chart.min.js"></script>
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
