<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | SalesPerson</title>
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
                        <h1><i class="fa fa-users"></i> Sales </h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Sales Person</li>
                        </ol>
                    </section>
                    <!-- Main content -->
                    {!! Form::open([ 'url' => 'admin/desingers/delete', 'id' => 'frm_list' ]) !!}
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Sales Persons</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-sm btn-primary" onClick="location.href = '{{ url('admin/designers/add') }}'"><i class="fa fa-plus"></i> Add New</button>
                                            <button type="button" class="btn btn-sm btn-danger btnTools" onClick="doDelete()" id="btnDelete"><i class="fa fa-trash-o"></i> Delete</button>
                                        </div>
                                    </div>
                                    <div class="box-body table-responsive">
                                        <table id="dataList" class="display table table-bordered table-striped table-hover" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="checkAllNone" class="all" /></th>
                                                    <th>Sales Person ID</th>
                                                    <th>Name</th>
                                                    <th>Cell</th>
                                                    <th>Email</th>
                                                    <th>Amount Payable</th>
                                                    <th>Amount Paid</th>
                                                    <th>Status</th>
                                                    <th>Added</th>
                                                    <th>Modified</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </section>
                    {!! FORM::close() !!}
                    <!-- /.content -->
                </div>
            </div>
            <!-- /.content-wrapper -->
            @include('admin/includes/footer')

        </div>
        <!-- jQuery 2.2.3 -->
        <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- DataTables -->
        <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
        <!-- SlimScroll -->
        <script src="{{ asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/admin/plugins/fastclick/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/admin/dist/js/app.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>
        <!-- page script -->

        <script language="javascript">
                                                var checkAll;
                                                var checkboxes;

                                                $(function () {

                                                    var data_list = $('#dataList').dataTable({
                                                        "processing": true,
                                                        "serverSide": true,
                                                        "ajax": {
                                                            'type': 'POST',
                                                            'url': '{{ url(Request::path()) }}',
                                                            'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                                                        },
                                                        "pageLength": 50,
                                                        "aLengthMenu": [[10, 25, 50, 100, <?php echo $recordsTotal; ?>], [10, 25, 50, 100, "All"]],
                                                        aoColumnDefs: [
                                                            {
                                                                bSortable: false,
                                                                aTargets: [0, 8]
                                                            }
                                                        ],
                                                        "order": [[1, 'desc']],
                                                        "oLanguage": {
                                                            "sSearch": "",
                                                            "sProcessing": "<img src='{{ asset('assets/admin') }}/images/loading-spinner-grey.gif'>"
                                                        },
                                                        "fnDrawCallback": function () {
                                                            checkAll = $('input.all');
                                                            checkboxes = $('input.check');

                                                            $('input[type="checkbox"], input[type="radio"]').iCheck({
                                                                checkboxClass: 'icheckbox_minimal-blue',
                                                                radioClass: 'iradio_minimal-blue'
                                                            });
                                                            checkAll.on('ifChecked ifUnchecked', function (event) {
                                                                if (event.type == 'ifChecked') {
                                                                    checkboxes.iCheck('check');
                                                                } else {
                                                                    checkboxes.iCheck('uncheck');
                                                                }
                                                            });

                                                            checkboxes.on('ifChanged', function (event) {
                                                                if (checkboxes.filter(':checked').length == checkboxes.length) {
                                                                    checkAll.prop('checked', 'checked');
                                                                } else {
                                                                    checkAll.removeProp('checked');
                                                                }
                                                                checkAll.iCheck('update');
                                                            });

                                                            $(".btnTools").prop("disabled", !(parseInt(data_list.fnGetData().length) > 0));
                                                        }
                                                    });

                                                    $('#dataList_filter input').attr('placeholder', 'Search...');
                                                });

                                                function doDelete()
                                                {
                                                    if (checkboxes.filter(':checked').length > 0)
                                                    {
                                                        ok = function () {
                                                            $("#frm_list").submit();
                                                        };
                                                        message_box("Confirm", "This will delete all Customers.<br>Are you sure?", "confirm", ok, null);
                                                    } else
                                                    {
                                                        message_box("Alert", "Please select Designer to delete", "alert", null, null);
                                                    }
                                                }
        </script>
    </body>
</html>
