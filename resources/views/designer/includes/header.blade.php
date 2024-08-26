<?php
$segment = Request::segment(2);
$segment2 = Request::segment(3);

$customers = ["customers"];
$profile = ["profile"];
$conf = ["configuration"];
$OrdHis = ["orderHistory"];

$did = \Session::get('Dcatagory');
             

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
                <a href="{{ url('admin') }}" class="navbar-brand"><span class="logo-lg"><img class="img-responsive" src="{{ asset('assets/admin/images/header-logo-v2.png') }}" style="height: 49px;margin-top: 4px; margin: 0 auto;"></span></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="<?php echo ($segment == "dashboard" ? 'active' : '') ?>"><a href="{{ url('designer/dashboard') }}">Dashboard</a></li>
                    <li class="<?php echo ($segment == "orderHistory" ? 'active' : '') ?>"><a href="{{ url('designer/summary') }}">Order History</a></li>
                    
                    
                    <?php   
                    
                    if(!empty($did)){
                    if($did == 2){ 
                    ?>
                    
                    <li class="<?php echo ($segment == "digi" ? 'active' : '') ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Digitizing<span class="label label-menu">{{ $digineworders!=0 ? $digineworders : ''}}</span><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('designer/digi/0') }}">New Order<span class="label label-menu">{{ $diginewordersonly !=0 ? $diginewordersonly : ''}}</span></a></li>
                            <li><a href="{{ url('designer/digi/1') }}">Order Revision<span class="label label-menu">{{ $diginewquotesonly !=0 ? $diginewquotesonly : ''}}</span></a></li>
                            <li><a href="{{ url('designer/digi/quote/0') }}">New Quote<span class="label label-menu">{{ $diginewordersonly !=0 ? $diginewordersonly : ''}}</span></a></li>
                            <li><a href="{{ url('designer/digi/quote/1') }}">Quote Revision<span class="label label-menu">{{ $diginewquotesonly !=0 ? $diginewquotesonly : ''}}</span></a></li>
                        </ul>
                    </li>
                    
                    <?php  }else{  ?>
                    
                    
                    <li class="<?php echo ($segment == "vector" ? 'active' : '') ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vector<span class="label label-menu">{{ $vectorneworders !=0 ? $vectorneworders : ''}}</span><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('designer/vector/0') }}">New Order<span class="label label-menu">{{ $vectornewordersonly !=0 ? $vectornewordersonly : ''}}</span></a></li>
                            <li><a href="{{ url('designer/vector/1') }}">Order Revision<span class="label label-menu">{{ $vectororderrev !=0 ? $vectororderrev : ''}}</span></a></li>
                            <li><a href="{{ url('designer/vector/quote/0') }}">New Quote<span class="label label-menu">{{ $vectornewquotesonly !=0 ? $vectornewquotesonly : ''}}</span></a></li>
                            <li><a href="{{ url('designer/vector/quote/1') }}">Quote Revision<span class="label label-menu">{{ $vectorquoterev !=0 ? $vectorquoterev : ''}}</span></a></li>
                        </ul>
                    </li>
                    
                    
                    <?php } }  ?>
                    
                    

                    <li class="<?php echo ($segment == "acc/accounts" ? 'active' : '') ?>"><a href="{{ url('designer/acc/accounts') }}">Accounts</a></li>
                    
                  
              
                    <li class="<?php echo (in_array($segment, $profile) ? ' active' : '') ?>"><a href="{{ url('designer/profile') }}">Profile</a></li>
                </ul>
            </div>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if (\Session::get('DesignerProfilePicture') != "" && \Session::get('DesignerProfilePicture') != null) { ?>
                                {!! \Html::image('/uploads/designer/' . \Session::get('DesignerProfilePicture'), \Session::get('DesignerProfilePicture'), ['class' => 'user-image' ]) !!}
                            <?php } else { ?>
                                <img src="{{ asset('assets/admin/dist/img/avatar.png') }}" class="user-image" alt="User Image">
                            <?php } ?>
                            <span class="hidden-xs"><?php echo \Session::get('DesignerName'); ?></span> </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                     

                       <?php if (\Session::get('DesignerProfilePicture') != "" && \Session::get('DesignerProfilePicture') != null) { ?>
                              {!! \Html::image('/uploads/designer/' . \Session::get('DesignerProfilePicture'), \Session::get('DesignerProfilePicture'), ['class' => 'user-image' ]) !!}
                       <?php } else { ?>   

                                 <img src="{{ asset('assets/admin/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
                                <?php } ?>

                                <p> <?php echo \Session::get('DesignerName'); ?> </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left"> <a href="{{ url('designer/profile') }}" class="btn btn-default btn-flat">Profile</a> </div>
                                <div class="pull-right"> <a href="{{ url('designer/logout') }}" class="btn btn-default btn-flat">Sign out</a> </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
