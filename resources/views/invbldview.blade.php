<!doctype html>
<html lang="en" class="demo-2 no-js">
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Digitizing Order</title>
        <meta name="keywords" content="Logo Artz">
        <meta name="description" content="Logo Artz">
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


        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/dist/css/AdminLTE.min 2.3.0.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/dist/css/AdminLTE.min.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/dist/css/AdminLTE.css') }}" media="screen"> 
        


    </head>
    

<body class="inner body-innerwrapper">
   
    <!--Header-->
    

      @include('includes/header')





    <!--Bread Crumb-->
    <section id="breadcrumb" class="two green-color">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                    <h3>ORDERS</h3>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">Invoices</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Services-->
  


                          
    <div class="container" style="padding:2em;">
               <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> LogoArtz .
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <p>
            <strong>Logo Artz.</strong><br>
            ARTS AND DIGITIZING <br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@logoartz.com
          </p>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <p>
            <strong>{{ $customerdetail->CustomerName }}</strong><br>
                    {{ $customerdetail->Address }} <br>
            Phone: {{ $customerdetail->Cell }}<br>
            Email: {{ $customerdetail->Email }}
          </p>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <p>Order ID: 4F3S8J<br>
            Payment Due: 2/22/2014<br>
            Account: <strong>20</strong><br></p>
           <a>Pay Now</a>  
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row" style="margin-top: 40px">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Order#</th>
              <th>Design Name</th>
              <th>Order Date</th>
              <th>Type</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
        
        <?php     
            if(!empty($DigiOdersData)){

                foreach ($DigiOdersData as $digi) {
                    
        ?>

            <tr>
              <td>{{ $digi->OrderID }}</td>
              <td>{{ $digi->DesignName }}</td>
              <td>{{ $digi->DateAdded }}</td>
              <td>Digitizing</td>
              <td><span class="badge bg-red" style="font-size: 16px">${{ $digi->Price }}</span></td> 
              <td><button type="button" class="btn orange-btn" onclick="">Invoice</button></td>
            </tr>

        <?php   } } ?>


          <?php     
            if(!empty($VectorOdersData)){

                foreach ($VectorOdersData as $vector) {
                    
        ?>

            <tr>
              <td>{{ $vector->VectorOrderID }}</td>
              <td>{{ $vector->DesignName }}</td>
              <td>{{ $vector->DateAdded }}</td>
              <td>Vector</td>
              <td><span class="badge bg-red" style="font-size: 16px">{{ $vector->Price }}</span></td>
             <td><button type="button" class="btn orange-btn" onclick="">Invoice</button></td>
            </tr>

        <?php   } } ?>



            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row" style="margin-top: 20px">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <img src="{{ asset('assets/admin') }}/dist/img/credit/visa.png" alt="Visa">
          <img src="{{ asset('assets/admin') }}/dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="{{ asset('assets/admin') }}/dist/img/credit/american-express.png" alt="American Express">
          <img src="{{ asset('assets/admin') }}/dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Any Note For Customer .
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Due 2/22/2014</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$250.30</td>
              </tr>
        
              <tr>
                <th>Total:</th>
                <td>$265.24</td> 
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="{{ url('/genrate/pdfmaininv') }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>Pay Now
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
 



    <div class="clearfix"></div>
  </div>





                     </div>

    <!--footer-->
   
  @include('includes/footer')

        <!--Copyright-->
    
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
    </body>
    
    </body>
    
    
    <!-- Mirrored from themesfoundry.net/demo/html/six/home-digital-marketing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 12:57:13 GMT -->
    </html>
    