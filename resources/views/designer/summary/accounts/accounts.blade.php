<?php
    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $page = end($link_array);

    $page = 'admin/search/summary';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Summary</title>
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
          .new{
                background: #3c52bc29 !important;
                font-weight: 700;
            }
            /* Complete */
            .newclass8{
                background: #a9d2ef !important;
                font-weight: 400;
            }
             /* New */
             .newclass4{
                background: #008a8361 !important;
                 font-weight: 400;
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
                                @include('designer/includes/front_alerts')
                            </div>                            
                        </div>
                    </section>
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1><i class="fa fa-users"></i>Accounts Summary</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Summary</li>
                        </ol>
                    </section>
                    <!-- Main content -->
                    
                    <section class="content">


   <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>ORDERS</strong></h3>
                                       
                                  
                                    </div>
                                    <div class="box-body table-responsive">
                                     {!! Form::open(['url' => 'designer/acc/accounts']) !!}
                           <section style="padding-bottom: 50px;">
                        <div class="row">
                           
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                    <label for="RequriedClr">From:</label>
                                     {!! Form::date('DateFrom', null, ['class' => "form-control", 'placeholder' => "Select Date", 'required']) !!}
                                     
                            </div>

                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr">TO:</label>
                                {!! Form::date('DateTo', null, ['class' => "form-control", 'placeholder' => "Select Date", 'required']) !!}

                            </div>



                            <div class="col-md-3 col-sm-6 col-xs-12">
                            
                                <label for="Cetagory">Type:</label>
                                 <select name="order_type" class="form-control" required>
                                 <option class="form-control" value="">Select</option>
                                 <option class="form-control" value="1">Orders</option>
                                 <option class="form-control" value="2">Quotes</option>
                            
                                </select>

                            </div>

                            
                            <label hidden=""></label>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr"> &nbsp;</label>
                               <button type="submit" class="btn btn-primary btn-flat form-control"><i class="fa fa-search"></i> Search</button>


                            </div>
                             {!! Form::close() !!}
                   
                   </div>

       </section>






                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                        
                                  <thead>
                                               <tr>
                                                    <th>Order#</th>
                                                    <th>PO Number</th>
                                                    <th>Design Name</th>
                                                    <th>Order Date</th>
                                                    <th>Last Order Type</th>
                                                    <?php  if(!empty($Orders)){ 
                                                      if($or_type == 1){ ?>
                                                    <th>Designer Price</th> 
                                                     <?php }
                                                     } ?>
                                                    <th>Action</th>
                                                </tr>
                                   </thead>




<?php  
             
                   if(!empty($Orders)) {
                      foreach ($Orders as $OrderData) {
                   ?>

                                              <tr class="newclass<?php echo $OrderData->Status ?>"> 

                                                  <?php  if($Cat == 2){  ?>
                                                  <td>{{ $OrderData->OrderID }}</td>
                                                  <?php }else{ ?>
                                                  <td>{{ $OrderData->VectorOrderID }}</td>  
                                                  <?php }  ?>      

                                                  <td>{{ $OrderData->PONumber }}</td>

                                                  <td>{{ $OrderData->DesignName }}</td>

                                                  <td>{{ $OrderData->CustomerName }}</td>

                                                  <td>{{ $OrderTypes[$OrderData->OrderType] }}</td>
                                               <?php if($or_type == 1){
                                               ?>
                                                  <td class="tdp label label-success" style="font-size: 110%; margin: 10%">Rs. {{  $OrderData->DesignerPrice  }}</td>
                                                <?php } ?>
                                                  
                                                    

                                                  <?php  if($Cat == 2){  ?>
                                                 <td><Button class="btn btn-primary" type="button" onclick="location.href='{{ url('/designer/digi/details/'.$OrderData->OrderID) }}'"> Detail</Button>
                                                  </td> 
                                                  <?php }else{ ?>
                                                 <td><Button class="btn btn-primary" type="button" onclick="location.href='{{ url('/designer/vector/details/'.$OrderData->VectorOrderID) }}'"> Detail</Button>
                                                  </td>
                                                  <?php }  ?>                          
                                                  
                                                  
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
        <script type="text/javascript">
           //*
$(document).ready(function () {
       
    $("#dataList").on('td', '.tdp', function () {
       // code logic here
        var getValue=$(this).val();
        console.log(getValue);
    });

 });



$(document).ready(function () {
       
    $("#dataList").on('td', '.tdp', function () {
       var calculated_total_sum = 0;
     
       $("#dataList .tdp").each(function () {
           var get_textbox_value = $(this).val();
           if ($.isNumeric(get_textbox_value)) {
              calculated_total_sum += parseFloat(get_textbox_value);
              }                  
            });
              $("#total_sum_value").html(calculated_total_sum);
       });
  });

        </script>
 
        
    
    </body>
</html>
