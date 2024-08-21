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

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/css/grid-gallery.min.css">
    </head>

    <body class="body-innerwrapper">
        <!--Pre loader-->

        @include('includes/header')

       <section id="breadcrumb" class="two green-color">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 text-center breadcrumb-block">
                        <h3>LOGO ARTZ PORTFOLIO</h3>
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
                            <li class="active">PORTFOLIO</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

    <!--Bread Crumb-->
    <!--Portfolio-->
    <section id="portfolio" class="space-top one">
        <div class="container">



            <div class="row">
  <div class="col-md-12">
     <h1 style="text-align: center"> Previous work post here</h1>
        

   <div id="gg-screen"></div>
   

    <div class="gg-box">
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p1.jpg">
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p2.jpg">
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p3.jpg">
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p4.jpg">
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p5.jpg">
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p6.jpg">          
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p7.jpg">     
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p8.jpg">   
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p9.jpg">      
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p10.jpg">     
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p11.jpg">     
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p12.jpg"> 
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p13.jpg">       
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p14.jpg">      
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p15.jpg">     
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p16.jpg">       
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p17.jpg">
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p18.jpg">       
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p19.jpg">
      </div>
      <div class="gg-element">
        <img src="{{ asset('assets/web') }}/images/portfolio/p20.jpg">
      </div>
    </div>
   

    </div>

  </div>
</div>


<!--             <div class="row">

                <h1> Previous work post here</h1>
                <div id="sp-simpleportfolio" class="sp-simpleportfolio sp-simpleportfolio-view-items layout-gallery-space">
                    <div class="sp-simpleportfolio-filter">
                        <ul>
                            <li class="active" data-group="all"><a href="#">All </a></li>
                            <li data-group="illustration"><a href="#">Illustration</a></li>
                            <li data-group="digi"><a href="#">Digitizing </a></li>
                            <li data-group="app"><a href="#">App Design</a></li>
                        </ul>
                    </div>
                    <div class="sp-simpleportfolio-items sp-simpleportfolio-columns-3">
                        <div class="sp-simpleportfolio-item" data-groups='["illustration"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-1.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["digi"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="{{ asset('assets/web') }}/images/portfolio/1.png" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      

                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="{{ asset('assets/web') }}/images/portfolio/2.png" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      

                      <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="{{ asset('assets/web') }}/images/portfolio/3.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      

                      <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-3.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      
                      <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-3.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      





                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["vector"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-2.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["logo"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work5.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["illustration"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-4.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["app"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work6.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["app"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-7.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["illustration"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-8.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-item" data-groups='["web"]'>
                            <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                                <img class="sp-simpleportfolio-img" src="images/work-9.jpg" alt="portfolio">
                                <div class="sp-simpleportfolio-overlay">
                                    <div class="sp-vertical-middle">
                                        <div>
                                            <div class="sp-simpleportfolio-btns">
                                            </div>
                                            <h3 class="sp-simpleportfolio-title">
                                            <a href="#">Project Name</a></h3>
                                            <div class="sp-simpleportfolio-tags">Category</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   -->  <!--Action 4-->
   <!--  <section class="space action bg one">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center action-block">
                    <h3>Want to lift your business to top?</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                        <br>nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                    <a href="#" class="btn radius-2x green-btn">Get started now</a>
                </div>
            </div>
        </div>
    </section> -->
    <!--footer-->
    @include('includes/footer')
    <!--footer-->

    <!--All Js-->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('assets/web') }}/js/grid-gallery.min.js"></script>

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

<script type="text/javascript"> 
 
$(function () {
$("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});

</script>
    @include('includes/commonscripts')
</body>
</html>

