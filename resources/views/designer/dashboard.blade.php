<?php 
$did = \Session::get('Dcatagory');
             
 ?>

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
        <div class="wrapper"> @include('designer/includes/header')

            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <h1>Designer Dashboard </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </section>
                    <section class="content">
                        
                        
                        



          {!! Form::open(['url' => 'designer/search/order']) !!}
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
                                <label for="RequriedClr">Design Name</label>
                                {!! Form::text('design_name', null, ['class' => "form-control", 'placeholder' => "Design Name"]) !!}

                            </div>

                        

                            <div rowspan="3" class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr"> &nbsp;</label>
                               <button type="submit" class="btn btn-primary btn-flat form-control"><i class="fa fa-search"></i> Search</button>


                            </div>
                   
                           

                   
                      </div>
                                 

       </section>
       
       {!! Form::close() !!}
       
       
       
       <?php  
        
         if(!empty($did)){
         if($did == 2){
        ?>
                     <!------ D    I   G   I   T   I   Z   I   N   G            O    R   D   E   R   S  -------------->

          
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success" style="font-size: 20px">
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
                                                  <td><a href="{{ url('/designer/digi/0') }}">Orders <span class="label label-menu">{{ $diginewordersonly !=0 ? $diginewordersonly : ''}}</span></a></td>
                                                  <td>{{ $count_digi_new_orders }}</td>
                                                </tr>
                                                <tr>         
                                                   <td><a href="{{ url('/designer/digi/1') }}">Orders Revision<span class="label label-menu">{{ $digiordersrevs !=0 ? $digiordersrevs : ''}}</span></a></td>
                                                  <td>{{ $count_digi_orders_rev }}</td>
                                                </tr>
                                                <tr>         
                                                  <td><a href="{{ url('designer/digi/quote/0') }}">Quotes<span class="label label-menu">{{ $diginewquotesonly !=0 ? $diginewquotesonly : ''}}</span></a></td>
                                                  <td>{{ $count_digi_new_quote }}</td>
                                                </tr>
                                                 <tr>         
                                                  <td><a href="{{ url('designer/digi/quote/1') }}">Quotes Revision<span class="label label-menu">{{ $digiquotesrev !=0 ? $digiquotesrev : ''}}</span></a></td>
                                                  <td>{{ $count_digi_quote_rev }}</td>
                                                </tr>
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            
    <?php }else{  ?> 
                            
                   
                         
                   
                      <!------ V   E   C    T    A   R         O    R   D   E   R   S  ------------>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success" style="font-size: 20px">
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
                                                  <td><a href="{{ url('/designer/vector/0') }}">New Orders<span class="label label-menu">{{ $vectornewordersonly !=0 ? $vectornewordersonly : ''}}</span></a></td>
                                                  <td>{{ $count_vector_new_orders }}</td>
                                                </tr>
                                                 <tr>         
                                                  <td><a href="{{ url('/designer/vector/1') }}">Orders Revisions<span class="label label-menu">{{ $vectororderrev !=0 ? $vectororderrev : ''}}</span></a></td>
                                                  <td>{{ $count_vector_orders_rev }}</td>
                                                </tr>
                                                <tr>         
                                                  <td><a href="{{ url('/designer/vector/quote/0') }}">New Quotes<span class="label label-menu">{{ $vectornewquotesonly !=0 ? $vectornewquotesonly : ''}}</span></a></td>
                                                  <td>{{ $count_vector_new_quote }}</td>
                                                </tr>
                                                 <tr>         
                                                  <td><a href="{{ url('/designer/vector/quote/1') }}">Quotes Revisions<span class="label label-menu">{{ $vectorquoterev !=0 ? $vectorquoterev : ''}}</span></a></td>
                                                  <td>{{ $count_vector_quote_rev }}</td>
                                                </tr>
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
<?php } }  ?>      

                        </div>
                        
                        
                  
                        <!-- /.row -->
      
                   
                   
                   
                   
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
        
          
    window.setInterval('refresh()', 60000);     // CALL A FUNCTION EVERY 10000 MILLISECONDS OR 10 SECONDS.

    // REFRESH OR RELOAD PAGE.
    function refresh() {
        window.location.reload();
    }
</script>
        
    </body>
</html>
