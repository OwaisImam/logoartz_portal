<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            /*            .info-box-content {
                            padding: 11% 22% !important;
                        }*/
            .info-box-content {
                padding-top: 11% !important;
            }
            .bg-aqua {
                background-color: #f8b239 !important;
            }
        </style>
    </head>


    <body class="hold-transition skin-blue layout-top-nav">

    <div class="wrapper"> 

@include('salesperson/includes/header')

    <div class="content-wrapper">
        <div class="container">
            <section class="content-header">
                <h1>Sales Rep | Dashboard </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <section class="content">




     <section style="padding-bottom: 50px;">    

               

          <div class="row">
            <div class="col-xs-6">
               <!------ D    I   G   I   T   I   Z   I   N   G            O    R   D   E   R   S  -------------->
                <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"  style="text-align: center"><strong>TODAYS DIGITIZING</strong></h3>
                                     </div>
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Digitizing</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                                <tr>         
                                                  <td><a href="{{ url('salesperson/digi/orders/0') }}">Orders </a></td>
                                                  <td>{{ $count_digi_new_orders }}</td>
                                                </tr>
                                                <tr>         
                                                   <td><a href="{{ url('salesperson/digi/orders/1') }}">Orders Revision</a></td>
                                                  <td>{{ $count_digi_orders_rev }}</td>
                                                </tr>
                                                 <tr>         
                                                   <td><a href="{{ url('salesperson/digi/orders/3') }}">Free Orders</a></td>
                                                  <td>{{ $count_digi_orders_rev }}</td>
                                                </tr>
                                                   <tr>         
                                                   <td><a href="{{ url('salesperson/digi/orders/9') }}">Free Orders Revision</a></td>
                                                  <td>{{ $count_digi_free_orders_rev }}</td>
                                                </tr>
                                                <tr>         
                                                  <td><a href="{{ url('salesperson/digi/orders/2') }}">Quotes</span></a></td>
                                                  <td>{{ $count_digi_new_quote }}</td>
                                                </tr>
                                                 <tr>         
                                                  <td><a href="{{ url('salesperson/digi/orders/4') }}">Quotes Revision</span></a></td>
                                                  <td>{{ $count_digi_quote_rev }}</td>
                                                </tr>
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                        </div>
           
           
           
           
            </div>

                <div class="col-xs-6">
                <div class="row">
                  <!------ V   E   C    T    A   R         O    R   D   E   R   S  ------------>
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>TODAYS VECTOR</strong></h3>
                                     </div>
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Vector</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                                <tr>         
                                                  <td><a href="{{ url('salesperson/vector/orders/0') }}">New Orders</a></td>
                                                  <td>{{ $count_vector_new_orders }}</td>
                                                </tr>
                                                 <tr>         
                                                  <td><a href="{{ url('salesperson/vector/orders/1') }}">Orders Revisions</a></td>
                                                  <td>{{ $count_vector_orders_rev }}</td>
                                                </tr>
                                                <tr>         
                                                   <td><a href="{{ url('salesperson/vector/orders/3') }}">Free Orders</a></td>
                                                  <td>{{ $count_vector_orders_rev }}</td>
                                                </tr>
                                                <tr>         
                                                   <td><a href="{{ url('salesperson/vector/orders/9') }}">Free Orders Revision</a></td>
                                                  <td>{{ $count_vector_free_orders_rev }}</td>
                                                </tr>
                                                <tr>         
                                                  <td><a href="{{ url('salesperson/vector/orders/2') }}">Quotes</a></td>
                                                  <td>{{ $count_vector_new_quote }}</td>
                                                </tr>
                                                 <tr>         
                                                  <td><a href="{{ url('salesperson/vector/orders/4') }}">Quotes Revisions</a></td>
                                                  <td>{{ $count_vector_quote_rev }}</td>
                                                </tr>
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!--ROw Close--->
            
            
            
            
            
            </div>

           </div>
                  
                            <!-- /.col -->
                            

                   
                    
                        
  

                        </div>
                        
                        




                

        </section>


    
           

        </div>
    </div>
    @include('salesperson/includes/footer')
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
        </script>
    </body>
</html>
