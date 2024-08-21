<!doctype html>
<html lang="en" class="demo-2 no-js">
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/icofont.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/hover-min.css" media="screen">
        

    </head>
    

<body class="inner body-innerwrapper">
   
    <!--Header-->
  


    <!--Bread Crumb-->
    <section id="breadcrumb" class="two green-color">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                    <h3>INVOICES DETAIL</h3>
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
        
              <tr>s
                <th>Total:</th>
                <td>$265.24</td> 
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    
    </section>
  
  <h5>WE APPRECIATE YOUR BUSINESS, THANKS FOR CHOOSING LOGO ARTZ!</h5>



    <div class="clearfix"></div>
  </div>





                     </div>

    <!--footer-->
   

        <!--Copyright-->
    
        <!--All Js-->
     
    </body>
  
    
   
    </html>
    