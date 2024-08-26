<!DOCTYPE html>

<html lang="en" class="demo-2 no-js">



    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Register</title>
        <meta name="keywords" content="HTML5 Template">
        <meta name="description" content="Logo Artz">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
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
    
     <style type="text/css">
        .numfont{
            font-family: Century Gothic;
        }

    </style>


    <body class="body-innerwrapper">
        @include('includes/header')
        <!--Bread Crumb-->
        <!--<section id="breadcrumb" class="two green-color">-->
        <!--    <div class="container ">-->
        <!--        <div class="row">-->
        <!--            <div class="col-sm-12 text-center breadcrumb-block">-->
        <!--                <h3>Customer Registration</h3>-->
        <!--                <ol class="breadcrumb">-->
        <!--                    <li>-->
        <!--                        <a href="{{ url('/') }}">Home</a>-->
        <!--                    </li>-->
        <!--                    <li class="active">Customer Registration</li>-->
        <!--                </ol>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!--Services-->


        <div class="container" style="padding:2em;">
            <section>	
                <!-- <h3 style="color:#555555;text-align: center;margin: 7px;">Customer Registration</h3> -->
                {!! Form::open([ 'url' => 'register']) !!}
                    <div class="box-body">	

                        <h4 style="margin-top:7px;text-align:center;">Personal Information:</h4>
                        <div class="row">

