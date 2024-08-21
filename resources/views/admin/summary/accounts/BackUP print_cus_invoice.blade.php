<!doctype html>
<html lang="en" class="demo-2 no-js">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/icofont.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/hover-min.css" media="screen">

 <style type="text/css">
/*.auto-index td:first-child:before
{
  counter-increment: Serial;       Increment the Serial counter 
  content:  counter(Serial); /* Display the counter */
/*} */
/*body
{
    counter-reset: Serial;           /* Set the Serial counter to 0 */
/*}*/

/*table
{
    border-collapse: separate;
}*/

</style>


    </head>


    <body class="inner body-innerwrapper" style="font-size: 24px">

       <div >
              
                <div class="row">
                    <div class="col-md-6">
                      
                    <img src="{{ public_path('') }}/logo.png" alt="LogoArtz" width="300" style="margin-top: 20px">
                                  
                     
                    </div>
                    <div class="col-md-6 mx-auto" style="margin-left: 0px">
                           <div class="col-sm-12 text-center breadcrumb-block pull-right">
                        <ol class="breadcrumb"  style="border-top:#ED1C24; border-bottom:#ED1C24;border-style: solid; background-color:#bdbec0;border-bottom: solid; border-color: #e6e4e4; border-width: 10px">
                            <h1 style="font-size: 80px; font-family: Times New Roman; font-weight: 50px; color: white">Invoice</h1>
                        </ol>
                    </div>
                    </div>
                    

                </div>
<!--                <div class="pull-right" style="width: 400; height: 200; background-color: gray">


                </div>-->

           
      


         <div class="row invoice-info">
                   
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col left">
                      <strong>TO:</strong>
                        <p>
                            <strong><h3>{{ $Customer->CustomerName }}</h3></strong>
                           <strong>Address: </strong>{{ $Customer->Address }} <br>
                           <strong>Phone: </strong>{{ $Customer->Cell }}<br>
                           <strong>Email: </strong> {{ $Customer->Email }}
                        </p>
                    </div>
                    <div class="col-sm-4 invoice-col ">
                        
                    </div>

                    <!-- /.col -->


                    <div class="col-sm-4 mx-auto invoice-col" style="margin-left: 15%">
                        <p ><b>Invoice#</b><br>
                          {{ $invoice_number }}
                        <br><br>
                       
                      
                         <strong >Invoice Date:</strong><br> {{ $todaydate }}<br><br>
                        <strong>Due Date:</strong><br> {{ $Duedate }}<br></p>
                   </div>


                     



                    <!-- /.col -->
                </div>

    
            <section class="invoice">


                <br><br><br>

                     <p style="font-size: 24px"><b><u>{{$periodline}}</u></b></p>


                <!-- Table row -->
                <div class="row" style="margin-top: 40px; font-size: 24px">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped auto-index">
                            <thead>
                                <tr style="background-color: #bdbec0; color: white">
                                    <th>S.No</th>
                                    <th>Order#</th>
                                    <th>Description</th>
                                    <th>Cetagory</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (!empty($DigiOrders)) {

                                    foreach ($DigiOrders as $digi) {
                                        ?>

                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $digi->OrderID }}</td>
                                            <td>{{ $digi->DesignName }}</td>
                                            <td>Digitizing</td>
                                            <td><?php echo date('d-m-Y', strtotime($digi->DateAdded)); ?></td>
                                            <td><span class="badge bg-red" style="font-size: 22px">${{ $digi->Price }}</span></td> 
                                        </tr>

                                        <?php
                                  $count++;   }
                               }
                                ?>


                                <?php
                                if (!empty($VecOrders)) {

                                    foreach ($VecOrders as $vector) {
                                        ?>

                                        <tr >
                                              <td>{{ $count }}</td>
                                            <td>{{ $vector->VectorOrderID }}</td>
                                            <td>{{ $vector->DesignName }}</td>
                                            <td>Vector</td>
                                            <td><?php echo date('d-m-Y', strtotime($vector->DateAdded)); ?></td>
                                            <td><span class="badge bg-red" style="font-size: 22px">${{ $vector->Price }}</span></td>
                                        </tr>

                                        <?php
                                 $count++; }
                                }
                                ?>



                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                    <br><br>

                <div class="row" style="margin-top: 20px">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Payment Methods:</p>
                         <img src="{{ public_path('') }}/credit/visa.png" alt="Visa">
                        <img src="{{ public_path('') }}/credit/mastercard.png" alt="Mastercard">
                        <img src="{{ public_path('') }}/credit/paypal2.png" alt="Paypal">

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; color: red">
                            Note: If you have any issues in reference to the invoice, Please do not hesitate to give a call or email us.

                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6" >
                            <table class="table" style="font-size: 24px">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td><span > ${{ $Sub_Total }}</span></td>
                                </tr>

                                
                            <?php 
                                if(!empty($Discount)){

                            ?>
                                <tr>
                                    <th >Discount:</th>
                                    <td>
                                        <span style="font-size: 24px"> ${{ $Discount }}</span>
                                    </td>
                                </tr>


                                <?php  
                                    }     
                                 ?>

                                <tr>
                                    <th>Total:</th>
                                    <td><span class="badge bg-red" style="font-size: 24px">${{ $TotalPrice }} </span></td> 
                                </tr>
                            </table>
                        
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>

              <h3 style="color: blue"><a href="{{ $Pay_URL }}">CLICK HERE TO MAKE YOUR PAYMENT</a></h3>

                <br>

      
       
             <h3>WE APPRECIATE YOUR BUSINESS, THANKS FOR CHOOSING LOGO ARTZ!</h3>

            <div class="clearfix"></div>
      

           <footer class="row" style="padding-bottom: 0px; margin-bottom: 0px; background-color:#BFBFBF; border-top: 25px; border-color:#D9D9D9; border-style: solid;">
                          <div class="col-sm-12 text-center breadcrumb-block " style="text-align:left; color: white">
                         <h1><b>LOGO ARTZ</b> </h1> <br>
                         <p style="font-size: 20px"><b>917-310-3789 | info@logoartz.com | www.logoartz.com</b></p>
                        
                    </div>
                    <br><br>
            </footer>



    <!--footer-->
    <!--All Js-->

  </div>
</body>

</html>
