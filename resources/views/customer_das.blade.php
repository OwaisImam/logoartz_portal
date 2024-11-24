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
    <link rel="icon" href="{{ asset('assets/web/images/favicon.png') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset('assets/web/images/favicon.png') }}" type="image/x-icon" />
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






    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/_all-skins.min.css') }}">
    <style>
        .btn-block {
            background: radial-gradient(#fff, #ccc);
            color: black;
            border: none !important;
        }

        .order {
            padding: 10px;
            margin: 10px;
            border: 2px solid #5ec282;
            margin-top: 20px;
        }

        .my-log {
            position: absolute;
            top: -39px;
            background: #fff;
        }

        .bg-green,
        .callout.callout-success,
        .alert-success,
        .label-success,
        .modal-success .modal-body {
            margin-bottom: 51px;
        }

        .alert-dismissable .close,
        .alert-dismissible .close {
            top: 19px;
            font-size: 33px;
            color: #000 !important;
            right: 11px;
            opacity: 0.7;
        }

        .asap {
            /*padding: 0px;*/
            /*margin-top: 10px;*/

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
                            <a href="{{ url('/CustomerDash') }}">Home</a>
                        </li>
                        <?php }else{ ?>

                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <?php } ?>

                        <li class="active">Welcome!! </li>


                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section id="single-services" class="" style="margin-top: 0px">
        <div class="container">
            @include('includes/front_alerts')

            <div class="order"
                style="padding-right: 5px !important; padding-left: 5px !important; padding-top: 5px !important">

                <section style="padding: 0px !important">

                    <div class="col-sm-6 col-md-3">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body p-3">
                                <h4 class="card-title mb-2"
                                    style="font-size: 26px;font-weight: 600;padding-bottom: 0px;">
                                    {{ $count_digi_new_orders }}</h4>
                                <p class="card-text small" style="padding-bottom: 10px;">Digitizing Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body p-3">
                                <h4 class="card-title mb-2"
                                    style="font-size: 26px;font-weight: 600;padding-bottom: 0px;">
                                    {{ $count_digi_new_quote }}</h4>
                                <p class="card-text small" style="padding-bottom: 10px;">Digitizing Quote</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body p-3">
                                <h4 class="card-title mb-2"
                                    style="font-size: 26px;font-weight: 600;padding-bottom: 0px;">
                                    {{ $count_vector_new_orders }}</h4>
                                <p class="card-text small" style="padding-bottom: 10px;">Vector Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body p-3">
                                <h4 class="card-title mb-2"
                                    style="font-size: 26px;font-weight: 600;padding-bottom: 0px;">
                                    {{ $count_vector_new_quote }}</h4>
                                <p class="card-text small" style="padding-bottom: 10px;">Vector Quote</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body p-3">
                                <h4 class="card-title mb-2"
                                    style="font-size: 26px;font-weight: 600;padding-bottom: 0px;">{{ $digiOrderRev }}
                                </h4>
                                <p class="card-text small" style="padding-bottom: 10px;">Digitizing Order Revision</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body p-3">
                                <h4 class="card-title mb-2"
                                    style="font-size: 26px;font-weight: 600;padding-bottom: 0px;">
                                    {{ $VectorOrderRev }}
                                </h4>
                                <p class="card-text small" style="padding-bottom: 10px;">Vector Order Revision</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card text-center bg-info text-white">
                            <div class="card-body p-3">
                                <h4 class="card-title mb-2"
                                    style="font-size: 26px;font-weight: 600;padding-bottom: 0px;">{{ $invoices }}
                                </h4>
                                <p class="card-text small" style="padding-bottom: 10px;">Invoice</p>
                            </div>
                        </div>
                    </div>

                </section>

                <div class="row g-3" style="margin-top: 20px; justify-self:center">
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-primary btn-sm w-100"
                            onclick="location.href='{{ url('/digi-order') }}'">
                            <img src="{{ asset('assets/web/images/customer_dashboard/place_order.png') }}"
                                alt="Place Order" class="img-fluid mb-1" style="width: 50px;">
                            <p class="mb-0 small">Place Digitizing Order</p>
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-primary btn-sm w-100"
                            onclick="location.href='{{ url('/digi_quote') }}'">
                            <img src="{{ asset('assets/web/images/customer_dashboard/contract.png') }}"
                                alt="Place Quote" class="img-fluid mb-1" style="width: 50px;">
                            <p class="mb-0 small">Place Digitizing Quote</p>
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-primary btn-sm w-100"
                            onclick="location.href='{{ url('/vector-order') }}'">
                            <img src="{{ asset('assets/web/images/customer_dashboard/place_order.png') }}"
                                alt="Place Order" class="img-fluid mb-1" style="width: 50px;">
                            <p class="mb-0 small">Place Vector Order</p>
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-primary btn-sm w-100"
                            onclick="location.href='{{ url('/vector_quote') }}'">
                            <img src="{{ asset('assets/web/images/customer_dashboard/contract.png') }}"
                                alt="Place Quote" class="img-fluid mb-1" style="width: 50px;">
                            <p class="mb-0 small">Place Vector Quote</p>
                        </button>
                    </div>
                </div>

                {{-- <div class="row" style="margin-top: 5px !important">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm " href
                            onclick="location.href='{{ url('/digi-order') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/place_order.png') }}"
                                alt="LogoArtz">
                            <p style="font-size: 16px">Place <br> Digitizing Order</p>
                        </button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm" href
                            onclick="location.href='{{ url('/digi_quote') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/contract.png') }}"
                                alt="LogoArtz">
                            <p style="font-size: 16px">Place <br>Digitizing Quote</p>
                        </button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm" href
                            onclick="location.href='{{ url('/vector-order') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/place_order.png') }}"
                                alt="LogoArtz">
                            <p style="font-size: 16px">Place <br>Vector Order</p>
                        </button>
                    </div>


                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm " href
                            onclick="location.href='{{ url('/vector_quote') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/contract.png') }}"
                                alt="LogoArtz">
                            <p style="font-size: 16px">Place <br>Vector Quote</p>
                        </button>
                    </div>

                </div> --}}


                <div class="row g-3 mt-3" style="margin-top: 25px; text-align:center;">
                    <div class="col-sm-6 col-md-3">
                        <button type="button" class="btn btn-secondary btn-sm" href
                            onclick="location.href='{{ url('/dorderrecords') }}'"><img width="50px"
                                src="{{ asset('assets/web/images/customer_dashboard/books.png') }}" alt="LogoArtz">
                            <p class="mb-0 small" style=" color: #000">Digitizing<br>Order Record</p>
                        </button>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-secondary btn-sm w-100"
                            onclick="location.href='{{ url('/dquoterecords') }}'">
                            <img src="{{ asset('assets/web/images/customer_dashboard/search.png') }}"
                                alt="Quote Record" class="img-fluid mb-1" style="width: 50px;">
                            <p class="mb-0 small" style=" color: #000">Digitizing Quote Record</p>
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-secondary btn-sm w-100"
                            onclick="location.href='{{ url('/vorderrecords') }}'">
                            <img src="{{ asset('assets/web/images/customer_dashboard/books.png') }}"
                                alt="Order Record" class="img-fluid mb-1" style="width: 50px;">
                            <p class="mb-0 small" style=" color: #000">Vector Order Record</p>
                        </button>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-secondary btn-sm w-100"
                            onclick="location.href='{{ url('/vquoterecords') }}'">
                            <img src="{{ asset('assets/web/images/customer_dashboard/search.png') }}"
                                alt="Quote Record" class="img-fluid mb-1" style="width: 50px;">
                            <p class="mb-0 small" style=" color: #000">Vector Quote Record</p>
                        </button>
                    </div>
                </div>

                {{-- <div class="row" style="margin-top: 25px">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm" href
                            onclick="location.href='{{ url('/dorderrecords') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/books.png') }}" alt="LogoArtz">
                            <p style="font-size: 16px">Digitizing<br>Order Record</p>
                        </button>


                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm" href
                            onclick="location.href='{{ url('/dquoterecords') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/search.png') }}" alt="LogoArtz">
                            <p style="font-size: 16px">Digitizing<br> Quote Record</p>
                        </button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm" href
                            onclick="location.href='{{ url('/vorderrecords') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/books.png') }}" alt="LogoArtz">
                            <p style="font-size: 16px">Vector<br> Order Record</p>
                        </button>
                    </div>


                    <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-sm" href
                            onclick="location.href='{{ url('/vquoterecords') }}'"><img width="70px"
                                src="{{ asset('assets/web/images/customer_dashboard/search.png') }}" alt="LogoArtz">
                            <p style="font-size: 16px">Vector<br> Quote Record</p>
                        </button>
                    </div>



                </div> --}}
            </div>

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
    @include('includes/commonscripts')
</body>

</html>