@include('includes/front_alerts')
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="CustomerName">Name:</label>
                                    {!! Form::text('CustomerName', null, ['placeholder' => 'Enter Customer Name', 'class' => 'form-control', 'id' => 'CustomerName']) !!}
                                </div>

                            </div>

                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="Cell">Cell / Phone:</label>
                                    {!! Form::number('Cell', null, ['placeholder' => 'Enter Cell / Phone', 'class' => 'form-control numfont', 'id' => 'Cell']) !!}
                                </div>
                            </div>

                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="Company">Company:</label>
                                     {!! Form::text('Company', null, ['placeholder' => 'Enter Company', 'class' => 'form-control', 'id' => 'Company']) !!}
                                </div>
                            </div>

                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    {!! Form::email('Email', null, ['placeholder' => 'Enter Email', 'class' => 'form-control', 'id' => 'Email']) !!}
                                </div>

                            </div>

                        </div>




                        <div class="row">

                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="Address">Address:</label>
                                    {!! Form::text('Address', null, ['placeholder' => 'Enter Address', 'class' => 'form-control', 'id' => 'Address']) !!}
                                </div>
                            </div>




                         <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="City">City:</label>
                                     {!! Form::text('City', null, ['placeholder' => 'Enter City', 'class' => 'form-control', 'id' => 'City']) !!}
                                </div>

                            </div>


                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="Zip">Zip Code:</label>
                                    {!! Form::text('Zip', null, ['placeholder' => 'Enter Zip Code', 'class' => 'form-control numfont', 'id' => 'Zip']) !!}
                                </div>
                            </div>



                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="State">State:</label>
                                    {!! Form::text('State', null, ['placeholder' => 'Enter State', 'class' => 'form-control', 'id' => 'State']) !!}
                                </div>

                            </div>

                        </div>






                        <div class="row">

                       

                        </div>




                        <div class="row">

                            <div class="col-md-4"> 

                                <div class="form-group">
                                    <label>Country</label>
                                    {!! Form::select('CountryID', $countries_dd, null, ['class' => 'form-control select2', 'id' => 'CountryID']) !!}
                                </div>

                            </div>  <!--Col Close-->


                            <div class="col-md-4"> 

                                <div class="form-group">
                                    <label>Currency</label>
                                    {!! Form::select('CurrencyID', $currencies_dd, null, ['class' => 'form-control select2', 'id' => 'CurrencyID']) !!}
                                </div>

                            </div>  <!--Col Close-->


                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>HOW DID YOU LEARN ABOUT Logo Artz?</label>
                                    {!! Form::select('HearAbout', $hear_about_dd, null, ['class' => 'form-control select2', 'id' => 'HearAbout']) !!}
                                </div>

                            </div> <!--Col Close-->
                        </div> 

                      


                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="Username">User Name:</label>
                                    {!! Form::text('Username', null, ['placeholder' => 'Enter Username', 'class' => 'form-control', 'id' => 'Username']) !!}
                                </div>

                            </div>


                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="Password">Password:</label>
                                    {!! Form::password('Password', ['placeholder' => 'Enter Password', 'class' => 'form-control', 'id' => 'Password']) !!}
                                </div>
                            </div>


                        </div>

                <!--         <div class="row">

                            <div class="col-md-12">
                                <div class="about-us-all">
                                    <div class="about-optima-text">
                                        <h4 style="color:#3a1011;text-align: center;margin:50px;">BILLING INFORMATION</h4>
                                    </div>
                                </div>

                            </div> </div>

                        <div class="row">


                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="CardNumber">Card Number:</label>
                                    {!! Form::text('CardNumber', null, ['placeholder' => '8549 3549 2369 5879', 'class' => 'form-control', 'id' => 'CardNumber']) !!}
                                </div>

                            </div>


                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="NameOnCard">Name On Card:</label>
                                    {!! Form::text('NameOnCard', null, ['placeholder' => 'Enter Name on Card', 'class' => 'form-control', 'id' => 'NameOnCard']) !!}
                                </div>
                            </div>


                            <div class="col-md-3"> 


                                <div class="form-group">
                                    <label>Type</label>
                                    {!! Form::select('HearAbout', $card_types_dd, null, ['class' => 'form-control select2', 'id' => 'HearAbout']) !!}
                                </div>

                            </div>

                        <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="VerificationCode">Verification Code:</label>
                                    {!! Form::text('VerificationCode', null, ['placeholder' => 'Enter Verification Code', 'class' => 'form-control', 'id' => 'VerificationCode']) !!}
                                </div>

                            </div>



                        </div>










                        <div class="row">
                           

                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <label for="ExpiryDate">Expiry Date</label>
                                    {!! Form::text('ExpiryDate', null, ['placeholder' => 'Enter Expiry Date', 'class' => 'form-control', 'id' => 'ExpiryDate']) !!}
                                </div>
                            </div>




                            <div class="col-md-3"> 

                                <div class="form-group">
                                    <label for="Address">Address:</label>
                                    {!! Form::text('Address', null, ['placeholder' => 'Enter Address', 'class' => 'form-control', 'id' => 'Address']) !!}
                                </div>
                            </div>

                      

                     <div class="col-md-3"> 
                            <div class="form-group">
                                <label for="City">City:</label>
                                {!! Form::text('City', null, ['placeholder' => 'Enter City', 'class' => 'form-control', 'id' => 'City']) !!}
                            </div>
                        </div>

                     
                        <div class="col-md-3"> 
                            <div class="form-group">
                                <label for="ZipCode">Zip Code:</label>
                                {!! Form::text('ZipCode', null, ['placeholder' => 'Enter ZipCode', 'class' => 'form-control', 'id' => 'ZipCode']) !!}
                            </div>
                        </div>




                    </div>






                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="State">State:</label>
                                {!! Form::text('State', null, ['placeholder' => 'Enter State', 'class' => 'form-control', 'id' => 'State']) !!}
                            </div>
                        </div>

                          <div class="col-md-6"> 

                            <div class="form-group">
                                <label>Country</label>
                                {!! Form::select('CardCountryID', $countries_dd, null, ['class' => 'form-control select2', 'id' => 'CardCountryID']) !!}
                            </div>

                        </div> !-Col Close--

                    </div>
 -->

                    <div class="box-footer pull-right">

                        <button type="submit" class="btn orange-btn">Save</button>
                    </div>

                {!! FORM::close() !!}

            </section>	
        </div>

        @include('includes/footer')


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
</html>
