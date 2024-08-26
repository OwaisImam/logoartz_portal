<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Customers</title>
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

        <link rel="stylesheet" href="{{ asset('assets/web/css') }}/commentbox.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/iCheck/minimal/blue.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .alert{
                opacity: 0.5;
            }
            .m-l-250{
                max-height: 250px;
                overflow-y: auto;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            @include('salesperson/includes/header')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container">

 <div class="box-body"  style="font-size: 14px; background-color: white">
            <div class="row">
              <div class="box-header with-border" style="text-align: center">
                 <h3 class="" style="text-align: center;">Customer Details</h3>
              
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
                                            <label>Price Plane</label>
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











                    </div>














   <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $totalvectors }}</h3>

              <p>Total Vector Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('salesperson/vector_orders/'.$customers_ID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{  $totaldigis }}</h3>

              <p>Total Digitizing Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url('salesperson/digitizing_orders/'.$customers_ID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $digiInprocess }}</h3>

              <p>Digitizing Inprocees Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('salesperson/digitizing_orders/current_order/'.$customers_ID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $vectorInprocess }}</h3>

              <p>Vector Inprocees Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('salesperson/vector_orders/current_order/'.$customers_ID) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

                    <section class="content">


                  <div class="row">
                            

        <div class="col-md-12">
          
          <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Customer Notes</h3>

            {!! Form::open(['url' => 'salesperson/addcustomer_note/'.$customers_ID]) !!}
                <div class="box-body"> 
                  <div class="direct-chat-messages">


                    <?php   
                     if(count($Notes) > 0 )
                    {
                        foreach($Notes as $note) {

?>
                 <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix"> 
                        <span class="direct-chat-timestamp pull-right"> {{ $note->DateAdded }}  </span>
                      </div>  
                      <div class="direct-chat-text">
                       {{ $note->Message }}
                      </div>                   
                    </div>
<?php
                    }
                  }        
                    ?>



                  </div>
                </div>


                <!-- /.box-body -->
                <div class="box-footer">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Type Note ..." class="form-control">
                      <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">Add Note</button>
                          </span>
                    </div>
                  </form>
                  {{ Form::close() }}
                </div>
                <!-- /.box-footer-->
              </div>

                 
            


         </div>

                    
                    </section>

                       
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

        </script>
    </body>
</html>
