<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Customers</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/iCheck/minimal/blue.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            @include('admin/includes/header')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-alert">
                        <div class="row">
                            <div class="col-xs-12" style="padding: 5px 20px;">
                                @include('admin/includes/front_alerts')
                            </div>                            
                        </div>
                    </section>
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1><i class="fa fa-users"></i> Todays New</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Customers</li>
                        </ol>
                    </section>
                    <!-- Main content -->
                    


                    <section class="content">


   <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>TODAYS DIGITIZING NEW ORDERS</strong></h3>
                                     </div>
                                    <div class="box-body table-responsive">
                                    <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                        

                                  <thead>
                                               <tr>
                                                    <th>Order#</th>
                                                    <th>Design Name</th>
                                                    <th>Customer ID</th>
                                                    <th>Order Type</th> 
                                                    <th>Designer</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    
                                                
                                                    <th></th>
                                                </tr>
                                   </thead>
    <tr>         
                                                  <td>33241</td>
                                                  <td>Aplpha</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                  
                                                </tr>


<tr>         
                                                  <td>33241</td>
                                                  <td>Team</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>

                                                <tr>         
                                                  <td>33241</td>
                                                  <td>Computer</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Dog Logo</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>14 Names</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Alpha</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Aviator</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>LogoArtz</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Vectar</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Software</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Electric</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Shop Logo</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Uni Logo</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td><select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                  <tr>         
                                                  <td>33241</td>
                                                  <td>Video Editor</td>
                                                  <td>1251D</td>
                                                  <td>New Order</td>
                                                  <td> <select class="form-control" name="Scale">
                                                 <option>Please Select</option>
                                                 <option value="Inch">Ubaid</option>
                                                 <option value="Centimeter">Taha</option>
                                                 <option value="Millimeter">Ali</option>
                                                 <option value="Pixel">Imran</option>
                                                 </select></td>
                                                  <td>Asigned</td>
                                                  <td><Button class="btn btn-success"> Save</Button></td>
                                                </tr>
                                                
                                                
                                                

                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            



</div>

                
                    <!-- /.content -->
                </div>
            </div>
            <!-- /.content-wrapper -->
            @include('admin/includes/footer')

        </div>
               <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/fastclick/fastclick.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!--<script src="{{ asset('assets/admin/plugins/chartjs/Chart.min.js') }}"></script>-->
        <script src="{{ asset('assets/admin/dist/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/Chart.min.js') }}"></script>
        <script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],
        datasets: [{
                label: '',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(37, 115, 212, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(37,115,212,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: '',
                data: [3, 2, 5, 3, 19, 12],
                backgroundColor: [
                    'rgba(31, 152, 63, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(31,152,63,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: '',
                data: [13, 21, 26, 15, 29, 12],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
        }
    }
});
        </script>
    </body>
</html>
