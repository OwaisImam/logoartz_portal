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

        <!--Banner-->

    <section id="banner-3" class="banner-content">
        <div class="container ">
          <div class="col-sm-12 no-padding banner-base owl-theme owl-carousel"  style="margin-top: 5%; margin-left: 0%; margin-right: 0%; margin-bottom: 5%" id="banner-slider">
                                    <div class="item">
                                        <div class="col-sm-6 banner-block center">
                                            <div class="banner-main">
                                                <h3>Vector is now easy</h3>
                                                <h2>Vector </h2>
                                                <br> <h3>Raster to vector just a click away!</h3>
                                                <p>Consistently unmatched quality - that's the Logo Artz Promise! Smoother production runs and a beautiful embroidered 
                                                    <br>.</p>
                                                <a href="{{ url('/freevectororder') }}" class="btn radius-2x hvr-bounce-to-right">Free Order now</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 banner-block">
                                            <img src="{{ asset('assets/web/images/banner1.png" class="img-responsive" alt="Banner">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-sm-6 banner-block center">
                                            <div class="banner-main">
                                                <h3>Digitizing is now easy</h3>
                                                <h2>Digitizing</h2>
                                                <br><h3>Your one-stop shop for digitizing..</h3>
                                                <p>Looking for Logos, Embroidery or Digitizing? We got you covered!
                                                    <br></p>
                                                <a href="{{ url('/freedigiorder') }}" class="btn radius-2x hvr-bounce-to-right">Free Order now</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 banner-block">
                                            <img src="{{ asset('assets/web/images/DigiBanner.png" class="img-responsive" alt="Banner">
                                        </div>
                                    </div>
                  </div>
            </div>
       
    </section>




        <div class="container-fluid home-full-banner">
            

        <div class="row" >
               <div class="col-md-9">
                    
                    <section id="services" class="space three">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-9 service-block text-center">
                                    <h3 class="animate-in move-up">We are in the service since 2008.</h3>
                                    <p class="animate-in move-up">
                                        LogoArtz provides best logo design, digitizing, raster to vector services in market, with best prices <br>
                                        and discounts. Our team is well experienced in everything digital, and we provide the best possible results  <br>
                                        with attention to detail. Best prices and fastest turnaround guaranteed! Do not hesitate a second to contact 
                                        <br>us and find out about our deals. To see the quality of our raster to vector service, just apply for our free first logo. </p>

                                    <img src="{{ asset('assets/web/images/logo.gif" class="signature animate-in move-up" alt="Signature">
                                </div>
                            </div>
                        </div>
                    </section>

                </div>




                

                <div class="col-md-3" style="margin-top: 1%" style="font-size: 16px; font-weight: bold;">
                    <div id="free-order-form-box" >
                        <h3>GET A FREE TRIAL</h3>
                        @include('includes/front_alerts')
                        {!! Form::open(['url' => 'free-order', 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::text('CustomerName', null, ['placeholder' => 'Enter Full Name *', 'class' => 'form-control', 'id' => 'CustomerName', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('Company', null, ['placeholder' => 'Enter Company Name', 'class' => 'form-control', 'id' => 'Company']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::email('Email', null, ['placeholder' => 'Enter Email *', 'class' => 'form-control', 'id' => 'Email', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group" style="font-family: sans-serif;"> 
                            {!! Form::number('Cell', null, ['placeholder' => 'Enter Cell / Phone *', 'class' => 'form-control', 'id' => 'Cell', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('DesignName', null, ['placeholder' => 'Enter Design Name *', 'class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('Width', null, ['placeholder' => 'Enter Width (Inches) *', 'class' => 'form-control', 'required' => 'required', 'step' => '0.01']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('Height', null, ['placeholder' => 'Enter Height (Inches) *', 'class' => 'form-control' , 'required' => 'required', 'step' => '0.01']) !!}
                        </div>
                        <div class="form-group">
                            <label class="while-label" for="artwork">Upload Artwork</label>
                              {{ Form::file('File', array('required' => 'required')) }}
                        </div>
                        <div class="form-group">
                            {!! Form::select('OrderType', [
                            '0' => 'Select Artwork Type *',
                            '1' => 'DIGITIZING',
                            '2' => 'VECTOR'
                            ], null, ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::select('Fabric', [
                            '' => 'Select Fabric *',
                             'COTTON' => 'COTTON',
                                                                                    'PERFORMANCE POLYESTER' => 'PERFORMANCE POLYESTER',
                                                                                    'SILK' => 'SILK',
                                                                                    'TWILL' => 'TWILL',
                                                                                    'TOWEL' => 'TOWEL',
                                                                                    'WOOLEN' => 'WOOLEN',
                                                                                    'LINEN' => 'LINEN',
                                                                                    'LEATHER' => 'LEATHER',
                                                                                    'FELT' => 'FELT',
                                                                                    'TOTE' => 'TOTE',
                                                                                    'MESH' => 'MESH',
                                                                                    'BEANIES' => 'BEANIES',
                                                                                    'FLEECE/SOFTSHELL' => 'FLEECE/SOFTSHELL',
                                                                                    'OTHER' => 'OTHER'],
                            null, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::textarea('AddIns', null, ['placeholder' => 'ADDITIONAL INSTRUCTIONS', 'class' => 'form-control', 'rows' => '3', 'id' => 'heightauto']) }}
                        </div>
                        <div class="form-group">
                            <label class="while-label" for="artwork">How did you hear about us?</label>
                            {!! Form::select('HearAbout', $hear_about_dd, null, ['class' => 'form-control select2', 'id' => 'HearAbout', 'required' => 'required']) !!}
                        </div>
                        

                          <div class="form-group">
                            <label class="while-label" for="artwork">Your Country</label>
                             {!! Form::select('CountryID', $countries_dd, null, ['class' => 'form-control select2', 'id' => 'CountryID' , 'required' => 'required']) !!}
                        </div>
                        
                        
                        <p style="font-size: 13px; margin-bottom: 15px;">
                            PLEASE SET UP A USERNAME AND PASSWORD TO TRACK YOUR ORDER(s). PLEASE NOTE THAT BY REQUESTING A FREE TRIAL YOU AGREE TO OUR TERMS & CONDITIONS.
                        </p>
                        
                        <div class="form-group">
                            {!! Form::text('Username', null, ['placeholder' => 'Enter Username *', 'class' => 'form-control', 'id' => 'Username', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::password('Password', ['placeholder' => 'Enter Password *', 'class' => 'form-control', 'id' => 'Password', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Order Free Trial</button>
                        </div>
                        {!! FORM::close() !!}
                    </div>
                </div>

        </div>



        </div>

        <!--Services-->
        <section id="services" class="three">
            <div class="container">
                <div class="row">
<!--                    <div class="col-sm-12 service-block text-center">
                        <h3 class="animate-in move-up">We are in the service since 2008.</h3>
                        <p class="animate-in move-up">
                            LogoArtz provides best logo design, digitizing, raster to vector services in market, with best prices <br>
                            and discounts. Our team is well experienced in everything digital, and we provide the best possible results  <br>
                            with attention to detail. Best prices and fastest turnaround guaranteed! Do not hesitate a second to contact 
                            <br>us and find out about our deals. To see the quality of our raster to vector service, just apply for our free first logo. </p>

                        <img src="{{ asset('assets/web/images/logo.gif" class="signature animate-in move-up" alt="Signature">
                    </div>-->






                    <!-- <div class="product_bar">
                    <div class="red_bar_txt">
                    <h3>Get your first design</h3>
                    <h2>free!</h2>
                    <h4>Upto $30 value. No credit card required.</h4>
                    </p></div>
                    <div class="white_text">
                    <p class="white_text_p1"><strong>Free Trial offer:</strong> We believe in building long-lasting</p>
                    <p class="white_text_p2">relationships with our customers, not a one-time deal. </p>
                    <p class="white_text_p3">So, your first order is free.</p>
                    </div>
                    <div class="product_bar_btn"> <a href="https://qualitypunch.net/FreeDesignRegistration.aspx">Upload Your Design</a> </div>
                    </div>
                    <div class="product_item home_vector"> <img id="" alt="Vector Art for Screen Printing" src="./wp-content/themes/twentyfifteen/assets/images/vector_product.png" style="border-width:0px;"/> </p> -->




                    <div class="col-sm-12" style="margin-bottom: 30px">

                        <img src="{{ asset('assets/web/images/Digitizing.jpg') }}">

                    </div>

                    <!-- 
                                        <div class="col-sm-10 col-sm-offset-1 video text-center animate-in fade-in">
                                            <div class="inner">
                                                <img src="{{ asset('assets/web/images/banner-3.png" alt="video">
                                                <iframe class="lightbox" src="https://www.youtube.com/watch?v=4rKY--qi9aI" width="780" height="440" id="fl3" style="border:none;" allowfullscreen=""></iframe>
                                                <div class="hover center">
                                                    <div class="inner">
                                                        <a href="#" data-featherlight="#fl3"><i class="icofont icofont-play-alt-2"></i></a>
                                                        <h3>Watch our story</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                    <div class="service-base col-sm-12 no-padding">
                        <div class="col-sm-4 service-block text-center animate-in move-up">
                            <img src="{{ asset('assets/web/images/vectar.png" alt="service">
                            <h4><a href="#">Vector</a> </h4>
                            <p>Vector tracing is ideal to for logos, brouchers, billbaords, visitcards, computer-controlled sewing machines, animations, creative art, printing and more.</p>
                        </div>
                        <div class="col-sm-4 service-block text-center animate-in move-up">
                            <img src="{{ asset('assets/web/images/service-layers.png" alt="service">
                            <h4><a href="#">Digitizing</a> </h4>
                            <p>Onsistently unmatched quality - that's the Logo Artz Promise! Smoother production runs and a beautiful embroidered piece Sew outs of every file done here before sending.</p>
                        </div>
                        <div class="col-sm-4 service-block text-center animate-in move-up">
                            <img src="{{ asset('assets/web/images/Wd.png" alt="service">
                            <h4><a href="#">Web Development</a> </h4>
                            <p>Put the Internet to work for you with our rich web app development services. We use rapid development methodologies incorporating MVC frameworks (Laravel, CakePHP) and interactive Javascript-based frontends.</p>
                        </div>
                        <div class="col-sm-4 service-block text-center animate-in move-up">
                            <img src="{{ asset('assets/web/images/smm.png" alt="service">
                            <h4><a href="#">Digital Media Marketing</a> </h4>
                            <p>Social media marketing is a powerful way for businesses of all sizes to reach prospects and customers. Your customers are already interacting with brands through social media, and if you're not speaking directly to your audience through social platforms like Facebook, Twitter, Instagram, and Pinterest, you're missing out!</p>
                        </div>
                        <div class="col-sm-4 service-block text-center animate-in move-up">
                            <img src="{{ asset('assets/web/images/service-devices.png" alt="service">
                            <h4><a href="#"></a>Mobile Application </h4>
                            <p>Leverage the power of portable computing with mobile apps that offer users a seamless experience-whichever device they use. We've been building award-winning apps across multiple niches for mobile operating systems from the Symbian and Blackberry days right up to Android and iOS.</p>
                        </div>
                        <div class="col-sm-4 service-block text-center animate-in move-up">
                            <img src="{{ asset('assets/web/images/shield.png" alt="service">
                            <h4><a href="#">Secured Service</a> </h4>
                            <p>We will provide you complete confident for your confidential data</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--action 1-->
        <!--<section class="action-3">-->
        <!--    <div class="container-fluid">-->
        <!--        <div class="row">-->
                    <!--main heading-->
        <!--            <div class="main-heading two col-sm-12 no-padding text-center owl-carousel owl-theme action_3-slider">-->
        <!--                <div class="item blue space-top">-->
        <!--                    <h2 class="animate-in move-up">Vector Art</h2>-->
        <!--                    <p class="animate-in move-up">-->
        <!--                        Vector Tracing is a photo editing technique that converts bitmap images (.bmp,.jpg,.png,e.t.c.) into vectors -->
        <!--                        <br>(.SVG or Scalable Vector Graphics) and is provided as service by photo editors using the appropriate photo -->
        <!--                        <br>editing tools such as Adobe Illustrator (A.I.) or Corel Draw. Not every photo editing tool can convert bitmap images to vectors.</p>-->
        <!--                    <img src="{{ asset('assets/web/images/cal-to-action-4.png" class="animate-in move-up" alt="Call To Action">-->
        <!--                </div>-->
        <!--                <div class="item green space-top">-->
        <!--                    <h2 class="animate-in move-up">Digitizing</h2>-->
        <!--                    <p class="animate-in move-up">Branding and Marketing is the motto of the 21st century. It was all about businesses, then this decade, -->
        <!--                        <br>it became more personal and about individuals as well. One thing that speaks more than anything about personal  -->
        <!--                        <br>brand and identity is logo, a literal visual representation of a person or organization's unique brand. Companies -->
        <!--                        <br>like Nike and it's 'swoosh' and a 'bitten apple' for Apple have become iconic in themselves and have become -->
        <!--                        <br>cultural icons than just ordinary logos.</p>-->
        <!--                    <img src="{{ asset('assets/web/images/cal-to-action-4.png" class="animate-in move-up" alt="Call To Action">-->
        <!--                </div>-->

        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!--action 2-->
        
        <!--<section class="space action-4">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-sm-6 action-block">-->
        <!--                <img src="{{ asset('assets/web/images/vectorBn.jpg') }}" alt="call to action">-->
        <!--            </div>-->
        <!--            <div class="col-sm-6 action-block">-->
        <!--                <div class="main-heading col-sm-12 no-padding animate-in move-up">-->
        <!--                    <h3>Looking for Logos, Vector Art, Embroidery or Digitizing? We got you covered!-->
        <!--                        <br></h3>-->
        <!--                    <p></p>-->
        <!--                </div>-->
        <!--                <div class="col-sm-12 no-padding features">-->
        <!--                    <div class="feature-block col-m-12 no-padding animate-in move-up">-->
        <!--                        <div class="numbering"><span>1</span></div>-->
        <!--                        <div class="feature-info">-->
        <!--                            <h4>Vector Art</h4>-->
        <!--                            <p>Vector is the ideal format for logos, as they can be used in websites, company cards, and can be printed in any scale from a tiny picture to a billboard advertisement.</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="feature-block col-m-12 no-padding animate-in move-up">-->
        <!--                        <div class="numbering"><span>2</span></div>-->
        <!--                        <div class="feature-info">-->
        <!--                            <h4>Digitizing</h4>-->
        <!--                            <p>For supreme quality digitizing and finally less taxing customized Logo embroidery digitizing and other such similar things get in touch with us right away.</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

    





    <!--<section class="space action one border-top-center">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center action-block animate-in fade-in">-->
    <!--                <h3>Looking for the best digitizing service?-->
    <!--                <span>The service you want is here!</span></h3>-->
    <!--                <a href="#" class="btn radius-2x blue-btn hvr-bounce-to-right">Get Quote</a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->



    <section id="price-plans" class="space-bottom two">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 price-block text-center animate-in fade-in">
                    <div class="inner">
                        <div class="price">$25</div>
                        <p>Premium</p>
                        <h3>Complicated</h3>
                        <ul>
                            <li>Urgent Service</li>
                            <li>Format Conversions</li>
                            <li>Minor Editing</li>
                            <li>Major Editing (Minor Fee)</li>
                            <!-- <li>4/7 Customer Support</li> -->
                        </ul>
                        <a href="#" class="simple">Get Quote<i class="icofont icofont-simple-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-4 price-block featured text-center animate-in fade-in">
                    <div class="inner">
                        <div class="price">$15</div>
                        <p>Simple</p>
                        <h3>Simple</h3>
                        <ul>
                             <li>Urgent Service</li>
                            <li>Format Conversions</li>
                            <li>Minor Editing</li>
                            <li>Major Editing (Minor Fee)</li>
                        </ul>
                        <a href="#" class="simple">Get Quote<i class="icofont icofont-simple-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-4 price-block text-center animate-in fade-in">
                    <div class="inner">
                        <div class="price">$50/</div>
                        <p>Standard</p>
                        <h3>Advance</h3>
                        <ul>
                             <li>Urgent Service</li>
                            <li>Format Conversions</li>
                            <li>Minor Editing</li>
                            <li>Major Editing (Minor Fee)</li>
                        </ul>
                        <a href="#" class="simple">Get Quote<i class="icofont icofont-simple-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-12 price-plan-text text-center no-padding animate-in fade-in">
                    <h3>We don’t have any hidden charge.
              <!--       <br>You can choose your suitable plan as you want.</h3> -->
                </div>
            </div>
        </div>
    </section>










    <section id="testimonial" class=" space-top two bg" data-stellar-background-ratio="0.8">
        <div class="container">
            <!--main heading-->
            <div class="main-heading two col-sm-12 no-padding text-center animate-in fade-in">
                <h2>What our customers say</h2>
                <p>See what our beloved customers say about our services</p>
            </div>
            <div class="row">
                <div class="col-sm-12 testimonial-base space-bottom">
                    <div class="owl-carousel owl-theme" id="testi-slider">
                        <div class="item">
                            <div class="col-sm-4 testimonial-block animate-in fade-in">
                                <span class="quotation-sign">“</span>
                                <p>After seeing results from LogoArtz for digitizing of my logo! I love it. I was amazed at the quality and accuracy these guys provide. Absolutely wonderful!.</p>
                                <div class="name">- Danita O</div>
                            </div>
                            <div class="col-sm-4 testimonial-block animate-in fade-in">
                                <span class="quotation-sign">“</span>
                                <p>Turnaround time is wonderful, quality is amazing. Attention to detail is flawless. I wouldn’t change a thing!.</p>
                                <div class="name">- Dasya R.</div>
                            </div>
                             <div class="col-sm-4 testimonial-block animate-in fade-in">
                                <span class="quotation-sign">“</span>
                                <p>I will recommend you to my colleagues.</p>
                                <div class="name">- Rees Z</div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-4 testimonial-block animate-in fade-in">
                                <span class="quotation-sign">“</span>
                                <p>After seeing results from LogoArtz for digitizing of my logo! I love it. I was amazed at the quality and accuracy these guys provide. Absolutely wonderful!.</p>
                                <div class="name">- Danita O</div>
                            </div>
                            <div class="col-sm-4 testimonial-block animate-in fade-in">
                                <span class="quotation-sign">“</span>
                                <p>Thanks guys, keep up the good work! Great job, I will definitely be ordering again!.</p>
                                <div class="name">- Benetta R.</div>
                            </div>
                         
                            <div class="col-sm-4 testimonial-block animate-in fade-in">
                                <span class="quotation-sign">“</span>
                                <p>I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much.</p>
                                <div class="name">- David Garok</div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--<div class="col-sm-12 action one space border-top-center">-->
                <!--    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center action-block animate-in fade-in">-->
                <!--        <h3>Looking for the best vector service?-->
                <!--        <span>The service you want is here!</span></h3>-->
                <!--        <a href="#" class="btn radius-2x blue-btn hvr-bounce-to-right">Get Quote</a>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </section>



        
        <!--action 3-->
      <!--   <section class="action-5 space-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 action-base no-padding">
                        <div class="col-sm-6 main-heading center animate-in move-up">
                            <div class="inner">
                                <h3>The blueprint of your successful
                            <br>online business.</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugi at nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 action-block text-right animate-in fade-in">
                            <img src="images/cal-to-action-6.png" alt="call to action">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Action 4-->
    <!--     <section class="space-bottom action bg one">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-center action-block">
                        <h3 class="animate-in move-up">Want to lift your business to top?</h3>
                        <p class="animate-in move-up">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                            <br>nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        <a href="#" class="btn radius-2x green-btn hvr-bounce-to-right animate-in move-up">Get started now</a>
                    </div>
                </div>
            </div>
        </section>  -->
        <!--price plans-->
        <!-- <section id="price-plans" class="space-bottom three">
            <div class="container">
        <!--main heading-->
        <!--             <div class="main-heading two col-sm-12 no-padding text-center animate-in move-up">
                        <h2>See our pricing & plans</h2>
                        <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse
                            <br>molestie consequat, vel illum dolore eu feugiat.</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 price-block text-center animate-in move-up">
                            <div class="inner">
                                <h4>Basic</h4>
                                <div class="price">$150/<span>mo</span></div>
                                <h6>best for startup</h6>
                                <p>Lorem ipsum dolor sit amet, consec
                                    <br>tuer adipiscing elit, sed diam nonummy
                                    <br>euismod tincidunt ut laoreet dolore ma
                                    <br>aliquam erat volutpat.</p>
                                <a href="#" class="btn radius-2x green-btn hvr-bounce-to-right">Start Now<i class="icofont icofont-simple-right"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-4 price-block featured text-center animate-in move-up">
                            <div class="inner">
                                <h4>Business</h4>
                                <div class="price">$299/<span>mo</span></div>
                                <h6>best for startup</h6>
                                <p>Lorem ipsum dolor sit amet, consec
                                    <br>tuer adipiscing elit, sed diam nonummy
                                    <br>euismod tincidunt ut laoreet dolore ma
                                    <br>aliquam erat volutpat.</p>
                                <a href="#" class="btn radius-2x green-btn hvr-bounce-to-right">Start Now<i class="icofont icofont-simple-right"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-4 price-block text-center animate-in move-up">
                            <div class="inner">
                                <h4>Standard</h4>
                                <div class="price">$150/<span>mo</span></div>
                                <h6>best for startup</h6>
                                <p>Lorem ipsum dolor sit amet, consec
                                    <br>tuer adipiscing elit, sed diam nonummy
                                    <br>euismod tincidunt ut laoreet dolore ma
                                    <br>aliquam erat volutpat.</p>
                                <a href="#" class="btn radius-2x green-btn hvr-bounce-to-right">Start Now<i class="icofont icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>  -->
        <!--Testimonial-->
        <section id="testimonial" class="space-bottom three">
            <div class="container">
                <!--main heading-->
                <!--<div class="main-heading two col-sm-12 no-padding text-center animate-in move-up">-->
                <!--    <h2>What our clients say</h2>-->
                <!--    <p>-->
                <!--        <br></p>-->
                <!--</div>-->
                
        
                <!-- Testimonial Start ---->        
                
                <!--<div class="row">-->
                <!--    <div class="col-sm-12 no-padding testimonial-base">-->
                <!--        <div class="owl-carousel owl-theme" id="testi-slider">-->
                <!--            <div class="item">-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-businessman.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Danita O</a> </h3>-->
                                    <!--  <div class="profession">Businessman</div> -->
                <!--                    <p>"After seeing results from LogoArtz for digitizing of my logo! I love it. I was amazed at the quality and accuracy these guys provide. Absolutely wonderful!"</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-disc-jockey.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Usama</a> </h3>-->
                                    <!-- <div class="profession">Musician</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-journalist.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Ronny Haron</a> </h3>-->
                                    <!-- <div class="profession">Accountant</div>   -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-maid.png" alt="Testimonial">-->
                <!--                    <h3><a href="#"> Rees Z.-->
                <!--                        </a> </h3>-->
                                    <!-- <div class="profession">Freelancer</div> -->
                <!--                    <p>"I will recommend you to my colleagues."</p>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="item">-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-businessman.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Martin Jones</a> </h3>-->
                                    <!-- <div class="profession">Businessman</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-disc-jockey.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Dj Rozer</a> </h3>-->
                                    <!--   <div class="profession">Musician</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-journalist.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Ronny Haron</a> </h3>-->
                                    <!--   <div class="profession">Accountant</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-maid.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">David Garok</a> </h3>-->
                                    <!--   <div class="profession">Freelancer</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="item">-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-businessman.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Martin Jones</a> </h3>-->
                                    <!--    <div class="profession">Businessman</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-disc-jockey.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Dj Rozer</a> </h3>-->
                                    <!--       <div class="profession">Musician</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-journalist.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">Ronny Haron</a> </h3>-->
                                    <!--    <div class="profession">Accountant</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--                <div class="col-sm-3 testimonial-block text-center">-->
                <!--                    <img src="{{ asset('assets/web/images/testimonial-maid.png" alt="Testimonial">-->
                <!--                    <h3><a href="#">David Garok</a> </h3>-->
                                    <!--     <div class="profession">Freelancer</div> -->
                <!--                    <p>"I give you many thanks because you have improved our work. Logo Artz is a beautiful company.We believe very much in the future to work with you.Thank You very much."</p>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                
                <!-- Testimonial Close ---->
                
                
                
                    <!--        <div class="col-sm-12 button text-center animate-in move-up">
                               <a href="#" class="simple">See all testimonials</a>
                           </div>
                       </div> -->
                </div>
        </section>
        <!--Blog-->
        <!-- <section id="blog" class="space bg-color">
            <div class="container">
        <!--main heading-->
        <!--  <div class="main-heading two col-sm-12 no-padding text-center animate-in move-up">
             <h2>Check recent case study</h2>
             <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse
                 <br>molestie consequat, vel illum dolore eu feugiat.</p>
         </div>
         <div class="row">
             <div class="col-sm-4 blog-block animate-in move-up">
                 <img src="images/blog-1.png" alt="blog">
                 <h4><a href="#">Digital Marketing for Construction
                 <br>company for reaching online customers.</a> </h4>
                 <ul>
                     <li><i class="icofont icofont-ui-user"></i>Fractal Construction</li>
                     <li><i class="icofont icofont-social-google-map"></i>New York</li>
                 </ul>
             </div>
             <div class="col-sm-4 blog-block animate-in move-up">
                 <img src="images/blog-2.png" alt="blog">
                 <h4><a href="#">Digital Marketing for Construction
                 <br>company for reaching online customers.</a> </h4>
                 <ul>
                     <li><i class="icofont icofont-ui-user"></i>Fractal Construction</li>
                     <li><i class="icofont icofont-social-google-map"></i>New York</li>
                 </ul>
             </div>
             <div class="col-sm-4 blog-block animate-in move-up">
                 <img src="images/blog-3.png" alt="blog">
                 <h4><a href="#">Digital Marketing for Construction
                 <br>company for reaching online customers.</a> </h4>
                 <ul>
                     <li><i class="icofont icofont-ui-user"></i>Fractal Construction</li>
                     <li><i class="icofont icofont-social-google-map"></i>New York</li>
                 </ul>
             </div>
         </div>
     </div> -->
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
