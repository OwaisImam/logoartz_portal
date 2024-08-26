
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

    <body class="body-innerwrapper">
        <!--Pre loader-->

        @include('includes/header')


    <!--Bread Crumb-->
    <section id="breadcrumb" class="two green-color">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center breadcrumb-block">
                    <h3>About Us</h3>
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


                        <li class="active">About Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Services-->
    <section id="services" class="space-top three" background="{{ asset('assets/web/images/aboutbg.png">
        <div class="container">
            <div class="row ">
                 <div class="col-sm-12 service-block text-center">
                     <h3 class="animate-in move-up">We are in the service since 2008.</h3>
                        <p class="animate-in move-up">
                            LogoArtz provides best logo design, digitizing, raster to vector services in market, with best prices <br>
                            and discounts. Our team is well experienced in everything digital, and we provide the best possible results  <br>
                            with attention to detail. Best prices and fastest turnaround guaranteed! Do not hesitate a second to contact 
                               <br>us and find out about our deals. To see the quality of our raster to vector service, just apply for our free first logo. </p>
                     <img src="{{ asset('assets/web/images/logo.gif" class="signature animate-in move-up" alt="Signature">
                    </div>
                
                  <div class="col-sm-12" style="margin-bottom: 30px">
                        
                        <img src="{{ asset('assets/web/images/Digitizing.jpg') }}">

                    </div>


 </div>
                </div>
            </div>
        </div>
    </section>
    <!--action 1-->
    <section class="action-3">
        <div class="container-fluid">
            <div class="row">
                <!--main heading-->
                <div class="main-heading two col-sm-12 no-padding text-center owl-carousel owl-theme action_3-slider">
                    <div class="item blue space-top">
                          <h2 class="animate-in move-up">Vectar Art</h2>
                            <p class="animate-in move-up">
                                    Vector Tracing is a photo editing technique that converts bitmap images (.bmp,.jpg,.png,e.t.c.) into vectors 
                                    <br>(.SVG or Scalable Vector Graphics) and is provided as service by photo editors using the appropriate photo 
                                    <br>editing tools such as Adobe Illustrator (A.I.) or Corel Draw. Not every photo editing tool can convert bitmap images to vectors.</p>
                            <img src="{{ asset('assets/web/images/cal-to-action-4.png" class="animate-in move-up" alt="Call To Action">
                        </div>
                        <div class="item green space-top">
                            <h2 class="animate-in move-up">Digitizing</h2>
                            <p class="animate-in move-up">Branding and Marketing is the motto of the 21st century. It was all about businesses, then this decade, 
                                <br>it became more personal and about individuals as well. One thing that speaks more than anything about personal  
                                <br>brand and identity is logo, a literal visual representation of a person or organization's unique brand. Companies 
                                <br>like Nike and it's 'swoosh' and a 'bitten apple' for Apple have become iconic in themselves and have become 
                                <br>cultural icons than just ordinary logos.</p>

                       <img src="{{ asset('assets/web/images/cal-to-action-4.png" class="animate-in move-up" alt="Call To Action">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Our team-->
  <!--   <section id="our-team" class="space two border-bottom-full">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 team-block animate-in fade-in">
                    <div class="inner text-center">
                        <div class="team-image">
                            <img src="images/Member-Image.png" alt="Team Member">
                        </div>
                        <h4><a href="#">John Doe</a> </h4>
                        <div class="designation">Creative Director</div>
                    </div>
                </div>
                <div class="col-sm-3 team-block animate-in fade-in">
                    <div class="inner text-center">
                        <div class="team-image">
                            <img src="images/Member-Image1.png" alt="Team Member">
                        </div>
                        <h4><a href="#">Maria Jones</a> </h4>
                        <div class="designation">Data Information</div>
                    </div>
                </div>
                <div class="col-sm-3 team-block animate-in fade-in">
                    <div class="inner text-center">
                        <div class="team-image">
                            <img src="images/Member-Image2.png" alt="Team Member">
                        </div>
                        <h4><a href="#">David Ramon</a> </h4>
                        <div class="designation">Lead Developer</div>
                    </div>
                </div>
                <div class="col-sm-3 team-block animate-in fade-in">
                    <div class="inner text-center">
                        <div class="team-image">
                            <img src="images/Member-Image3.png" alt="Team Member">
                        </div>
                        <h4><a href="#">Faria Nora</a> </h4>
                        <div class="designation">Creative Director</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   -->  <!--footer-->
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
