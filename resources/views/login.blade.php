<!DOCTYPE html>

<html lang="en" class="demo-2 no-js">


    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Login</title>
        <meta name="keywords" content="LogoArtz">
        <meta name="description" content="Logo Artz">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
          <!--<link rel="icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon" />-->
          <link rel="icon" href="https://www.logoartz.com/assets/images/logo1.png" type="image/x-icon" />
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
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/style.css?v=1') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/responsive.css') }}" media="screen">
    </head>


    <body class="body-innerwrapper">

        @include('includes/header')

        <!--<section id="breadcrumb" class="two green-color">-->
        <!--    <div class="container ">-->
        <!--        <div class="row">-->
        <!--            <div class="col-sm-12 text-center breadcrumb-block">-->
        <!--                <h3> Client Area</h3>-->
        <!--                <ol class="breadcrumb">-->
                               <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                        <!--<li>-->
                        <!--    <a href="{{ url('/CustomerDash')}}">Home</a>-->
                        <!--</li>-->
                    <?php }else{ ?>

                        <!--   <li>-->
                        <!--    <a href="{{ url('/')}}">Home</a>-->
                        <!--</li>-->
                    <?php } ?>
        <!--                    <li class="active">Customer Login</li>-->
        <!--                </ol>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!--Services-->


        <div class="container" style="padding:2em;">
            <section>	
                <h3 style="color:#555555;text-align: center;margin-top: 7px;"> Customer Login</h3>

                <div class="tab-pane fade active in" id="signin">	
                    @include('includes/front_alerts')
                    <div class="row">
                        <div class="col-md-2"> 
                        </div>

                {!! Form::open(['url' => 'login']) !!}
                        <div class="col-md-8"> 
                            <div class="form-group">
                                <label for="Username">Username:</label>
                                 {!! Form::text('Username', null, ['placeholder' => 'Enter Username', 'class' => 'form-control', 'id' => 'Username']) !!}
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                 {!! Form::password('Password', ['placeholder' => 'Enter Password', 'class' => 'form-control', 'id' => 'Password']) !!}
                            </div>
                        </div>

                        <div class="col-md-2"> 
                        </div>
                    </div>


                </div>

                <div class="row">

                    <div class="col-md-12" style="text-align: center;">
                        <div class="row">
                                <button type="submit" class="btn green-btn"> Sign In </button>
                           {!! FORM::close() !!}
                          <button  class="btn green-btn" onclick="location.href='{{ url('/cus_forgot_password') }}'">Forgot Password</button>
                           
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col-md-12">
                               <p style="text-align: center;"> <div class="loginSuggestion">Not a member? <a href="{{ url('register') }}">Sign up now <i class="fa fa-angle-right" aria-hidden="true"></i></a></div></p>

                         

                            </div>
                        </div>

                    </div>


                </div>     


     

           


            </section>	
        </div>

    </div>
    @include('includes/footer')

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
</html>
