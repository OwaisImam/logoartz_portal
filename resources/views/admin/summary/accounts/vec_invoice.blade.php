<!doctype html>
<html lang="en" class="demo-2 no-js">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/icofont.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/hover-min.css" media="screen">


    </head>


     <body class="inner body-innerwrapper" style="font-size: 18px">

        <!--Header-->





        <!--Bread Crumb-->
        <section id="breadcrumb" class="two green-color">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 text-center breadcrumb-block">
                      
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                         <img src="{{ asset('assets/admin') }}/dist/img/logo-v1.png') }}" width="200" height="100">
                    </div>
                    <div class="col-md-8 pull-right">
                          <div class="col-sm-12 text-center breadcrumb-block pull-right">
                        <ol class="breadcrumb"  style="border-bottom: solid; border-color: #e6e4e4; border-width: 10px">
                            <h1 style="font-size: 60px; font-family: Times New Roman">Invoices</h1>
                        </ol>
                    </div>
                    </div>
                    

                </div>




                </div>

            </div>
        </section>
        <!--Services-->





        <div class="container">
            <section class="invoice">
                <!-- title row -->

                <!-- info row -->
                <div class="row invoice-info">
                   
                    <div class="col-sm-4 invoice-col" >
                      <strong>TO:</strong>
                        <p>
                            <strong><h3>{{ $Customer->CustomerName }}</h3></strong>
                           <strong>Address: </strong>{{ $Customer->Address }} <br>
                           <strong>Phone: </strong>{{ $Customer->Cell }}<br>
                           <strong>Email: </strong> {{ $Customer->Email }}
                        </p>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        
                    </div>

                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col pull-right">
                        <b>Invoice #007612</b><br>
                        <br>
                      
                           <strong>Invoice Date:</strong> {{ $todaydate }}<br>
                           <strong>Due Date:</strong> {{ $Duedate }}<br></p>
                    </div>

           
                </div>
                <!-- /.row -->

                <br><br><br><br>

                <!-- Table row -->
                <div class="row" style="margin-top: 40px">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order#</th>
                                    <th>Design Name</th>
                                    <th>Cetagory</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (!empty($Orders)) {

                                    foreach ($Orders as $vector) {
                                        ?>

                                        <tr>
                                            <td>{{ $vector->VectorOrderID }}</td>
                                            <td>{{ $vector->DesignName }}</td>
                                            <td>{{ $type }}</td>
                                            <td>{{ $vector->DateAdded }}</td>
                                            <td><span class="badge bg-red" style="font-size: 16px">${{ $vector->Price }}</span></td> 
                                        </tr>

                                        <?php
                                    }
                                }
                                ?>


                



                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                  <br><br><br><br>

                <div class="row" style="margin-top: 20px">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Payment Methods:</p>
                      <img src="{{ asset('assets/admin') }}/dist/img/credit/visa.png" alt="Visa">
                        <img src="{{ asset('assets/admin') }}/dist/img/credit/mastercard.png" alt="Mastercard">
                        <img src="{{ asset('assets/admin') }}/dist/img/credit/paypal2.png" alt="Paypal">


                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; color: red">
                            Note: If you have any issues in reference to the invoice, Please do not hesitate to give a call or email us.

                        </p>
                    </div>
                    <!-- /.col -->
                     <div class="col-xs-6">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td><span style="font-size: 16px "> ${{ $TotalPrice }}</span></td>
                                </tr>

                                <tr>s
                                    <th>Total:</th>
                                    <td><span class="badge bg-red" style="font-size: 18px">${{ $TotalPrice }} </span></td> 
                                </tr>
                            </table>
                        
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </section>

              <br><br>

       
            <h3>WE APPRECIATE YOUR BUSINESS, THANKS FOR CHOOSING LOGO ARTZ!</h3>

            {!! Form::open(['url' => 'admin/send-vec-invoice']) !!}
            <div class="row">
                <?php
                if (isset($OrderIDs) && count($OrderIDs) > 0) {
                    foreach ($OrderIDs as $orderd) {
                        ?>                    
                        {!! Form::hidden('orderids[]', $orderd, []) !!}
                        <?php
                    }
                }
                ?>
                {!! Form::hidden('CustomerID', $CustomerID, []) !!} 
                <?php
                if (isset($OrderIDs)) {
                    ?> 
                    <div class="col-md-2">
                        <button type="submit" style="margin-top: 24px;" class="btn btn-primary btn-flat form-control"><i class="fa fa-send"></i> Send</button>
                    </div>
                    <?php
                }
                ?>
            </div>

            {!! Form::close() !!}



            <div class="clearfix"></div>
        </div>





    </div>

    <!--footer-->


    <!--Copyright-->

    <!--All Js-->

</body>



</html>
