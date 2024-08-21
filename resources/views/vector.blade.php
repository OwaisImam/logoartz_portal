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

    <body class="body-innerwrapper">
        <!--Pre loader-->

        @include('includes/header')

       <section id="breadcrumb" class="two green-color">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 text-center breadcrumb-block">
                        <h3>VECTOR ART</h3>
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
                            <li class="active">Vector</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>




        <!--Breadcrumb-->
        <section id="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 breadcrumb-base no-padding">
                        <div class="col-sm-6 breadcrumb-block">
                            <h3>Portfolio Details</h3>
                        </div>
                        <div class="col-sm-6 breadcrumb-block text-right">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="active">portfolio</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--Single Portfolio-->
    <section id="single-portfolio" class="space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 no-padding owl-carousel owl-theme" id="portfolio-slider">
                    <div class="item">
                        <div class="col-sm-12t">
                            <img src="{{ asset('assets/web') }}/images/vector_detail_banner.jpg" alt="Single Porfolio">
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-12">
                            <img src="{{ asset('assets/web') }}/images/vector_detail_banner1.jpg" alt="Single Porfolio">
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-12">
                            <img src="{{ asset('assets/web') }}/images/vector_detail_banner2.jpg" alt="Single Porfolio">
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-12">
                            <img src="{{ asset('assets/web') }}/images/vector_detail_banner3.jpg" alt="Single Porfolio">
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-12">
                            <img src="{{ asset('assets/web') }}/images/vector_detail_banner.jpg" alt="Single Porfolio">
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-12 padding-left">
                            <img src="{{ asset('assets/web') }}/images/vector_detail_banner1.jpg" alt="Single Porfolio">
                        </div>
                    </div>
                </div>
                <div class="portfolio-detail col-sm-12">
                    <ul class="project-info">
                       <!--  <li><strong>Project Name: </strong>Here is the Project.</li>
                        <li><strong>Client: </strong> David Thomson</li>
                        <li><strong>Budget: </strong>$1600-$2500</li> -->
                    </ul>
                    <a href="{{ url('/register') }}" class="btn radius-4x orange-btn pull-right">Place Free Order</a>
                    <h3>Vector:</h3>
                    <p>   

                       Vector Tracing is a photo editing technique that converts bitmap images (.bmp,.jpg,.png,e.t.c.) into vectors (.SVG or Scalable Vector Graphics) and is provided as service by photo editors using the appropriate photo editing tools such as Adobe Illustrator (A.I.) or Corel Draw. Not every photo editing tool can convert bitmap images to vectors.
                        <br>
                        <br> As bitmap images are made of pixels, when they get magnified are getting pixelated, meaning that they get blur or distorted. But vectors are made of mathematical algorithms that make them look the same clear in any size they are scaled. As vectors are made of mathematical algorithms, they can be drawned by writing the appropriate code (XML). Are mostly used to draw simple images and shapes, but even more complex images can be made with vectors.
                        <br>

                       Vector Tracing technique is very useful for very many uses. In today`s internet era where every individual or company and organization needs to have a website for their online presence, converting bitmap images to vector images in several instances provides the advantage of clear photos and graphics on any computer or smartphone or tablet screen, keeping the quality of a website in high standards, providing viewers and visitors the best possible experience.

                        <br>
                        Vector tracing is ideal to for logos, brouchers, billbaords, visitcards, computer-controlled sewing machines, animations, creative art, printing and more.
                        <br>


                        <h3>The Practical Usage Advantages Of Vector Graphics</h3>
                        <br>

                        While the Vector graphics are not the appropriate format for every use, they provide certain advantages in certain cases,like:

                        <br>  <br>

                        -in use in websites they provide a better experience to the viewer as they don`t get blur when magnified or minified. Aswell they are smaller size files, which means that websites load faster, where speed is a factor on rankings.

                        <br>  <br>

                        -Vector is the ideal format for logos, as they can be used in websites, company cards, and can be printed in any scale from a tiny picture to a billboard advertisement.

                        <br>  <br>

                        -are perfect for printing in clothes, as they can get adjusted in any size to fit anywhere, and keep looking exactly the same clear.
                        <br> <br>

                        -Are ideal for animations and presentations.

                        <br>


                        We here in LogoArtz provide Vector Tracing Service to convert your photos into vector graphics (.svg), so you can use them for your purposes. Our team is long experienced in converting raster images to vector graphics, and we provide the best possible results. We offer the most affordable prices, and we guarantee that you will get the best vector outcomes, and we deliver within 24/hr. Furthermore we offer generous discounts on large projects, so do not hesitate a second to contact us and find out about our deals. To see the quality of our raster to vector service, just apply for our free first logo.


                    </p>
                </div>
              <!--   <div class="portfolio-pagination col-sm-12 text-center">
                    <a href="#" class="btn pull-left icon"><i class="icofont icofont-thin-left"></i>Previous Project</a>
                    <div class="icon">
                        <i class="icofont icofont-brand-microsoft"></i>
                    </div>
                    <a href="#" class="btn pull-right icon">Next Project<i class="icofont icofont-thin-right"></i> </a>
                </div> -->
            </div>
        </div>
    </section>
    <!--Footer-->
    @include('includes/footer')
    <!--footer-->

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
    @include('includes/commonscripts')
</body>
</html>
