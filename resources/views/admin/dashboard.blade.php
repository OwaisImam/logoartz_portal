<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/_all-skins.min.css') }}">
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
        <div class="wrapper"> @include('admin/includes/header')

            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <h1> Dashboard </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </section>
                    <section class="content">



             {!! Form::open(['url' => 'admin/search/order']) !!}
             <section style="padding-bottom: 50px;">
                        <div class="row">
                           
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr">Order #</label>
                                {!! Form::text('OrderNum', null, ['class' => "form-control", 'placeholder' => "Order Number"]) !!}

                            </div>


                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr">Quote #</label>
                                {!! Form::text('quote_num', null, ['class' => "form-control", 'placeholder' => "Quote #"]) !!}

                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                    <label for="RequriedClr">PO #</label>
                                     {!! Form::text('PoNum', null, ['class' => "form-control", 'placeholder' => "PO Number"]) !!}

                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr">Design Name</label>
                                {!! Form::text('design_name', null, ['class' => "form-control", 'placeholder' => "Design Name"]) !!}

                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                    <label for="RequriedClr">Customer </label>
                                    {!! Form::text('Customer_Name', null, ['class' => "form-control", 'placeholder' => "Customer Name"]) !!}

                            </div>


                        

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                    <label for="RequriedClr">Phone #</label>
                                     {!! Form::text('phone_num', null, ['class' => "form-control", 'placeholder' => "Phone #"]) !!}

                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                    <label for="Email">Customer Email</label>
                                    {!! Form::text('Cus_email', null, ['class' => "form-control", 'placeholder' => "Customer Email"]) !!}

                            </div>


                            <div rowspan="3" class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr"> &nbsp;</label>
                               <button type="submit" class="btn btn-primary btn-flat form-control"><i class="fa fa-search"></i> Search</button>


                            </div>
                   
                           

                   
                      </div>


       </section>
             {!! Form::close() !!}



                     <!------ D    i   G   I   T   I   Z   I   N   G            O    R   D   E   R   S  -------------->

          
                        <div class="row" style="font-size: 20px">
                            <div class="col-xs-6">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>DIGITIZING ORDERS</strong></h3>
                                     </div>
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Digitizing</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                                <tr>         
                                                  <td><a href="{{ url('/admin/digi/orders/0') }}">New Order <span class="label label-menu">{{ $digineworders!=0 ? $digineworders : ''}}</span></a></td>
                                                  <td>{{ $count_digi_new_orders }}</td>
                                                </tr>

                                                <tr>         
                                                  <td><a href="{{ url('/admin/digi/orders/1') }}">Order Revisions <span class="label label-menu">{{ $digiorder_rev!=0 ? $digiorder_rev : ''}}</span></a></td>
                                                  <td>{{ $count_digi_order_revision }}</td>
                                                </tr>


                                                 <tr>         
                                                  <td><a href="{{ url('/admin/digi/orders/2') }}">New Quote <span class="label label-menu">{{ $diginewquotes!=0 ? $diginewquotes : ''}}</span></a></td>
                                                  <td>{{ $count_digi_new_quote }}</td>
                                                </tr>

                                                 <tr>         
                                                  <td><a href="{{ url('/admin/digi/orders/3') }}">Free Orders <span class="label label-menu">{{ $new_digi_free_orders !=0 ? $new_digi_free_orders : ''}}</span></a></td>
                                                  <td>{{ $count_digi_free_orders }}</td>
                                                </tr>

                                                <td><a href="{{ url('/admin/digi/orders/4') }}">Quote Revisions <span class="label label-menu">{{ $digiquote_rev!=0 ? $digiquote_rev : ''}}</span></a></td>
                                                  <td>{{ $count_digi_quote_revisions }}</td>
                                                </tr>

                                                 <tr>         
                                                  <td><a href="{{ url('/admin/digi/orders/9') }}">Free Revision <span class="label label-menu">{{ $new_digi_free_rivision !=0 ? $new_digi_free_rivision : ''}}</span></a></td>
                                                  <td>{{ $count_new_digi_free_rivision }}</td>
                                                </tr>

                                               <!--   <tr>         
                                                  <td><a href="{{ url('/admin/digi/orders/5') }}">Extra Time</a></td>
                                                  <td>{{ $count_digi_extra_time }}</td>
                                                </tr>

                                                 <tr>         
                                                  <td><a href="{{ url('/admin/digi/orders/6') }}">Pending</a></td>
                                                  <td>{{ $count_digi_pending }}</td>
                                                </tr>

                                             <tr>         
                                                <td><a href="{{ url('/admin/digi/orders/7') }}">On Hold</a></td>
                                                <td>{{ $count_digi_hold }}</td>
                                             </tr> -->

                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                   
                         
                   
                      <!------ V   E   C    T    A   R         O    R   D   E   R   S  ------------>
                        <div class="row" style="font-size: 20px">
                            <div class="col-xs-6">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>VECTOR ORDERS</strong></h3>
                                     </div>
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Vector</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                                <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/0') }}">New Order<span class="label label-menu">{{ $vectorneworders!=0 ? $vectorneworders : ''}}</span></a></td>
                                                  <td>{{ $count_vector_new_orders }}</td>
                                                </tr>

 <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/1') }}">Order Revisions <span class="label label-menu">{{ $vectororder_rev !=0 ? $vectororder_rev : ''}}</span></a></td>
                                                  <td>{{ $count_vector_order_revision }}</td>
                                                </tr>


                                                 <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/2') }}">New Quote <span class="label label-menu">{{ $vectornewquotes!=0 ? $vectornewquotes : ''}}</span></a></td>
                                                  <td>{{ $count_vector_new_quote }}</td>
                                                </tr>

                                                 <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/3') }}">Free Orders <span class="label label-menu">{{ $new_vector_free_orders !=0 ? $new_vector_free_orders : ''}}</span></a></td>
                                                  <td>{{ $count_vector_free_orders }}</td>
                                                </tr>

                                                <td><a href="{{ url('/admin/vector/orders/4') }}">Quote Revisions <span class="label label-menu">{{ $vectorquote_rev!=0 ? $vectorquote_rev : ''}}</span></a></td>
                                                  <td>{{ $count_vector_quote_revisions }}</td>
                                                </tr>

                                                 <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/9') }}">Free Revision <span class="label label-menu">{{ $new_vector_free_rivision !=0 ? $new_vector_free_rivision : ''}}</span></a></td>
                                                  <td>{{ $count_new_vector_free_rivision }}</td>
                                                </tr>

                                              <!--    <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/5') }}">Extra Time</a></td>
                                                  <td>{{ $count_vector_extra_time }}</td>
                                                </tr>

                                                 <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/6') }}">Pending</a></td>
                                                  <td>{{ $count_vector_pending }}</td>
                                                </tr>

                                            <tr>         
                                                  <td><a href="{{ url('/admin/vector/orders/7') }}">On Hold</a></td>
                                                  <td>{{ $count_vector_hold }}</td>
                                            </tr> -->
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>


                        </div>
                        <!-- /.row -->
      
                        
                        <!-- V E C T O R   A R T I S T   R E S P O N S E -->
                        
                  <!--       <div class="row">
                            <div class="col-xs-6">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>VECTOR ARTIST RESPONSE</strong></h3>
                                     </div>
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Response</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                                

                                            <tr>         
                                              <td><a href="{{ url('/admin/vector/newquotes/2') }}">Order Response </a></td>
                                              <td>{{ $count_vector_designer_quote }}</td>
                                            </tr>
                                            <tr>         
                                              <td><a href="{{ url('/admin/vector/newquotes/6') }}">Done Orders</a></td>
                                              <td>{{ $count_vector_done_designer }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div> -->
                            <!-- /.col -->
                            
                            <!-- D I G I T I Z E R   R E S P O N S E -->
                            
                    <!--     <div class="row">
                            <div class="col-xs-6">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>DIGITIZER ARTIST RESPONSE</strong></h3>
                                     </div>
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Response</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            
                                            <tr>         
                                              <td><a href="{{ url('/admin/digi/newquotes/1') }}">Order Response</a></td>
                                              <td>{{ $count_digi_designer_quote }}</td>
                                            </tr>
                                            <tr>         
                                              <td><a href="{{ url('/admin/digi/newquotes/6') }}">Done Orders</a></td>
                                              <td>{{ $count_digi_done_designer }}</td>
                                            </tr> -->
                                            <!--<tr>         
                                              <td><a href="{{ url('/admin/vector/newquotes/4') }}">Vector Response</a></td>
                                              <td>{{ $count_vector_customer_quote }}</td>
                                            </tr> 
                                            <tr>         
                                              <td><a href="{{ url('/admin/digi/newquotes/2') }}">Digitizing Response</a></td>
                                              <td>{{ $count_digi_customer_quote }}</td>
                                            </tr>
                                            <tr>         
                                              <td><a href="{{ url('/admin/vector/newquotes/8') }}">Done Vector Orders</a></td>
                                              <td>{{ $count_vector_done_customer }}</td>
                                            </tr>
                                            <tr>         
                                              <td><a href="{{ url('/admin/digi/newquotes/8') }}">Done Digitizing Orders</a></td>
                                              <td>{{ $count_digi_done_customer }}</td>
                                            </tr> -->
                                    <!--     </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                         
                        </div>


                        </div> -->
                   
                   
                   
                        <!--                    <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Monthly Recap Report</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-center"> <strong>Sales: 1 Jun, 2017 - 30 Nov, 2017</strong> </p>
                                                                    <canvas id="myChart" height="80"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->

                        <!--                    <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Monthly Recap Report</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-center"> <strong>Sales: 1 Jun, 2017 - 30 Nov, 2017</strong> </p>
                                                                    <canvas id="myChart" height="80"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->


                </div>
            </div>
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
