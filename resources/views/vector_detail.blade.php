
<!DOCTYPE html>
<html lang="en" class="demo-2 no-js">
<!--<![endif]-->


<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Digitizing Order</title>
        <meta name="keywords" content="Logo Artz">
        <meta name="description" content="Logo Artz">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
          <link rel="icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/bootstrap.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/icofont.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/hover-min.css" media="screen">
        <!--Owl Carousel-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.carousel.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.theme.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/owl.transitions.css" media="screen">
        <!--Portfolio-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/spsimpleportfolio.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/featherlight.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/style.css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/responsive.css" media="screen"> 


    </head>
    

<body class="inner body-innerwrapper">
   
    <!--Header-->
    

      @include('includes/header')





        <!--Breadcrumb-->
       
     <section id="breadcrumb" class="two green-color">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                    <h3>DIGITIZING</h3>
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
                        <li class="active">Degitizing</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <!--Services-->
    <section id="single-services" class="space one">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 service-block">
                    <div class="inner">
                        <img src="{{ asset('assets/web') }}/images/single-service.jpg" alt="Single Service">
                        <div class="col-sm-8 service-inner padding-right">
                            <div class="service-item">
                                <h4>Digitizing</h4>
                                <p>
                                    Branding and Marketing is the motto of the 21st century. It was all about businesses, then this decade,
                                    it became more personal and about individuals as well. One thing that speaks more than anything about 
                                    personal brand and identity is logo, a literal visual representation of a person or organization’s unique brand. Companies like Nike and it’s ‘swoosh’ and a ‘bitten apple’ for Apple have become iconic in themselves and 
                                    have become cultural icons than just ordinary logos. One way to attach logos onto people mind is to have them visually accessible, i.e. on clothes, embroidered, usually done via Logo Digitizing.


                                    <br>
                                    <br>



                                    Our superlatively talented and expertly trained digitizers can turn any logo of your business or personal brand into a digital embroidery design, all according to the conditions stipulated to us by the customer when submitting the digitizing order. Customers can further utilize the specialized embroidery options like puff and applique to make their logos have much more visual impact than with their just 2D/flat self. Moreover, we pride ourselves with being able to appease the needs of diversified clientele and hence can provide the design in particular formats for your specific embroidery machines.


                                    </p>


                            </div>
                            <div class="service-item">
                                <h4>Frequently Asked Question</h4>
                                <p>




                                    <br>ullamcorper suscipit lobortis nisl ut aliquip.</p>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#panel1"><i class="fa fa-caret-right"></i>Sed diam nonumy eirmod tempor invidunt?</a>
                                        </h4>
                                        </div>
                                        <div id="panel1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>Duis erat eros, consequat et felis sit amet, porta fringilla tellus. Suspend lobortis odio non urna porttitor iaculis. Aliquam nec molestie neq.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#panel2"><i class="fa fa-caret-right"></i>At vero eos et accusam et justo?</a>
                                        </h4>
                                        </div>
                                        <div id="panel2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>Duis erat eros, consequat et felis sit amet, porta fringilla tellus. Suspend lobortis odio non urna porttitor iaculis. Aliquam nec molestie neq.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#panel3"><i class="fa fa-caret-down"></i>Stet clita gubergren, sea takimata sanctus?</a>
                                        </h4>
                                        </div>
                                        <div id="panel3" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <p>Duis erat eros, consequat et felis sit amet, porta fringilla tellus. Suspend lobortis odio non urna porttitor iaculis. Aliquam nec molestie neq.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 service-inner padding-left">
                            <div class="service-item">
                                <h4>Why this service?</h4>
                                <p>
                                    For supreme quality and finally less taxing customized Logo embroidery digitizing and other such similar things get in touch with us right away.

                                </p>
                            </div>
                            <div class="service-item">
                                <h4>Results</h4>
                                <p>Duis autem vel eum iriure dolor in eumre consequat, vel illum dolore. Ut wisi enim ullamcorper suscipit lobortis nisl. uscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-sm-3">
                    <div class="widget twitter">
                        <h4>Latest Tweet</h4>
                        <div class="tweet-block">
                            <div class="name">David Ramon</div>
                            <div class="date">2h ago</div>
                            <p>"I will recommend you to my colleagues."</p>
                        </div>
                        <div class="tweet-block">
                            <div class="name">David Ramon</div>
                            <div class="date">2h ago</div>
                            <p>Duis autem vel eum iriure dolor vulputate velit esse molestie con um dolore eu feugiat nulla fac.</p>
                        </div>
                        <div class="tweet-block">
                            <div class="name">David Ramon</div>
                            <div class="date">2h ago</div>
                            <p>Duis autem vel eum iriure dolor vulputate velit esse molestie con um dolore eu feugiat nulla fac.</p>
                        </div>
                    </div>
                    <div class="widget testimonial">
                        <h4>Testimonials</h4>
                        <div class="testimonial-block">
                            <p>“Lorem ipsum dolor sit amet, consec adipiscing elit, sed diam nonummy euismod tincidunt ut laoreet dolore aliquam erat volutpat. Ut wisi enim ad veniam, quis nostrud exerci tation.</p>
                            <div class="name">David Ramon</div>
                            <div class="profession">Businessman</div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!--Footer-->




   
  @include('includes/footer')

        <!--Copyright-->
    
        <!--All Js-->
         <script type="text/javascript" src="{{ asset('assets/web') }}/js/jQuery.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/bootstrap.js"></script>
        <!--<script src="../../../../use.fontawesome.com/e18447245b.js"></script>-->
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/appear.js"></script>
        <!--Portfolio-->
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/isotope.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/spsimpleportfolio.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/featherlight.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/jquery.shuffle.modernizr.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/steller.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/smooth-scroll.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/owl.carousel.js"></script>
        <script type="text/javascript" src="{{ asset('assets/web') }}/js/custom.js"></script>
    </body>
    
    </body>
    
    
    <!-- Mirrored from themesfoundry.net/demo/html/six/home-digital-marketing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 12:57:13 GMT -->
    </html>
    
