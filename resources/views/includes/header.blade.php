<style>
    .label-menu{
        position: absolute;
        top: 10px !important;
        left: 162px !important;
    }
    .l-70{
        left: 70px !important
    }
    .l-50{
        right: -15px !important;
        left: auto !important;
    }
</style>
<!-- <div id="preloader">
    <div class="wrapper">
        <div class='circle'>
            <div class="circle-cutter"></div>
            <div class="circle-inner"></div>
        </div>
    </div>
    <footer>
        <p>Logo Artz Art And Digitizing. All Rights Reserved</p>
    </footer>
</div> -->
<!--Top bar-->
<section id="topbar">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 topbar-block">
                <ul>
                    <li><a href="#"><i class="icofont icofont-phone"></i>Available: Mon-Sat - 24/7</a> </li>
                    <li><a href="#"><i class="icofont icofont-envelope"></i>info@logoartz.com</a> </li>
                    <li><a href="#"><i class="icofont icofont-social-google-map"></i>New York</a> </li>
                </ul>
            </div>
            <div class="col-sm-4 topbar-block text-right">
                <ul>
                    <?php
                    if (\Session::has('CustomerLogin')) {
                        ?>
                        <li><a href="{{ url('CustomerDash')}}">Dashboard </a> </li>
                        
                        <li style="color: #fff;">Welcome, {{ \Session::get('CustomerName') }}</li> 
                        <li><a href="{{ url('logout') }}">logout | </a> </li>
                        <?php
                    } else {
                        ?>
                        <li><a href="{{ url('register') }}">Sign Up |</a> </li>
                        <li><a href="{{ url('login') }}">Customer LogIn</a> </li>
                        <?php
                    }
                    ?>

                  
                </ul>
            </div>
        </div>
    </div>
</section>
<!--Header-->
<header class="header-3"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <nav class="navbar active" data-spy="affix" data-offset-top="1" id="slide-nav">
        <div class="container">
            <div class="navbar-header col-sm-3 col-md-3 col-xs-12">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <span class="img">
                    <?php
                        if (\Session::has('CustomerLogin')) {
                     ?>
                     <a href="{{url('/CustomerDash')}}">
                    <!--<img src="{{ asset('assets/web/images/logo.png')}}"  alt="LogoArtz">-->
                    <img src="{{ asset('assets/admin/images/Logo_artz_logo_new.png') }}" height="52"  alt="LogoArtz">
                    </a>
                   <?php }else{ ?>
                      <a href="{{url('/')}}">
                     <!--<img src="{{ asset('assets/web/images/logo.png')}}" alt="LogoArtz">-->
                     <img src="{{ asset('assets/admin/images/Logo_artz_logo_new.png') }}" height="53"  alt="LogoArtz">
                      </a>
                   <?php  } ?>

                </span>
            </div>
            <!--Nav links-->
            <div class=" navbar-collapse col-sm-9 col-md-9" id="menu_nav">
                <a href="#" class="closs"><i class="icofont icofont-close-line"></i></a>
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                          <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                        <a href="{{ url('/CustomerDash')}}">Home</a>
                    <?php }else{ ?>
                             <!--<a href="{{ url('/')}}">Home</a>-->
                        <a href="https://www.logoartz.com">Home</a>
                    <?php } ?>



                        <!--     <ul class="dropdown-menu">
                                <li><a href="#">Home Web Design</a> </li>
                                <li><a href="#">Home Digital Marketing</a> </li>
                                <li><a href="#">Home Web Hosting</a> </li>
                                <li><a href="#">Home Portfolio</a> </li>
                            </ul> -->
                    </li>


                      <?php
//                        if (\Session::has('CustomerLogin')) {
                            ?>
                  
                    <!--<li><a href="#"></a></li>-->

                    <?php // } ?>


                    <li class="dropdown">
                        <a href="{{ url('/digi-order') }}">Digitizing <?= $totaldigis != 0 ? '<span class="label label-success l-50">'.$totaldigis.'</span>' : '' ?></a>
                        <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                          <ul class="dropdown-menu">
                                <li class="dropdown left">
                                    <a href="{{ url('/digi-order')}}">Place Digitizing Order</a> 
                                </li>

                                <li class="dropdown left">
                                    <a href="{{ url('/digi_quote') }}">Place Digitizing Quote</a>
                                  </li>

                                  <li class="dropdown left">
                                    <a href="{{ url('my_digis/quote') }}">Digitizing Quotes <?= $newdigiorders != 0 ? '<span class="label label-success label-menu">'.$newdigiorders.'</span>' : '' ?></a>
                                  </li>
                                  <li class="dropdown left">
                                    <a href="{{ url('my_digis/all') }}">Digitizing Orders <?= $mydigis != 0 ? '<span class="label label-success label-menu">'.$mydigis.'</span>' : '' ?></a>
                                  </li>
                            </ul> 
                            <?php
                        }
                        ?>
                    </li>
                    
                    
                    
                    <li class="dropdown">
                        <a href="{{ url('/vector_portfolio') }}">Vector <?= $totalvectors != 0 ? '<span class="label label-success l-50">'.$totalvectors.'</span>' : '' ?></a>
                          <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                          <ul class="dropdown-menu">
                                <li class="dropdown left">
                                    <a href="{{ url('/vector-order')}}">Place Vector Order</a> 
                                </li>

                                <li class="dropdown left">
                                    <a href="{{ url('/vector_quote') }}">Place Vector Quote</a>
                                  </li>

                                  <li class="dropdown left">
                                    <a href="{{ url('my_vectors/quote') }}">Vector Quotes <?= $newvectororders != 0 ? '<span class="label label-success label-menu">'.$newvectororders.'</span>' : '' ?></a>
                                  </li>
                                  <li class="dropdown left">
                                    <a href="{{ url('my_vectors/all') }}">Vector Orders <?= $myvectors != 0 ? '<span class="label label-success label-menu">'.$myvectors.'</span>' : '' ?></a>
                                  </li>
                            </ul> 
                            <?php
                        }
                        ?>
                              
                    </li>



                   <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                         
                           <li class="dropdown">
                                <a href="{{ url('accounts_summary') }}">Invoices</a>
                            </li>
                            <?php
                        } else {

                        ?>
                    
            <li class="dropdown">
                        <a href="{{ url('/logoartz_portfolio') }}">Our Work</a>
                        <!--<a href="#">Our Work</a>-->
                    </li>

                       <li><a href="{{ url('/about') }}">About</a></li>

            <?php } ?>

                        <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>

                    <li class="dropdown">
                        <a href="{{ url('/CustomerInfo/Update') }}">Profile</a>   
                    </li>

            <?php  } else{ ?>


                 <li class="dropdown">
                        <a href="{{ url('/contactus') }}">Contact Us</a>   
                    </li>

            <?php } ?>


        <!-- SEARCH BAR ---> 
                    <!--<li class="dropdown search">-->
                    <!--    <a href="#"><i class="icofont icofont-search"></i></a>-->
                    <!--    <ul class="dropdown-menu">-->
                    <!--        <li>-->
                    <!--            <form class="navbar-form" action="#" method="post">-->
                    <!--                <div class="form-group">-->
                    <!--                    <input type="text" class="form-control" name="search" placeholder="Search...">-->
                    <!--                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>-->
                    <!--                </div>-->
                    <!--            </form>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                <!--     <li><a href="#"><i class="icofont icofont-cart"></i><span>2</span></a></li> -->
                </ul>
            </div>
            <!--/.navbar-collapse-->
        </div>
    </nav>
</header>