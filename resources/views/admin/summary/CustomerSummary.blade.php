<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Customers</title>
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

        <link rel="stylesheet" href="{{ asset('assets/web/css') }}/commentbox.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/iCheck/minimal/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .alert{
                /*opacity: 0.5;*/
            }
            .m-l-250{
               /* max-height: 250px;
                overflow-y: auto;*/
            }

             /* New */
          .new0{
             /*   background: #3c52bc29 !important;
                font-weight: 700;*/
            }
            .font4{
                /*font-weight: 1500;  !important;*/
            }
            /* Complete */
            .newclass8{
             /*   background: #a9d2ef !important;
                font-weight: 400;*/
            }
             /* New */
             .newclass4{
             /*   background: #008a8361 !important;
                 font-weight: 1500;*/
            }
            /* Ready */
            .newclass6{
             /*   background: #7fffa7 !important;
                 font-weight: 400;*/
            }

            /* revision */
            .newclass10 {
                /*background: #e6da34b3 !important;*/
            }
             .backcolor2{
                /*background: #ff6d5f !important;*/
                /*color: #ffff;*/
            }
            .backcolorwithfont2{
             /*   background: #ff6d5f !important;
                color: #ffff;
                font-weight: 1600;*/
            }
        </style>
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            @include('admin/includes/header')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container">

 <div class="box-body"  style="font-size: 14px; background-color: white">
            <div class="row">
              <div class="box-header with-border" style="text-align: center">
                 <h3 class="" style="text-align: center;">Customer Detail</h3>
              
            </div>
                            
             <div class="col-md-6">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body" >
              <table class="table table-bordered" >
             
                <tr>
    
                  <td><label>Customer Name</label></td>
                  <td>
                    {{ $CustomerInfo->CustomerName }}
                  </td>
              
                </tr>
                <tr>

                  <td><label>Cell</label></td>
                  <td>
                   {{ $CustomerInfo->Cell }} 
                  </td>
                
                </tr>
                <tr>

                  <td><label>Email</label></td>
                  <td>
                   {{ $CustomerInfo->Email }}
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
            
            <!-- /.box-header -->
            <div class="box-body" >
              <table class="table table-bordered" >
             
                <tr>
    
                  <td> <label>Company </label> </td>
                  <td>
                   {{ $CustomerInfo->Company }} 
                  </td>
                
                </tr>
                <tr>
    
                  <td><label>Hear About</label></td>
                  <td>
                    {{ $hearAbout[$CustomerInfo->HearAbout] }}
                  </td>
              
                </tr>
                <tr>

                  <td><label>Cell</label></td>
                  <td>
                   {{ $CustomerInfo->Cell }} 
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
                                 

                                 
                                    <div class="col-md-12" >
                                        <div class="form-group">
                                            <label>Price Plan</label>
                                            <p> {{ $CustomerInfo->priceplane }}  </span></p>

                                             
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                

                                       <div class="col-md-12">
                        <div class="form-group">
                          <label>CS Note</label>
                             <p> {{ $CustomerInfo->CsNote }}  </p>
                            </div>
                                </div>

                     </div>




  <?php //  die; ?>



                    </div>




          <!-- DIGITIZING ORDERS -->

          <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>DIGITIZING ORDER</strong></h3>
                                    
                                    </div>
                                    <div class="box-body table-responsive">
                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                        

                                  <thead>
                                               <tr>
                                                    <th>Order #</th>
                                                    <th>Design Name</th>
                                                    <th>Order Type</th> 
                                                    <th>Designer</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                    
                                                
                                                    <th></th>
                                                </tr>
                                   </thead>
           


  <?php  
                   if(count($DigiOrders) > 0) {
                      foreach ($DigiOrders as $OrderData) {
                   ?>

                                              <tr class="newclass<?php echo $OrderData->Status ?> new<?php echo $OrderData->IsRead ?> font<?php echo $OrderData->IsRead ?> <?php if($OrderData->OrderStatus == 2 && $OrderData->Status != 7){ echo "backcolor2"; } ?>"> 


                                                  <td>{{ $OrderData->OrderID }}</td>
                                                  <td>{{ $OrderData->DesignName }}</td>
                                                  <td>{{ $OrderTypes[$OrderData->OrderType] }}</td>
                                                  <td>{{ $OrderData->DesignerName }}</td>
                                                  <td>{{ $OrderStatuses[$OrderData->Status] }}</td>
                                                  <td> {{date('d-M-Y h:i:s:A', strtotime($OrderData->DateAdded))}}</td>
                                                  <td>
                                                    <Button class="btn btn-primary" onclick="location.href='{{ url('/admin/Norder-details/'.$OrderData->OrderID) }}'"> Detail</Button>
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


<!-- DIGITIZING QUOTE -->

    <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>DIGITIZING QUOTE</strong></h3>
                                    
                                    </div>
                                    <div class="box-body table-responsive">
                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                        

                                  <thead>
                                               <tr>
                                                    <th>Quote #</th>
                                                    <th>Design Name</th>
                                                    <th>Order Type</th> 
                                                    <th>Designer</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                    
                                                
                                                    <th></th>
                                                </tr>
                                   </thead>
           


  <?php  
                   if(count($DigiQuote) > 0) {
                      foreach ($DigiQuote as $OrderData) {
                   ?>

                                              <tr class="newclass<?php echo $OrderData->Status ?> new<?php echo $OrderData->IsRead ?> font<?php echo $OrderData->IsRead ?> <?php if($OrderData->OrderStatus == 2 && $OrderData->Status != 7){ echo "backcolor2"; } ?>"> 


                                                  <td>{{ $OrderData->OrderID }}</td>
                                                  <td>{{ $OrderData->DesignName }}</td>
                                                  <td>{{ $OrderTypes[$OrderData->OrderType] }}</td>
                                                  <td>{{ $OrderData->DesignerName }}</td>
                                                  <td>{{ $OrderStatuses[$OrderData->Status] }}</td>
                                                  <td> {{date('d-M-Y h:i:s:A', strtotime($OrderData->DateAdded))}}</td>
                                                  <td>
                                                    <Button class="btn btn-primary" onclick="location.href='{{ url('/admin/Norder-details/'.$OrderData->OrderID) }}'"> Detail</Button>
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




  <!-- VECTOR ORDER -->

  <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>VECTOR ORDER</strong></h3>
                                      
                                    </div>
                                    <div class="box-body table-responsive">
                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                        

                                  <thead>
                                               <tr>
                                                    <th>Order #</th>
                                                    <th>Design Name</th>
                                                    <th>Order Type</th> 
                                                    <th>Designer</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                    
                                                
                                                    <th></th>
                                                </tr>
                                   </thead>
            


  <?php  
                   if(count($VectorOrders) > 0) {
                      foreach ($VectorOrders as $OrderData) {
                   ?>

                                            <tr class="newclass<?php echo $OrderData->Status ?> new<?php echo $OrderData->IsRead ?> font<?php echo $OrderData->IsRead ?> <?php if($OrderData->OrderStatus == 2 && $OrderData->Status != 7 && $OrderData->IsRead == 4){ echo "backcolorwithfont2"; }elseif($OrderData->OrderStatus == 2 && $OrderData->Status != 7){ echo "backcolor2"; }   ?>"> 
                                                
                                                
                                          
                                                   
                                                   
                                                  <td>{{ $OrderData->VectorOrderID }}</td>
                                                  <td>{{ $OrderData->DesignName }}</td>
                                                 <td>{{ $OrderTypes[$OrderData->OrderType] }}</td>
                                                  <td>{{ $OrderData->DesignerName }}</td>
                                                  <td>{{ $OrderStatuses[$OrderData->Status] }}</td>
                                                   <td> {{date('d-M-Y h:i:s:A', strtotime($OrderData->DateAdded))}}</td>
                                                  <td>
                                                    <Button class="btn btn-primary" onclick="location.href='{{ url('/admin/Vec_order-details/'.$OrderData->VectorOrderID) }}'"> Detail</Button>
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


    
    


  <!-- VECTOR QUOTES -->

  <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>VECTOR QUOTE</strong></h3>
                                      
                                    </div>
                                    <div class="box-body table-responsive">
                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                        

                                  <thead>
                                               <tr>
                                                    <th>Quote #</th>
                                                    <th>Design Name</th>
                                                    <th>Order Type</th> 
                                                    <th>Designer</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                    
                                                
                                                    <th></th>
                                                </tr>
                                   </thead>
            


  <?php  
                   if(count($VectorQuote) > 0) {
                      foreach ($VectorQuote as $OrderData) {
                   ?>

                                            <tr class="newclass<?php echo $OrderData->Status ?> new<?php echo $OrderData->IsRead ?> font<?php echo $OrderData->IsRead ?> <?php if($OrderData->OrderStatus == 2 && $OrderData->Status != 7 && $OrderData->IsRead == 4){ echo "backcolorwithfont2"; }elseif($OrderData->OrderStatus == 2 && $OrderData->Status != 7){ echo "backcolor2"; }   ?>"> 
                                                
                                                
                                          
                                                   
                                                   
                                                  <td>{{ $OrderData->VectorOrderID }}</td>
                                                  <td>{{ $OrderData->DesignName }}</td>
                                                  <td>{{ $OrderTypes[$OrderData->OrderType] }}</td>
                                                  <td>{{ $OrderData->DesignerName }}</td>
                                                  <td>{{ $OrderStatuses[$OrderData->Status] }}</td>
                                                   <td> {{date('d-M-Y h:i:s:A', strtotime($OrderData->DateAdded))}}</td>
                                                  <td>
                                                    <Button class="btn btn-primary" onclick="location.href='{{ url('/admin/Vec_order-details/'.$OrderData->VectorOrderID) }}'"> Detail</Button>
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

        </script>
    </body>
</html>
