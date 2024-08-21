<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Customers</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web') }}/images/favicon.png" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/iCheck/minimal/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .alert{
                opacity: 0.5;
            }
            .m-l-250{
                max-height: 250px;
                overflow-y: auto;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            @include('salesperson/includes/header')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container">



                    <section class="content">
                        <?= $DigiOrders->Status == 5 ? '<div class="alert alert-success">Design Assigned to <a href="' . url("admin/designers/details/" . $DigiOrders->DesignerID) . '">' . $DigiOrders->DesignerName . ' </a></div>' : ($DigiOrders->Status == 3 ? '<div class="alert alert-warning">Message Sent to Customer</div>' : '') ?>
                        <!-- SELECT2 EXAMPLE -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="" style="text-align: center;"><strong>{{ $heading }} Order Detail</strong></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>DESIGN CODE </label>
                                            <p>{{ $DigiOrders->OrderID }}  </p>

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
                                            <label>DIMENSIONS</label>
                                            <p>{{ $DigiOrders->Width.' x '.$DigiOrders->Height.' '.$DigiOrders->Scale }} </p>
                                        </div>
                                    </div>



                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>REQ. COLOR</label>
                                            <p>{{ $DigiOrders->ReqColor }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>SEPARATION</label>
                                            <p>{{ $DigiOrders->ReqSeparation }} </p>
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

                                       <div class="col-md-12">
                        <div class="form-group">
                          <label>NOTE</label>
                             <p>{{ $DigiOrders->CsNote }} </p>
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
                            <div class="col-md-12">

                                <div class="box box-danger">
                                    <div class="box-header">
                                        <h3 class="box-title" style="text-align: "><strong>Additional Detail</strong></h3>
                                    </div>
                                    <div class="box-body">
                                        <!-- Date dd/mm/yyyy -->

                                        <div class="row">


                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label>Customer Name</label>
                                                    <div><h5>{{ $DigiOrders->CustomerName }} </h5> </div>
                                                </div>


                                            </div>
                                            <div class="col-md-3"> 
                                                <div class="form-group">
                                                    <label>STATUS</label>
                                                    <div><span class="label label-warning"> {{   $OrderStatuses[$DigiOrders->Status] }}</span></div>


                                                </div>
                                            </div>
                                            <div class="col-md-3"> 
                                                <div class="form-group">
                                                    <label>Designer</label>
                                                    <div><span class="text text-sm"> {{ $DigiOrders->DesignerName }}</span></div>


                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.form group
                                        -->

                                        <!-- Date mm/dd/yyyy -->

                                        <div class="row">
                                            <!--             <div class="col-md-3"> 
                                                            <div class="form-group">
                                                            <label>Designer PRICE</label>
                                                            <div> <h4><span class="label label-success">${{ $DigiOrders->DesignerPrice }}</span> </h4></div>
                                                            
                                                            </div> 
                                                             </div> 
                                                             <div class="col-md-3"> 
                                                             <div class="form-group pull-right">
                                                            <label>Admin PRICE</label>
                                                            <div> <h4><span class="label label-success">${{ $DigiOrders->CustomerPrice }}</span> </h4></div>
                                                            
                                                            </div> 
                                                         </div>-->
                                            <!-- /.form group -->


                                            <!-- phone mask -->
                                            @if($DigiOrders->OrderType == 4)
                                            <div class="col-md-12"> 
                                                <div class="form-group">
                                                    <label>Quote Price</label>
                                                    <div>{{ $DigiOrders->CustomerPrice }} </div>
                                                </div>              
                                            </div>
                                            @endif
                                            <div class="col-md-12"> 
                                                <div class="form-group">
                                                    <label>ADDITIONAL INSTRUCTIONS</label>
                                                    <div>{{ $DigiOrders->MoreInstructions }} </div>
                                                </div>              
                                            </div>
                                            @if(!$Revision->isEmpty())
                                            <div class="col-md-12"> 
                                                <div class="form-group">
                                                    <label>Client Message(s)</label>
                                                    @foreach($Revision as $revise)
                                                    <div>
                                                        <h4>
                                                            {{ $revise->Message }}
                                                            <small class="pull-right">{{ $revise->DateAdded }}</small>
                                                        </h4>
                                                    </div>
                                                    @endforeach
                                                </div>              
                                            </div>
                                            @endif
                                            @if($DigiOrders->Status == 4 && !empty($DigiOrders->DesignerID))
                                            <div class="col-md-12">
                                                {!! Form::open(['url' => 'admin/digi-approve-designer/'.$DigiOrders->OrderID]) !!}
                                                <button class="btn btn-primary btn-block" type="submit">Approve to Designer</button>
                                                {!! Form::close() !!}
                                            </div>
                                            @elseif($DigiOrders->Status == 2)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Designer Message</label>
                                                    <div>{{ $DigiOrders->MessageForAdmin }} </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Designer Price</label>
                                                    <div>{{ $DigiOrders->DesignerPrice }} </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Enter Your Price</label>
                                                {!! Form::open(['url' => 'admin/digi-send-quote/'.$DigiOrders->OrderID]) !!}
                                                <input type="text" placeholder="Enter Quote" class="form-control" name="CustomerPrice"><br>
                                                <button class="btn btn-info btn-block" type="submit">Send Quote to Customer</button>
                                                {!! Form::close() !!}
                                            </div>
                                            @elseif($DigiOrders->Status == 6)
                                            {!! Form::open(['url' => 'admin/digi-send-order/'.$DigiOrders->OrderID]) !!}
                                            <?php
                                            foreach ($DesignFiles as $fls) {
                                                $extArr = explode('.', $fls->File);
                                                $ext = end($extArr);
                                                ?>
                                                <div class="col-md-6" style="margin-bottom:6px;">
                                                    <input name="FileForCustomer[]" value="{{ $fls->DR_File_ID }}" checked type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                    <a href="{{asset('uploads/orders/digi').'/'.$fls->File}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->DesignName.'.'.$ext }}</a>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Send Message to Customer</label>
                                                    <textarea placeholder="Enter Message For Customer" class="form-control" name="MessageForCustomer" rows="5"></textarea>
                                                </div>
                                                <button class="btn btn-primary btn-block" type="submit">Send Order To Customer</button>
                                            </div>
                                            {!! Form::close() !!}
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

                                        <div class="col-md-6">

                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork</label>

                                                    <img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File1) }}" width="200" />

                                                </div>
                                            </div>

                                        </div>  <!--Col Close-->



                                        <div class="col-md-6">


                                            <div class="box-body">


                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork 2</label>

                                                    <img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File2) }}" width="200" />

                                                </div>

                                            </div>



                                        </div>    <!--Col Close-->


                                    </div>  <!--Row Close-->




                                    <div class="row"> 

                                        <div class="col-md-6">

                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork 3</label>

                                                    <img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File3) }}" width="200" />

                                                </div>
                                            </div>

                                        </div>    <!--End Col -->




                                        <div class="col-md-6">

                                            <div class="box-body">


                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork 4</label>

                                                    <img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File4) }}" width="200" />

                                                </div>

                                            </div>


                                        </div>  <!--End Col -->

                                    </div>

                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->

                            </div>  
                      


                            @if(!$RivisionHistory->IsEmpty())
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revision History </h3>
                                    </div>
                                    <div class="box-body m-l-250">
                                        @foreach($RivisionHistory as $history)
                                        <div class="form-group">
                                            <label>{{ $history->From == 3 ? 'Customer' : 'Admin' }}:</label>
                                            <p><?= $history->Message ?><small class="pull-right">{{$history->DateAdded}}</small></p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            
                              @if(!$RivisionHistory->IsEmpty())
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revision History </h3>
                                    </div>
                                    <div class="box-body m-l-250">
                                         <?php  $RevCount = 1; ?>

                                        @foreach($revision_history as $history)
                                        <div class="form-group" style="margin-bottom: 20px">
                                            <h4><strong>Revision {{ $RevCount }}</strong></h4><br>
                                            <label>Designer Message</label> 
                                            <p><?= $history['DesignerMessage'] ?><small class="pull-right">{{ $history['DateAdded'] }}</small><br>
                                                 <label>Files:</label><br>
                                            <?php
                                                    if(!empty($history['Files'])) {
                                                        foreach($history['Files'] as $mfile) {   
                                                    ?>

                                                    <div class="col-md-6" style="margin-top: 5px">
                                                        <a href="{{asset('uploads/orders/digi').'/'.$mfile->File}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $mfile->File }}</a>
                                                    </div>
                                                       
                                                    <?php 
                                                }
                                                    }
                                                    ?>
                                                        <?php $RevCount++; ?>   
                                                    <div class="clearfix"></div>
                                            </p>
                                        </div>
                                        @endforeach
                                    </div><br>
                                </div>
                            </div>
                            @endif


                     
                          
                       
                        </div>
                

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
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
        <script src="{{ asset('assets/admin/') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/fastclick/fastclick.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!--<script src="{{ asset('assets/admin/') }}/plugins/chartjs/Chart.min.js"></script>-->
        <script src="{{ asset('assets/admin/') }}/dist/js/app.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/Chart.bundle.min.js"></script>
        <script src="{{ asset('assets/admin/') }}/plugins/Chart.min.js"></script>
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
