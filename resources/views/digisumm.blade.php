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
        <title>{{ $configuration->WebsiteTitle }}</title>
        <meta name="keywords" content="Logo Artz">
        <meta name="description" content="Logo Artz Vectar and Digitizing">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
          <link rel="icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/icofont.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/hover-min.css" media="screen">
        <!--Owl Carousel-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.carousel.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.theme.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.transitions.css" media="screen">
        <!--Portfolio-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/spsimpleportfolio.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/featherlight.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/style.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/responsive.css" media="screen">

        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/datatables/dataTables.bootstrap.css">
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

    </head>

    <body class="body-innerwrapper">
        <!--Pre loader-->

        @include('includes/header')

        <!--Banner-->
        



 <section id="breadcrumb" class="two green-color">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                  

<?php
                    if (\Session::has('CustomerLogin')) {

                        $CustomerName = Session::get('CustomerName');

                        ?>


                    <h3>Welcome, {{ $CustomerName }}</h3>

                              <?php  } ?>
                    <ol class="breadcrumb">
                           <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                        <li>
                            <a href="{{ url('/CustomerDash')}}">Home</a>
                        </li>
                    <?php }else{ ?>

                           <li>
                            <a href="{{ url('/')}}">Home</a>
                        </li>
                    <?php } ?>
                 

                        <li class="active">Welcome,  </li>


                    </ol>
                </div>
            </div>
        </div>
    </section>





<section id="single-services" class="space one">
    <div class="container">
        <center><h2>{{$headingg}}</h2></center>
            <Section>
                
            <section class="content">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <center>

                    </center>
                    <thead>
                     <tr>
                        <th>Order #</th>
                        <th>Design</th>
                        <th>Type</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Order Details</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(!empty($allrecords))
                            @foreach($allrecords as $order)
                            <tr class="{{$order->IsRead == 2 ? 'new' : ''}}">
                                 <td>{{$order->OrderID}}</td>
                                  <td>{{$order->DesignName}}</td>
                                  <td>{{$types[$order->OrderType]}}</td>
                                  <td>{{$statuses[$order->Status]}}</td>
                                     <td>{{date('d-m-Y', strtotime($order->DateAdded))}} </td>
                               <!--    <td>{{$order->OrderID}}</td>
                                  <td>{{$order->DesignName}}</td>
                                  <td>{{$order->DateAdded}}</td>
                                  <td>{{$types[$order->OrderType]}}</td> -->
                                  
                                   <td><button type="button" class="btn btn-default btn-flat btn-sm" onclick="location.href='{{ url('') }}/digi_approval/{{$order->OrderID}}'">Details</button></td>
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
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/jQuery.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/bootstrap.js"></script>
    <!--<script src="../../../../use.fontawesome.com/e18447245b.js"></script>-->
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/appear.js"></script>
    <!--Portfolio-->
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/isotope.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/spsimpleportfolio.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/featherlight.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/jquery.shuffle.modernizr.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/steller.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/smooth-scroll.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/owl.carousel.js"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/custom.js"></script>
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
            $('#example').DataTable({

                "ordering": false
            });
            
        } );
        
          
    </script>
    @include('includes/commonscripts')
</body>
</html>
