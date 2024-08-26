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
        <title>{{ $configuration->WebsiteTitle }} | Accounts</title>
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
                        <h1><i class="fa fa-users"></i>Vector Accounts Summary</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active"> Accounts</li>
                        </ol>
                    </section>
                    <!-- Main content -->
                        


                    <section class="content">   


            <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>Create Invoices</strong></h3>
                                    </div>

                       @include('admin/includes/front_alerts')     


                                    <div class="box-body table-responsive" >
                                     {!! Form::open(['url' => 'admin/search/vacc']) !!}
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
                            
                                <label for="Cetagory">Customers:</label>
                                 <select name="cusname" class="form-control" required>
                                 <option class="form-control" value="">Select</option>
                               <?php   
                                 if(!empty($allcustomers)){
                                        foreach ($allcustomers as $Customer) {
                                   ?> 

                                <option class="form-control" value="{{ $Customer->CustomerID }}">{{ $Customer->CustomerName }} </option>

                                  <?php   } }  ?>
                                </select>

                            </div>


                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="RequriedClr"> &nbsp;</label>
                               <button type="submit" class="btn btn-primary btn-flat form-control"><i class="fa fa-search"></i> Search</button>


                            </div>

                         {!! Form::close() !!}
                   </div>

       </section>

       {!! Form::open(['url' => 'admin/generate-vec-invoice', 'id' => 'invoice-form']) !!}

                     <div class="row">
                                    <div class="col-md-2 col-sm-6 col-xs-12 pull-right">
                               <button type="submit" class="btn bg-maroon btn-flat margin pull-left invoice-btn
                                        invoice-btn">Generate Invoice</button>
                                  </div>
                    </div>






                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                        
                                  <thead>
                                               <tr>  
                                                    <th><input type="checkbox" id="checkAllNone" class="all" /></th>
                                                    <th>Order#</th>
                                                    <th>PO Number</th>
                                                    <th>Design Name</th>
                                                    <th>Customer Name</th>
                                                    <th>Price</th> 
                                                
                                                    
                                                
                                                    <th></th>
                                                </tr>
                                   </thead>

<?php  
             
                   if(!empty($Orders)) {
                      foreach ($Orders as $OrderData) {
                   ?>

                                              <tr class="newclass<?php echo $OrderData->Status ?>"> 

                                                  <td><input type="checkbox" name="OrderIDs[]" value="{{ $OrderData->VectorOrderID }}" id="checkAllNone" class="all orderids" /></td>
                                                  <td>{{ $OrderData->VectorOrderID }}</td>
                                                  <td>{{ $OrderData->PONumber }}</td>
                                                  <td>{{ $OrderData->DesignName }}</td>
                                                  <td>{{ $OrderData->CustomerName }}</td>
                                                  <td ><strong class="label label-danger" style="font-size: 15px">${{$OrderData->Price}}</strong></td>
                                              

                                                <!--   <td>
                                                    <Button class="btn btn-primary" type="button" onclick="location.href='{{ url('/admin/Norder-details/'.$OrderData->OrderID) }}'">Create Invoice</Button>
                                                  </td>  -->

                                                  
                                                </tr>

                                                 <?php  }} ?> 



                                                         
              {!! Form::hidden('CustomerID', (isset($CustomerID) ? $CustomerID : old('CustomerID')), []) !!}


    

                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            
{!! Form::close() !!}


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

$(document).ready(function() {
    $('.invoice-btn').click(function() {
        if($('.orderids').is(':checked')) {
            $('#invoice-form').submit();
        } else {
            alert("please select order");
        }
    });
});

</script>
        
    
    </body>
</html>
