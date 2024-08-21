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



.th{
  border-color: #fff; border-style: solid; border-width: 3px; text-align: center;
}

.td{
    
border-color: #fff; border-style: solid; border-width: 3px; text-align: center;
}


</style>


    </head>


    <body class="inner body-innerwrapper" style="font-size: 24px; margin-left: 5%; margin-top: 5%; margin-right: 5%">

       <div >
              
                <div class="row">
                    <div class="col-md-6">
                      
                    <img src="{{ public_path('') }}/logovec.png" alt="LogoArtz" width="200" style="margin-top: 20px">
                                  
                     
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="col-sm-10 text-center breadcrumb-block pull-right"  style="margin-left: 130px">
                            <ol class="breadcrumb"  style="margin-top: 20px; background-color:#bdbec0; height: 90px; width: 300px; border-bottom:#ED1C24; border-bottom-style: solid; border-color: #e6e4e4; border-width: 15px">
                                <h1 style="margin-top: 0px; font-size: 90px; font-weight: bold; font-family: Lucida Bright; color: white">Invoice</h1>
                            </ol>
                        </div>
                    </div>
                    
                    <!-- Times New Roman -->
                </div>
<!--                <div class="pull-right" style="width: 400; height: 200; background-color: gray">


                </div>-->
                <br>
                 <div class="col-sm-4 invoice-col left"  style="margin-top: 10px;  font-size: 17px;">
                      <b style="font-weight: bold;">TO: {{ $Customer->CustomerName }} </b>
                       
                        <p>
                           {{ $Customer->Email }} <br>
                           {{ $Customer->Address }} <br>
                           Phone:{{ $Customer->Cell }}<br>
                       
                        </p>
                    </div>


         <div class="row invoice-info">
                   
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col left"  style="font-size: 16px;">
                     
                    </div>
                    <div class="col-sm-4 invoice-col ">
                        
                    </div>

                    <!-- /.col -->
                    <div class="col-sm-4 mx-auto invoice-col" style="font-size: 16px;">
                
                    
                    <p style="margin-right: 25%; text-align: right;"><b></b>
                        <strong >Invoice Date:</strong><br> 
                         <?php echo date('j M Y', strtotime($todaydate));  ?> <br><br>

                        <strong>Due Date:</strong><br>
                       <?php echo date('j M Y', strtotime($Duedate));  ?><br> <br>

                         <strong >Invoice Number:</strong><br>
                        {{ $invoice_number }}  <br><br>
                    </p>
                   </div>
                    <!-- /.col -->
                </div>

        

            <section class="invoice" style="margin-top: 0px">

                      <p style="font-size: 22px"><b><u>{{$periodline}}</u></b></p> 
                <?php  $count = 1; ?>

                <!-- Table row -->
                <div class="row" style="margin-top: 2%; font-size: 18px">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped auto-index">
                            <thead>
                                <tr style="background-color: #bfbfbf; color: white">
                                    <th class="th">S.No</th>
                                 <!--    <th class="th">Order No</th> -->
                                    <th class="th">Description</th>
                                    <th class="th">Cetagory</th>
                                    <th class="th">Order Date</th>
                                    <th class="th">Quantity</th>
                                    <th class="th">Unit Price</th>
                                    <th class="th">Discount</th>
                                    <th class="th" style="text-align: center;">$ Amount</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (!empty($digiOrders)) {

                                    foreach ($digiOrders as $digi) {
                                        ?>

                                        <tr style="font-size: 16px; background-color: #f2f2f2">

                                            <td class="td">{{ $count }}</td>
                                     <!--        <td class="td">{{ $digi['orId'] }}</td> -->
                                            <td class="td" style="text-align: left;">{{ $digi['orName'] }}</td>
                                            <td class="td">Digitizing</td>
                                            <td class="td" style="font-size: 15px"><?php echo date('j M Y', strtotime($digi['orDate'])); ?></td>
                                            <td class="td">{{ $digi['orQty'] }}</span></td> 
                                            <td class="td">{{ $digi['orUnitPrice'] }}</span></td> 
                                            <td class="td">{{ $digi['orDiscount'] }}</span></td> 
                                            <td class="td" style="background-color: #bdbec0; text-align: center; color: white;"><b>{{ $digi['orTotal'] }}</b></td> 
                                        </tr>

                                        <?php
                                  $count++;   }
                               }
                                ?>


                                <?php
                                if (!empty($vecOrders)) {

                                    foreach ($vecOrders as $vector) {
                                        ?>

                                        <tr style="font-size: 16px; background-color: #f2f2f2">
                                            <td class="td">{{ $count }}</td>
                                   <!--          <td class="td">{{ $vector['orId'] }}</td> -->
                                            <td class="td" style="text-align: left;">{{ $vector['orName'] }}</td>
                                            <td class="td">Vector</td>
                                            <td class="td"><?php echo date('j M Y', strtotime($vector['orDate'])); ?></td>
                                            <td class="td">{{ $vector['orQty'] }}</span></td> 
                                            <td class="td">{{ $vector['orUnitPrice'] }}</span></td> 
                                            <td class="td">{{ $vector['orDiscount'] }}</span></td> 
                                            <td class="td" style="background-color: #bdbec0; text-align: center; color: white;"><b>{{ $vector['orTotal'] }}</b></td> 
                                        </tr>
                                        <!-- <span class="badge bg-red" style="font-size: 16px"> -->

                                        <?php
                                 $count++; }
                                }
                                ?>



                            </tbody>
                                <tfoot>
                                    <tr style="text-align: center;">
                                     <td></td>
                                      <td style="text-align: left;"><b>TOTAL</b></td>  
                                      <td></td>
                                      <td></td>  
                  
                                      <td class="td" style="background-color: #bdbec0; color: red"><b>{{ $totalQuantity }}</b></td> 
                                      <td></td>
                                      <td class="td" style="background-color: #bdbec0; color: red"><b>{{ $Discount }}</b></td>
                                      <td class="td" style="background-color: #bdbec0; color: red"><b>${{ $TotalPrice }}</b></td>
                                    
                                    </tr>
                                 </tfoot>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                     </section>
            
                  

                
                      
                 
                <div class="row" style="margin-top: 20px">
                    <!-- accepted payments column -->
                   <div class="col-xs-12" style="margin-left: 10px">
                       
                     <h3 style="color: #3d00f9; font-size: 24px; font-weight: bold;"><a href="{{ $Pay_URL }}" target="_blank"><u>PLEASE CLICK HERE TO MAKE YOUR PAYMENT</u></a></h3>

                     <p  style="margin-top: 10px; color: red; font-size: 18px;">
                            Note: If you have any issues in reference to the invoice, Please do not hesitate to give a call or email us.

                        </p>

                         <h3>WE APPRECIATE YOUR BUSINESS, THANKS FOR CHOOSING LOGO ARTZ!</h3>



                       <div class="clearfix"></div><br>

                       
                  
                         

                   </div>
                </div>

           
                     <footer class="row" style="margin-left: 10px; padding-bottom: 0px; margin-bottom: 0px; background-color:#BFBFBF; border-top: 10px; border-color:#D9D9D9; border-style: solid;">
                          <div class="col-sm-12 text-center breadcrumb-block " style="text-align:left; color: white">
                         <h1 style="margin-bottom: 5px; font-size: 30px; font-weight: bold;"><b>LOGO ARTZ</b> </h1> 
                         <p style="font-size: 20px"><b>917-310-3789 | info@logoartz.com | www.logoartz.com</b></p>
                        
                             </div>
                          
                        </footer>

   

    <!--footer-->
    <!--All Js-->

  </div>
</body>

</html>
