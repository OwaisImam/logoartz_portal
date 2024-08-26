<!DOCTYPE html>
<html lang="en" class="demo-2 no-js">
<!--<![endif]-->


<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Contact Logo Artz</title>
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


    </head>
    

<body class="inner body-innerwrapper">
   
    <!--Header-->
    

      @include('includes/header')

    <!--Model-->
    <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="bs-example bs-example-tabs">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active"><a href="#signin" data-toggle="tab">Sign In</a></li>
                        <li class=""><a href="#signup" data-toggle="tab">Register</a></li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="signin">
                            <form action="#" method="post">
                                <!-- Text input-->
                                <div class="form-group">
                                    <input required="" name="email" type="text" class="form-control" placeholder="Your E-mail*">
                                </div>

                                <!-- Password input-->
                                <div class="form-group">
                                    <input required=""  name="passwordinput" class="form-control" type="password" placeholder="Password*">
                                </div>

                                <!-- Multiple Checkboxes (inline) -->
                                <div class="checkbox form-group">
                                    <input type="radio" value="remember" name="remember" id="remember">
                                    <label for="remember">Remember Me</label>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <button  class="btn green-btn">Sign In</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="signup">
                            <form action="#" method="post">
                                <div class="form-group col-sm-6 padding-right">
                                    <input class="form-control" name="firstname" placeholder="First Name" type="text" required />
                                </div>
                                <div class="form-group col-sm-6 padding-left">
                                    <input class="form-control" name="lastname" placeholder="Last Name" type="text" required />
                                </div>
                                <div class="form-group col-sm-12 no-padding">
                                    <input class="form-control" name="email" placeholder="Your Email" type="email" />
                                </div>
                                <div class="form-group col-sm-12 no-padding">
                                    <input class="form-control" name="password" placeholder="Password" type="password" />
                                </div>
                                <label for="">
                                    Birth Date</label>
                                <div class="col-sm-12 no-padding">
                                    <div class="form-group col-sm-4 padding-right">
                                        <select class="form-control">
                                            <option value="Month">Month</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <select class="form-control">
                                            <option value="Day">Day</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4 padding-left">
                                        <select class="form-control">
                                            <option value="Year">Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="checkbox form-group col-sm-12 no-padding">
                                    <input type="radio" value="male" name="gender" id="male">
                                    <label for="male">Male</label>
                                    <input type="radio" value="female" name="gender" id="female">
                                    <label for="female">Female</label>
                                </div>
                                <div class="form-group col-sm-12 no-padding">
                                    <button class="btn btn-lg green-btn" type="submit">
                                        Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--All Js-->







  <section id="breadcrumb" class="two green-color">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                    <h3>Contact Us</h3>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">Contact Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Contact us-->
    <section id="contact" class="space-top">
        <div class="container">
            <div class="row">
                <div class="contact-us col-sm-12 space-bottom">

                    <div class="col-sm-2 contact-block text-center">
                        <i class="icofont icofont-telephone"></i>
                        <h3>Phone</h3>
                        <a href="tel:+092-12343424">44-20-8133-8686</a>
                        <a href="tel:+096-12343424">917-310-3789</a>
                    </div>

                    <div class="col-sm-3 contact-block text-center">
                        <i class="icofont icofont-home"></i>
                        <h3>Head Office</h3>
                        <p>Suite # 213, Staten Island, New York - 10306</p>
                    </div>

                      <div class="col-sm-3 contact-block text-center">
                        <i class="icofont icofont-home"></i>
                        <h3>Sub Office</h3>
                        <p>10105 E. Via Linda, #103, Scottsdale, Arizona 85258</p>
                    </div>

                
                    <div class="col-sm-2 contact-block text-center">
                        <i class="icofont icofont-ui-clock"></i>
                        <h3>Working Hours</h3>
                        <p>Monday to Friday 24 Hours</p>
                    </div>

                        <div class="col-sm-2 contact-block text-center" >
                        <i class="icofont icofont-envelope-open"></i>
                        <h3>Support</h3>
                        <p >
                        <a href="mailto:support@six.com">support@logoartz.com</a>
                        <a href="mailto:info@six.com">info@logoartz.com</a>
                        </p>
                    </div>

                </div>
                <div class="col-sm-6 contact-form no-padding">
                    <form id="contact-form">
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control" name="name" id="name" required placeholder="Name...">
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="email" class="form-control" name="mail" id="mail" required placeholder="Email...">
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="text" class="form-control" name="website" id="website" placeholder="Subject...">
                        </div>
                        <div class="form-group col-sm-12 ">
                            <textarea class="form-control" name="comment" id="comment" placeholder="Message..."></textarea>
                        </div>
                        <div class="col-sm-12 button text-right">
                            <input type="submit" id="submit_contact" class="btn green-btn" value="Send Message">
                            <div id="msg" class="message"></div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 map ">
                    

                    <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Staten%20Island%2C%20New%20York%20-%2010306&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.crocothemes.net">crocothemes.net</a></div><style>.mapouter{text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>

                   
                </div>
            </div>
        </div>
    </section>
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


        <script type="javascript">
            
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(40.6700, -73.9400),
            map: map,
            title: 'Snazzy!'
        });

        </script>
       


    </body>
    
    </body>
    
    
    <!-- Mirrored from themesfoundry.net/demo/html/six/home-digital-marketing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 12:57:13 GMT -->
    </html>
    
