<?php
$segment = Request::segment(2);
$segment2 = Request::segment(3);

$profile = ["profile"];
$sliders = ["sliders"];
$clilentlogos = ["client-logos"];
$categories = ["categories"];
$products = ["products"];
$events = ["events"];
$contacts = ["contacts"];
$conf = ["configuration"];
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <?php if (\Session::get('AdminProfilePicture') != "" && \Session::get('AdminProfilePicture') != null) { ?>
                    {!! \Html::image('/uploads/administrators/' . \Session::get('AdminProfilePicture'), \Session::get('AdminProfilePicture'), ['class' => 'img-circle' ]) !!}
                <?php } else { ?>
                    <img src="{{ asset('assets/admin/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?php echo \Session::get('AdminFullName'); ?></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="treeview<?php echo ($segment == " dashboard" ? 'active' : '') ?>"> <a href="{{ url('admin/dashboard') }}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $sliders) ? ' active' : '') ?>"> <a href="{{ url('admin/sliders') }}"> <i class="fa fa-image"></i> <span>Sliders</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $clilentlogos) ? ' active' : '') ?>"> <a href="{{ url('admin/client-logos') }}"> <i class="fa fa-image"></i> <span>Client Logos</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $categories) ? ' active' : '') ?>"> <a href="{{ url('admin/categories') }}"> <i class="fa fa-list"></i> <span>Categories</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $products) ? ' active' : '') ?>"> <a href="{{ url('admin/products') }}"> <i class="fa fa-list"></i> <span>Products</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $events) ? ' active' : '') ?>"> <a href="{{ url('admin/events') }}"> <i class="fa fa-calendar"></i> <span>Events</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $contacts) ? ' active' : '') ?>"> <a href="{{ url('admin/contacts') }}"> <i class="fa fa-book"></i> <span>Contacts</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $profile) ? ' active' : '') ?>"> <a href="{{ url('admin/profile') }}"> <i class="fa fa-user"></i> <span>Profile</span> </a> </li>
            <li class="treeview<?php echo (in_array($segment, $conf) ? ' active' : '') ?>"> <a href="{{ url('admin/configuration') }}"> <i class="fa fa-cog"></i> <span>Configuration</span> </a> </li>
            <li> <a href="{{ url('admin/logout') }}"> <i class="fa fa-power-off"></i> <span>Sign Out</span> </a> </li>
        </ul>
    </section>
</aside>
