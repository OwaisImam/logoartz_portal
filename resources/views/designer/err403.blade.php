<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>USoft | Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="{{ asset('assets/admin/') }}/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper"> @include('admin/includes/header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('admin/includes/sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> 403 Error </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-red" style="margin-top:-25px;">403</h2>
        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Oops! Permission Denied.</h3>
          <p> You are not authorized to access this page </p>
        </div>
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin/includes/footer') </div>
<!-- ./wrapper -->
<script src="{{ asset('assets/admin/') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('assets/admin/') }}/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('assets/admin/') }}/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/') }}/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/admin/') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('assets/admin/') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('assets/admin/') }}/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/admin/') }}/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/') }}/dist/js/demo.js"></script>
</body>
</html>
