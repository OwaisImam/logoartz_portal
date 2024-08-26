<?php
    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $page = end($link_array);
?>
<!DOCTYPE html>

<html lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} Accounts Summary</title>
        <meta name="keywords" content="Logo Artz">
        <meta name="description" content="Logo Artz Vectar and Digitizing">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
          <link rel="icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/bootstrap.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/font-awesome.min.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/icofont.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/hover-min.css') }}" media="screen">
        <!--Owl Carousel-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.carousel.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.theme.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.transitions.css') }}" media="screen">
        <!--Portfolio-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/spsimpleportfolio.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/featherlight.min.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/style.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/responsive.css') }}" media="screen">
        <!-- Date Picker-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/bootstrap-datepicker.min.css') }}" media="screen">

        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/_all-skins.min.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}">
         <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style>
            .btn-block{
                background: radial-gradient(#fff, #ccc);
                color: black;
                border: none !important;
            }
            .order{
                padding: 10px;
                padding: 42px;
                margin: 22px;
                border: 2px solid #5ec282;
            }
            .my-log{
                position: absolute;
                top: -39px;
                background: #fff;
            }
            .new{
                background: #8d181838 !important;
                font-weight: 700;
            }
        </style>
         <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>

    </head>

    <body class="body-innerwrapper">
        <!--Pre loader-->

        @include('includes/header')

        <!--Banner-->
        



 <section id="breadcrumb" class="two green-color">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                  
            <h3>Accounts</h3>
                    <ol class="breadcrumb">

                           <li>
                            <a href="{{ url('/')}}">Home</a>
                        </li>
                 

                        <li class="active">Accounts,  </li>


                    </ol>
                </div>
            </div>
        </div>
    </section>





<section id="single-services" class="space one">
    <div class="container">
        <center><h2>Accounts Summary</h2></center>
                 {{ Form::open(['method'=>'post', 'url'=>'/accounts_summary', 'files'=>'true', 'novalidate'=>'novalidate']) }}

                   @include('includes/front_alerts')
        <section style="padding-bottom: 50px;">
                        <div class="row">
                           
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="from">From:</label>
                                <input type="date" class="form-control pull-right" name="from" required>
                            </div>


                             <div class="col-md-3 col-sm-6 col-xs-12">
                                <label for="to">TO:</label>
                                <input type="date" name="to" class="form-control pull-right" required>
                            </div>
                            


                            <div class="col-md-3 col-sm-6 col-xs-12">
                            
                                <label for="cetagory">Type:</label>
                                 <select name="order_type" class="form-control" required>
                                 <option class="form-control" value="">Select</option>
                                 <option class="form-control" value="1">Digitizing</option>
                                 <option class="form-control" value="2">Vector</option>
                            
                                </select>

                            </div>

                            
                           <div class="col-md-3 col-sm-6 col-xs-12">

                                 <button type="submit" class="btn orange-btn" style="margin-top: 12%">Search</button>
                         
                           </div>

                             {!! Form::close() !!}
                   
                   </div>

       </section>
            <Section>
                
            <section class="content">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <center>

                    </center>
                    <thead>
                      <tr>
                        <th>Order# </th>
                        <th>PO Number</th>
                        <th>Design Name</th>
                        <th>Cetagory</th>
                        <th>Order Date</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(!empty($DigiOrders))
                            @foreach($DigiOrders as $digitizing)
                            <tr >
                                      <td>{{ $digitizing->OrderID }}</td>
                                      <td>{{ $digitizing->PONumber }}</td>
                                      <td>{{ $digitizing->DesignName }}</td>
                                      <td> Digitizing </td>
                                      <td>{{ $OrderTypes[$digitizing->OrderType] }}</td>
                                      <td>${{ $digitizing->Price }}</td>
                           </td>
                                </tr>
                            @endforeach
                        @endif


                        @if(!empty($VecOrders))
                            @foreach($VecOrders as $vector)
                            <tr >
                                      <td>{{ $vector->VectorOrderID }}</td>
                                      <td>{{ $vector->PONumber }}</td>
                                      <td>{{ $vector->DesignName }}</td>
                                      <td> Vector </td>
                                      <td>{{ $OrderTypes[$vector->OrderType] }}</td>
                                      <td>${{ $vector->Price }}</td>
                           </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
            </Section>







        

    


    </div>
</section>




    @include('includes/footer')
    <!--footer-->

    <!--All Js-->
    <script type="text/javascript" src="{{ asset('assets/web/js/jQuery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/jquery.easing.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/bootstrap.js') }}"></script>
    <!--<script src="../../../../use.fontawesome.com/e18447245b.js"></script>-->
    <script type="text/javascript" src="{{ asset('assets/web/js/appear.js') }}"></script>
    <!--Portfolio-->
    <script type="text/javascript" src="{{ asset('assets/web/js/isotope.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/spsimpleportfolio.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/featherlight.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/jquery.shuffle.modernizr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/steller.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/smooth-scroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/web/js/custom.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script>
        if(performance.navigation.type == 2){
            location.reload(true);
         }
         $('#status').change(function(){
            location.href=$(this).val();
         });
         
        $(document).ready(function() {
            $('#example').DataTable();
            
        } );
    </script>
    @include('includes/commonscripts')
</body>
</html>
