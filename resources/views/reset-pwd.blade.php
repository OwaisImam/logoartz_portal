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
    </head>


    <body class="body-innerwrapper">

        @include('includes/header')

        <section id="breadcrumb" class="two green-color">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 text-center breadcrumb-block">
                        <h3> Forgot Password</h3>
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
                            <li class="active">Forgot Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!--Services-->


        <div class="container" style="padding:2em;">
            <section>	
                <h3 style="color:#555555;text-align: center;margin-top: 7px;">Lost Password Reset
</h3>

                {!! Form::open(['url' => '/forgotpwd-user/'.$resetCode]) !!}
                
                <div class="tab-pane fade active in" id="signin">	
                    @include('includes/front_alerts')
                    <div class="row">
                        <div class="col-md-2"> 
                        </div>

                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="password"><h4>New Password:</h4></label>
                                 {!! Form::password('Password', ['placeholder' => 'Enter password', 'class' => 'form-control', 'id' => 'Username']) !!}
                            </div>
                            <div class="form-group">
                                <label for="Username"><h4>Confirm New Password:</h4></label>
                                 {!! Form::password('ConfirmPassword', ['placeholder' => 'Enter again password', 'class' => 'form-control', 'id' => 'Username']) !!}
                            </div>
                            
                        </div>

                          <div class="col-md-6"> 
                            
                            
                        </div>

                        <div class="col-md-2"> 
                        </div>
                    </div>


                </div>

                <div class="row">

                    <div class="col-md-4">

                    </div>

                    <div class="col-md-4">

                        <div class="col-md-4">
                            <div class="form-group">
                                <button  class="btn green-btn"> Submit </button>

                            </div>   
                        </div>

                        {!! Form::close()  !!}


                    <div class="col-md-4">


                    </div>


                </div>     

                {!! FORM::close() !!}


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
