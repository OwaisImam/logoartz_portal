<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $configuration->WebsiteTitle }} | Digi Order Details</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png') }}" type="image/x-icon">
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
    <style>
        .alert {
            opacity: 0.5;
        }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        @include('designer/includes/header')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container">



                <section class="content">
                    <?= $DigiOrders->Status == 5 ? '<div class="alert alert-warning">Approved Order to Complete</div>' : ($DigiOrders->Status == 1 ? '<div class="alert alert-info">New Order</div>' : '<div class="alert alert-success">Quote Sent</div>') ?>
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="" style="text-align: center;">Order Detail</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>DESIGN CODE </label>
                                        <p>{{ $DigiOrders->OrderID }} </p>

                                    </div>
                                </div>
                                <!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>DESIGN NAME</label>
                                        <p>{{ $DigiOrders->DesignName }} </p>
                                    </div>
                                </div>



                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>PO NUMBER </label>
                                        <p>{{ $DigiOrders->PONumber }} </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>REQUIRED FORMAT</label>
                                        <p>{{ $DigiOrders->ReqFormat }} </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>OTHER FORMAT </label>
                                        <p> </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>FABRIC </label>
                                        <p>{{ $DigiOrders->Fabric }}</p>
                                    </div>
                                </div>

                                <!-- /.col --

           
              <!-- /.form-group -->

                                <!-- /.col -->
                            </div>


                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>NO. OF COLORS </label>
                                        <p>{{ $DigiOrders->NoOfColors }} </p>

                                    </div>
                                </div>
                                <!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>DIMNESIONS</label>
                                        <p>4*5 </p>
                                    </div>
                                </div>



                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>REQ. COLOR</label>
                                        <p>{{ $DigiOrders->FabricColor }} </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>SEPARATION</label>
                                        <p> </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>CC TO</label>
                                        <p>{{ $DigiOrders->CC }} </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>UPLOADED ON</label>
                                        <p>{{ $DigiOrders->DateAdded }} </p>
                                    </div>
                                </div>


                            </div>

                            <!-- /.col --

           
              <!-- /.form-group -->

                            <!-- /.col -->






                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->

                    <div class="row">
                        <div class="col-md-6">

                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title" style="text-align: ">Additional Detail</h3>
                                </div>
                                <div class="box-body">
                                    <!-- Date dd/mm/yyyy -->

                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <div>
                                                    <h5>{{ $DigiOrders->CustomerName }} </h5>
                                                </div>
                                            </div>


                                        </div>
                                        @if ($DigiOrders->OrderType == 2)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Designer Quote</label>
                                                    <div><span class="label label-warning" id="prices">
                                                            ${{ $DigiOrders->DesignerPrice }}</span></div>
                                                </div>
                                            </div>
                                        @endif


                                    </div>
                                    <!-- /.form group
               -->

                                    <!-- Date mm/dd/yyyy -->

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ADDITIONAL INSTRUCTIONS</label>
                                                <div>{{ $DigiOrders->MoreInstructions }} </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ADMIN MESSAGE</label>
                                                <div>{{ $DigiOrders->MessageForDesigner }} </div>
                                            </div>
                                        </div>
                                        @if ($DigiOrders->OrderType == 1 || $DigiOrders->OrderType == 9)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>OTHER MESSAGE(S)</label>
                                                    @foreach ($Revision as $revise)
                                                        <div>
                                                            <h4>
                                                                {{ $revise->Message }}
                                                                <small
                                                                    class="pull-right">{{ $revise->DateAdded }}</small>
                                                            </h4>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                    </div>



                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">ART Work</h3>
                                </div>

                                <div class="row">

                                    @if ($DigiOrders->File1 != '')
                                        <div class="col-md-6">

                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary
                                                        ArtWork 1</label>

                                                    <img src="{{ asset('uploads/orders/digi/' . $DigiOrders->File1) }}"
                                                        width="200" />

                                                </div>
                                            </div>

                                        </div> <!--Col Close-->
                                    @endif

                                    @if ($DigiOrders->File3 != '')
                                        <div class="col-md-6">


                                            <div class="box-body">


                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary
                                                        ArtWork 2</label>

                                                    <img src="{{ asset('uploads/orders/digi/' . $DigiOrders->File2) }}"
                                                        width="200" />

                                                </div>

                                            </div>



                                        </div> <!--Col Close-->
                                    @endif
                                </div> <!--Row Close-->




                                <div class="row">

                                    @if ($DigiOrders->File3 != '')
                                        <div class="col-md-6">

                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary
                                                        ArtWork 3</label>

                                                    <img src="{{ asset('uploads/orders/digi/' . $DigiOrders->File3) }}"
                                                        width="200" />

                                                </div>
                                            </div>

                                        </div> <!--End Col -->
                                    @endif

                                    @if ($DigiOrders->File4 != '')
                                        <div class="col-md-6">

                                            <div class="box-body">


                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary
                                                        ArtWork 4</label>

                                                    <img src="{{ asset('uploads/orders/digi/' . $DigiOrders->File4) }}"
                                                        width="200" />

                                                </div>

                                            </div>


                                        </div> <!--End Col -->
                                    @endif
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                        </div>
                        <!-- iCheck -->
                        @if (
                            $DigiOrders->OrderType == 0 ||
                                $DigiOrders->OrderType == 2 ||
                                $DigiOrders->OrderType == 3 ||
                                $DigiOrders->OrderType == 9)
                            @if ($DigiOrders->Status == 1)
                                {!! Form::open(['url' => 'designer/digi/price/' . $DigiOrders->OrderID]) !!}
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Quote Price </h3>
                                            @include('admin/includes/front_alerts')
                                        </div>

                                        <div class="box-body">
                                            <!-- Date -->
                                            <div class="form-group">


                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    {!! Form::text('Price', null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Quote Price here',
                                                        'id' => 'price',
                                                    ]) !!}
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Message For
                                                        Admin</label>
                                                    {!! Form::textarea('Reply', null, ['class' => 'form-control', 'placeholder' => 'Enter Message For Admin here']) !!}
                                                </div>
                                                <!-- /.col-->
                                            </div>

                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->

                                        <!-- Date and time range -->
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-block btn-primary">Send
                                                Quote</button>
                                        </div>
                                        <!-- /.form group -->

                                    </div>

                                    <!-- /.box-body -->
                                </div>
                                {!! Form::close() !!}
                            @elseif($DigiOrders->Status == 2 || $DigiOrders->Status == 3 || $DigiOrders->Status == 4)
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Quote Status </h3>
                                        </div>
                                        <div class="box-body">
                                            <h3>Quote Sent to Admin</h3>
                                        </div>
                                    </div>
                                </div>
                            @elseif($DigiOrders->Status == 5)
                                {!! Form::open(['url' => 'designer/digi/completed/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Send Design to Admin</h3>
                                        </div>

                                        <div class="box-body">
                                            <!-- Date -->
                                            @include('designer/includes/front_alerts')
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Message For
                                                        Admin</label>
                                                    {!! Form::textarea('DesignerMessage', null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Message For Admin here',
                                                    ]) !!}
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Upload
                                                        Design <span class="mandatory"></span></label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileOne', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileTwo', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileThree', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileFour', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileFive', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileSix', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>

                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->

                                        <!-- Date and time range -->
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-block btn-primary">Send Design to
                                                Admin</button>
                                        </div>
                                        <!-- /.form group -->

                                    </div>

                                    <!-- /.box-body -->
                                </div>
                                {!! Form::close() !!}
                            @elseif($DigiOrders->Status == 6 || $DigiOrders->Status == 7)
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Order Status </h3>
                                        </div>
                                        <div class="box-body">
                                            <h3>Design Sent to Admin</h3>
                                        </div>
                                    </div>
                                </div>
                            @elseif($DigiOrders->Status == 8)
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Order Status </h3>
                                        </div>
                                        <div class="box-body">
                                            <h3>Order Done</h3>
                                        </div>
                                    </div>
                                </div>
                            @elseif($DigiOrders->Status == 9)
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Order Status </h3>
                                        </div>
                                        <div class="box-body">
                                            <h3>Order Cancelled</h3>
                                        </div>
                                    </div>
                                </div>
                            @elseif($DigiOrders->Status == 10)
                                {!! Form::open(['url' => 'designer/digi/completed/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Send Revised Design to Admin</h3>
                                        </div>

                                        <div class="box-body">
                                            <!-- Date -->
                                            @include('designer/includes/front_alerts')
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Message For
                                                        Admin</label>
                                                    {!! Form::textarea('DesignerMessage', null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Message For Admin here',
                                                    ]) !!}
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Upload
                                                        Design <span class="mandatory"></span></label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileOne', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileTwo', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileThree', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileFour', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileFive', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6">
                                                            {!! Form::file('FileSix', $attributes = ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>

                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->

                                        <!-- Date and time range -->
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-block btn-primary">Send Design to
                                                Admin</button>
                                        </div>
                                        <!-- /.form group -->

                                    </div>

                                    <!-- /.box-body -->
                                </div>
                                {!! Form::close() !!}
                            @endif
                        @elseif($DigiOrders->OrderType == 1)
                            {!! Form::open(['url' => 'designer/digi/completed/' . $DigiOrders->OrderID, 'files' => 'true']) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Send Revised Design to Admin</h3>
                                    </div>

                                    <div class="box-body">
                                        <!-- Date -->
                                        @include('designer/includes/front_alerts')
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="txtarea1" class="col-sm-12 control-label"> Message For
                                                    Admin</label>
                                                {!! Form::textarea('DesignerMessage', null, [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter Message For Admin here',
                                                ]) !!}
                                            </div>

                                            <div class="form-group">
                                                <label for="txtarea1" class="col-sm-12 control-label"> Upload Design
                                                    <span class="mandatory"></span></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {!! Form::file('FileOne', $attributes = ['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! Form::file('FileTwo', $attributes = ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {!! Form::file('FileThree', $attributes = ['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! Form::file('FileFour', $attributes = ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {!! Form::file('FileFive', $attributes = ['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! Form::file('FileSix', $attributes = ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.col-->
                                        </div>

                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->

                                    <!-- Date and time range -->
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-block btn-primary">Send Design to
                                            Admin</button>
                                    </div>
                                    <!-- /.form group -->

                                </div>

                                <!-- /.box-body -->
                            </div>
                            {!! Form::close() !!}
                        @endif
                </section>
                <!-- /.content -->


                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">ASSIGN</h4>
                            </div>
                            <div class="modal-body">
                                <p>DONE</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
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
        $('#price').on('input', function() {
            $('#prices').text('$' + $(this).val());
        });
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
