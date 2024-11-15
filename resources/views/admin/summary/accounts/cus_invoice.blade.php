<!doctype html>
<html lang="en" class="demo-2 no-js">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Create Invoice </title>
    <link rel="icon" href="{{ asset('assets/web/images/favicon.png') }}" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/bootstrap.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/font-awesome.min.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/icofont.css') }}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/hover-min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/_all-skins.min.css') }}">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <style>
        .tabd {

            border-style: solid;
            border-color: #000;
            border-width: 2px;

        }


        .auto-index td:first-child:before {
            counter-increment: Serial;
            /* Increment the Serial counter */
            content: counter(Serial);
            /* Display the counter */
        }

        body {
            counter-reset: Serial;
            /* Set the Serial counter to 0 */
        }

        table {
            border-collapse: separate;
        }

        .th {
            border-color: #fff;
            border-style: solid;
            border-width: 2px;
            text-align: center;
        }

        .td {

            border-color: #fff;
            border-style: solid;
            border-width: 2px;
            text-align: center;
        }
    </style>

</head>



<body class="inner body-innerwrapper" style="font-size: 18px">

    <!--Header-->



    <!--Bread Crumb-->
    <section id="breadcrumb" class="two green-color">
        <div class="container ">
            <div class="row">

            </div>

            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('logo.png') }}" width="300" height="100" style="margin-top: 20px">
                </div>
                <div class="col-md-6 pull-right mx-auto" style="margin-left: 0px;">
                    <div class="col-sm-12 text-center breadcrumb-block pull-right" st>
                        <ol class="breadcrumb"
                            style="border-top:#ED1C24; border-bottom:#ED1C24;border-style: solid; background-color:#bdbec0;border-bottom: solid; border-color: #e6e4e4; border-width: 10px">
                            <h1 style="font-size: 80px; font-family: Times New Roman; font-weight: 50px; color: white">
                                Invoice</h1>
                        </ol>
                    </div>
                </div>


            </div>
            <!--                <div class="pull-right" style="width: 400; height: 200; background-color: gray">


                </div>-->

        </div>
    </section>
    <!--Services-->





    <div class="container" style="padding:2em;">
        <section class="invoice">
            <!-- title row -->

            <!-- info row -->
            <div class="row invoice-info">

                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <strong>TO:</strong>
                    <p>
                        <strong>
                            <h3>{{ $Customer->CustomerName }}</h3>
                        </strong>
                        <strong>Address: </strong>{{ $Customer->Address }} <br>
                        <strong>Phone: </strong>{{ $Customer->Cell }}<br>
                        <strong>Email: </strong> {{ $Customer->Email }}
                    </p>
                </div>
                <div class="col-sm-4 invoice-col ">

                </div>
                {!! Form::open(['url' => 'admin/send-cus-invoice']) !!}
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <p style="text-align: right;"><b>Invoice#</b><br>
                        <input type="text" value="LA-07-00000" name="invoice_number" required>
                        <br><br>


                        <strong>Invoice Date:</strong><br> {{ $todaydate }}<br><br>
                        <strong>Due Date:</strong><br>

                        <input type="date" name="due_date" required>

                        <br>
                    </p>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <br><br><br><br>


            <input class="col-md-4" type="text" value="Invoice for the Month of July, 2020." name="period" required>

            <!--    <p style="font-size: 20px"><b><u>Invoice for the Month of July, 2019.</u></b></p> -->

            <!-- Table row -->
            <div class="row" style="margin-top: 40px">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped auto-index">
                        <thead>
                            <tr
                                style="border-color: #0000; border-style: solid; border-width: 10px; background-color: #bdbec0; color: white">
                                <th class="th">S.No</th>
                                <th class="th">Order#</th>
                                <th class="th">Description</th>
                                <th class="th">Job Cetagory</th>
                                <th class="th">Order Date</th>
                                <th class="th">Quantity</th>
                                <th class="th">Unit Price</th>
                                <th class="th">Discount</th>
                                <th class="th">$ Amount</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if (!empty($DigiOrders)) {

                                    foreach ($DigiOrders as $digi) {
                                        ?>

                            <tr>
                                <td></td>
                                <td class="td"><input type="number" class="form-control" name="digi_orId[]"
                                        value="{{ $digi->OrderID }}"></td>
                                <td class="td"><input type="text" class="form-control" name="digi_orName[]"
                                        value="{{ $digi->DesignName }}"></td>
                                <td class="td">Digitizing</td>
                                <td class="td"><input type="text" class="form-control" name="digi_orDate[]"
                                        value="<?php echo date('j M Y', strtotime($digi->DateAdded)); ?>"> </td>
                                <td class="td"><input type="text" class="form-control" name="digi_orQty[]"
                                        value="{{ $digi->Quantity }}"> </td>
                                <td class="td"><input type="text" class="form-control" name="digi_prUnit[]"
                                        value="{{ $digi->PriceBeforeDiscount }}"> </td>
                                <td class="td"><input type="number" class="form-control"
                                        name="digi_orDiscount[]" value="{{ $digi->Discount }}"></td>
                                <td class="td"><input type="text" name="digi_orPrice[]" class="form-control"
                                        value="{{ $digi->Price }}"> </td>

                            </tr>



                            <!-- <span class="badge bg-red" style="font-size: 16px"></span> -->
                            <?php
                                    }
                                }
                                ?>


                            <?php
                                if (!empty($VecOrders)) {

                                    foreach ($VecOrders as $vector) {
                                        ?>

                            <tr>
                                <td></td>
                                <td class="td"><input type="number" class="form-control" name="vec_orId[]"
                                        value="{{ $vector->VectorOrderID }}"></td>
                                <td class="td"><input type="text" class="form-control" name="vec_orName[]"
                                        value="{{ $vector->DesignName }}"></td>
                                <td class="td">Vector</td>
                                <td class="td"><input type="text" class="form-control" name="vec_orDate[]"
                                        value="<?php echo date('j M Y', strtotime($vector->DateAdded)); ?>"></td>
                                <td class="td"><input type="text" class="form-control" name="vec_orQty[]"
                                        value="{{ $vector->Quantity }}"> </td>
                                <td class="td"><input type="text" class="form-control" name="vec_prUnit[]"
                                        value="{{ $vector->PriceBeforeDiscount }}"> </td>
                                <td class="td"><input type="number" class="form-control"
                                        name="vec_orDiscount[]" value="{{ $vector->Discount }}"> </td>
                                <td class="td"><input type="number" class="form-control" name="vec_orPrice[]"
                                        value="{{ $vector->Price }}"> </td>

                                <!-- <td> <input type="number" class="form-control" name="vec_orPrice[]" value="{{ $vector->Price }}" disabled></td> -->
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
                        Note: If you have any issues in reference to the invoice, Please do not hesitate to give a call
                        or email us.

                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <table class="table">
                        <tr>
                            <th>Subtotal:</th>
                            <td><span style="font-size: 16px;">
                                    <input type="text" value="{{ $TotalPrice }}" disabled>$
                                    <input type="hidden" value="{{ $TotalPrice }}" name="sub_total">
                                </span></td>
                        </tr>

                        <tr>
                            <th>Total:</th>
                            <td><span style="font-size: 18px">
                                    <input type="text" value="{{ $TotalPrice }}" name="TotalPrice" required>$
                                </span></td>
                        </tr>
                    </table>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


        </section>

        <!--  <h3 style="color: blue"><a href="http://logoartz.com/">CLICK HERE TO MAKE YOUR PAYMENT</a></h3> -->
        <label>Payment Link Paste Here:</label>
        <input type="text" class="form-control" name="payUrl" required> <br>

        <!-- <textarea name="emailcontent" class="form-control"></textarea> -->
        <div class="box">
            <div class="box-header">
                <label class="box-title">Message for Customer <small> (only main content paste here)</small></label>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
                <textarea name="emailcontent" class="textarea" placeholder="Email Content "
                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                    required></textarea>

            </div>
        </div>


        <br><br>

        <h3> WE APPRECIATE YOUR BUSINESS, THANKS FOR CHOOSING LOGO ARTZ!</h3>



        <div class="row"
            style="background-color:#BFBFBF; border-top: 25px; border-color:#D9D9D9; border-style: solid;">
            <div class="col-sm-12 text-center breadcrumb-block " style="text-align:left; color: white">
                <h1><b>LOGO ARTZ</b> </h1> <br>
                <p style="font-size: 20px"><b>917-310-3789 | info@logoartz.com | www.logoartz.com</b></p>

            </div>
            <br><br><br><br><br>
        </div>

        <div class="row">
            <?php
                if (isset($DOrderIDs) && count($DOrderIDs) > 0) {
                    foreach ($DOrderIDs as $orderd) {
                        ?>
            {!! Form::hidden('dorderids[]', $orderd, []) !!}
            <?php
                    }
                }
                ?>
            <?php
                if (isset($VOrderIDs) && count($VOrderIDs) > 0) {
                    foreach ($VOrderIDs as $orderd) {
                        ?>
            {!! Form::hidden('vorderids[]', $orderd, []) !!}
            <?php
                    }
                }
                ?>
            {!! Form::hidden('CustomerID', $CustomerID, []) !!}
            <?php
                if (isset($DOrderIDs) || isset($VOrderIDs)) {
                    ?>
            <div class="col-md-2">
                <button type="submit" style="margin-top: 24px;" class="btn btn-primary btn-flat form-control"><i
                        class="fa fa-send"></i> Send</button>
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
