<?php
$segment = Request::segment(2);
$segment2 = Request::segment(3);

$customers = ["customers"];
$profile = ["profile"];
$conf = ["configuration"];
$summary = ["Summary"];
$designers = ["Designers"];
$inv = ["Invoice"];
$salesperson = ["salesperson"];
$sales_cat = "";
$accounts = ["accounts"];
?>
<style>
    .skin-blue .main-header .navbar .nav>li>a:hover .label, .skin-blue .main-header .navbar .nav>li>a:active .label, .skin-blue .main-header .navbar .nav>li>a:focus .label, .skin-blue .main-header .navbar .nav .open>a .label, .skin-blue .main-header .navbar .nav .open>a:hover .label, .skin-blue .main-header .navbar .nav .open>a:focus .label, .skin-blue .main-header .navbar .nav>.active>a .label{
        background: #212c31 !important;
    }
    .label-menu{
        top: 7px !important;
        right: 4px !important;
        border-radius: 50%;
        background: rgb(237, 28, 36);
    }
</style>
<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">

            <div class="navbar-header">
                <a href="{{ url('salesperson') }}" class="navbar-brand"><span class="logo-lg"><img class="img-responsive" src="{{ asset('assets/admin/') }}/images/header-logo-v2.png" style="height: 49px;margin-top: 4px; margin: 0 auto;"></span></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="<?php echo ($segment == "dashboard" ? 'active' : '') ?>"><a href="{{ url('salesperson') }}">Dashboard</a></li>

              


               <li class="<?php echo (in_array($segment, $customers) ? ' active' : '') ?>"><a href="{{ url('salesperson/customers') }}">Customers</a></li>

                      <li class="<?php echo (in_array($segment, $summary) ? ' active' : '') ?>"><a href="{{ url('salesperson') }}/summary">Summary</a></li>
             


            
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Digitizing <span class="caret"></span><span class="label label-menu"></span></a>


                         <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('salesperson') }}/digi/orders/0">Order<span class="label label-menu">{{ $digineworders!=0 ? $digineworders : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/digi/orders/3">Free Order<span class="label label-menu">{{ $new_digi_free_orders !=0 ? $new_digi_free_orders : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/digi/orders/9">Free Order Revision<span class="label label-menu">{{ $new_digi_free_rivision !=0 ? $new_digi_free_rivision : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/digi/orders/1">Order Revision<span class="label label-menu">{{ $digiorder_rev!=0 ? $digiorder_rev : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/digi/orders/2">Quote<span class="label label-menu">{{ $diginewquotes!=0 ? $diginewquotes : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/digi/orders/4">Quote Revision<span class="label label-menu">{{ $digiquote_rev!=0 ? $digiquote_rev : ''}}</span></a></li>
                        
                        </ul>
                               </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vector <span class="caret"></span><span class="label label-menu"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('salesperson') }}/vector/orders/0">Order<span class="label label-menu">{{ $vectorneworders!=0 ? $vectorneworders : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/vector/orders/3">Free Order<span class="label label-menu">{{ $new_vector_free_orders !=0 ? $new_vector_free_orders : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/vector/orders/9">Free Order Revision<span class="label label-menu">{{ $new_vector_free_rivision !=0 ? $new_vector_free_rivision : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/vector/orders/1">Order Revision<span class="label label-menu">{{ $vectororder_rev !=0 ? $vectororder_rev : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/vector/orders/2">Quote<span class="label label-menu">{{ $vectornewquotes!=0 ? $vectornewquotes : ''}}</span></a></li>
                            <li><a href="{{ url('salesperson') }}/vector/orders/4">Quote Revision<span class="label label-menu">{{ $vectorquote_rev!=0 ? $vectorquote_rev : ''}}</span></a></li>
                         
                        </ul>
                            


                    </li>

                  
                      <li class="<?php echo (in_array($segment, $accounts) ? ' active' : '') ?>"><a href="{{ url('salesperson/accounts_summary') }}">Accounts</a></li>

           
                 <!--    <li class="<?php echo (in_array($segment, $conf) ? ' active' : '') ?>"><a href="#">Accounts</a></li> -->
                    <li class="<?php echo (in_array($segment, $profile) ? ' active' : '') ?>"><a href="{{ url('salesperson/profile') }}">Profile</a></li>
                
                </ul>
            </div>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if (\Session::get('SalesPersonPicture') != "" && \Session::get('SalesPersonPicture') != null) { ?>
                                {!! \Html::image('/uploads/salesperson/' . \Session::get('SalesPersonPicture'), \Session::get('SalesPersonPicture'), ['class' => 'user-image' ]) !!}
                            <?php } else { ?>
                                <img src="{{ asset('assets/admin/') }}/dist/img/avatar.png" class="user-image" alt="User Image">
                            <?php } ?>
                            <span class="hidden-xs"><?php echo \Session::get('SalesPersonName'); ?></span> </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                     

                       <?php if (\Session::get('SalesPersonPicture') != "" && \Session::get('SalesPersonPicture') != null) { ?>
                              {!! \Html::image('/uploads/salesperson/' . \Session::get('SalesPersonPicture'), \Session::get('SalesPersonPicture'), ['class' => 'user-image' ]) !!}
                       <?php } else { ?>   

                                 <img src="{{ asset('assets/admin/') }}/dist/img/avatar.png" class="img-circle" alt="User Image">
                                <?php } ?>

                                <p> <?php echo \Session::get('SalesPersonName'); ?> </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left"> <a href="{{ url('salesperson/profile') }}" class="btn btn-default btn-flat">Profile</a> </div>
                                <div class="pull-right"> <a href="{{ url('salesperson/logout') }}" class="btn btn-default btn-flat">Sign out</a> </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

