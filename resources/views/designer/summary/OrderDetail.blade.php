<?php  
if(!empty($DigiOrders)){
    if($DigiOrders->OrderType == 2 || $DigiOrders->OrderType == 4){
        $type = "Quote";
    }else{
        $type = "Order";
    }
}
  $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF' ];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | {{ $type }} Details</title>
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

            @include('admin/includes/header')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container">

        {!! Form::open([ 'url' => 'admin/order/ddelete', 'id' => 'frm_list' ]) !!}

                    <section class="content">
                        <?= $DigiOrders->Status == 5 || $DigiOrders->AssignStatus == 1 ? '<div class="alert alert-success">Design Assigned to <a href="' . url("admin/designers/details/" . $DigiOrders->DesignerID) . '">' . $DigiOrders->DesignerName . ' </a></div>' : ($DigiOrders->Status == 3 ? '<div class="alert alert-warning">Message Sent to Customer</div>' : '') ?>
                    
                      
                        <!-- SELECT2 EXAMPLE -->
                        <div class="box box-default">
                           <div class="box-header with-border">
          <h3 class="" style="text-align: center;">Digitizing {{ $type }} Detail</h3>
             <div class="box-tools pull-right">
                         <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-default">Delete Order
              </button>
  </div>
        </div>
               {!! FORM::close() !!}
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>DESIGN CODE </label>
                                            <p>{{ $DigiOrders->OrderID }}</p>

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
                                    
                                    <div class="col-md-12" style="font-size: 20px">
                                        <div class="form-group">
                                            <label>Current Status</label>
                                            <p><span style="font-size: 18px" class="label label-warning"> {{   $OrderStatuses[$DigiOrders->Status] }}</span></p>
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
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Cutomer Price Plane</h3>
                                    </div>
                                    <div class="box-body m-l-250">
                                 
                                        <div class="form-group">
                                              <label>Price Plane:</label>
                                        <h4>{{ $DigiOrders->priceplane }} </h4>
                                        
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                      

  @include('admin/includes/front_alerts')

                        <div class="row">
                            <div class="col-md-6">

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
                                                    <label>Client Instruction(s)</label>
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
                                            @if($DigiOrders->Status == 8)
                                            <div class="col-md-12">
                                                 <label>Final Price</label><br>
                                                 <div style="font-size: 20px"><span class="label label-success"> {{ $DigiOrders->Price }}$</span></div>
                                            </div>
                                            @endif
`
                                            @if($DigiOrders->Status == 4 && !empty($DigiOrders->DesignerID))
                                            <div class="col-md-12">
                                                {!! Form::open(['url' => 'admin/digi-approve-designer/'.$DigiOrders->OrderID]) !!}
                                                <button class="btn btn-primary btn-block" type="submit">Approve to Designer</button>
                                                {!! Form::close() !!}
                                            </div>
                                            @elseif($DigiOrders->Status == 2 || $DigiOrders->Status == 11)
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
                                         {!! Form::open(['url' => 'admin/digi-send-quote/'.$DigiOrders->OrderID]) !!}
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                <label>Files:</label>
                                                  <div>                                                      
                                          <?php
                                                foreach ($DesignFiles as $fls) {
                                                $extArr = explode('.', $fls->File);
                                                $ext = end($extArr);
                                                ?>
                                                <div class="col-md-6" style="margin-bottom:6px;">
                                                    <input name="FileForCustomer[]" value="{{ $fls->DR_File_ID }}" checked type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                    <a href="{{asset('uploads/orders/digi').'/'.$fls->File}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $fls->File }}</a>
                                                </div>

                                                 


                                         <?php }  ?>    
                                            </div>
                                              </div>
                                                </div>


                                            <div class="col-md-12">
                                                <label>Enter Your Price</label>
                                               
                                                <input type="text" placeholder="Enter Quote" class="form-control" name="CustomerPrice"><br>
                                                <button class="btn btn-info btn-block" type="submit">Send Quote to Customer</button>
                                                {!! Form::close() !!}
                                            </div>
                                            @elseif($DigiOrders->Status == 6)
                                            {!! Form::open(['url' => 'admin/digi-send-order/'.$DigiOrders->OrderID,  'files'=>'true']) !!}
                                            <?php

                                            foreach ($DesignFiles as $fls) {
                                                $extArr = explode('.', $fls->File);
                                                $ext = end($extArr);
                                                ?>
                                                <div class="col-md-6" style="margin-bottom:6px;">
                                                    <input name="FileForCustomer[]" value="{{ $fls->DR_File_ID }}" checked type="checkbox"> &nbsp; &nbsp; &nbsp;
                                                    <a href="{{asset('uploads/orders/digi').'/'.$fls->File}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $fls->File }}</a>
                                                </div>

                                                <?php
                                            }
                                            ?>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Send Instruction to Customer</label>
                                                    <textarea placeholder="Enter Instruction For Customer" class="form-control" name="MessageForCustomer" rows="5"></textarea>
                                                    <label>Enter Order Price: FOR CUSTOMER</label>
                                                    <input type="text" placeholder="Enter Price" class="form-control" name="OrderPrice"><br>

                                                </div>
                                            </div>


                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   
                                                    <?php  

                                                    if($DigiOrders->SalesPersonID > 0)
                                                    {
                                                     ?>
                                                    <label>Enter Sales Rep Commission:</label>
                                                    <input type="text" placeholder="Enter Price" class="form-control" name="salesorp"><br>

                                                <?php } ?>


                                                    <label>Enter Designer Price:</label>
                                                    <input type="text" placeholder="Enter Price" class="form-control" name="designorp"><br>

                                                </div>
                                            </div>

                               

                                              <button class="btn btn-primary btn-block" type="submit">Send Order To Customer</button>



                                            {!! Form::close() !!}
                                            @endif



                                        </div>



                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->

                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Customer ART Work</h3>
                                    </div>


                                    <div class="box-body">

                                        <div class='row'>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork 1</label>
                                                   
                                                     <?php
                                          
                                                 
                                               if ($DigiOrders->File1 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File1);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $DigiOrders->File1 }}" href="{{  asset('uploads/orders/digi/'.$DigiOrders->File1) }}"><img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File1) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a href="{{asset('uploads/orders/digi').'/'.$DigiOrders->File1}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->File1 }}</a>
                                         
                                                        <?php  } }  ?>   
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork 2</label>
                                                    
                                                     <?php
                                          
                                                 
                                               if ($DigiOrders->File2 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File2);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $DigiOrders->File2 }}" href="{{  asset('uploads/orders/digi/'.$DigiOrders->File2) }}"><img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File2) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a href="{{asset('uploads/orders/digi').'/'.$DigiOrders->File2}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->File2 }}</a>
                                         
                                                        <?php  } }  ?> 
                                                </div>
                                            </div>
                                        </div>

                                        <hr style="border-color:#000;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork 3</label>
                                                  
                                                     <?php
                                          
                                                 
                                               if ($DigiOrders->File3 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File3);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $DigiOrders->File3 }}" href="{{  asset('uploads/orders/digi/'.$DigiOrders->File3) }}"><img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File3) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a href="{{asset('uploads/orders/digi').'/'.$DigiOrders->File3}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->File3 }}</a>
                                         
                                                        <?php  } }  ?>  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="txtarea1" class="col-sm-12 control-label"> Primary ArtWork 4</label>
                                                 
                                                     <?php
                                          
                                                 
                                               if ($DigiOrders->File4 != "") {
                                                      
                                                        $File =  explode(".", $DigiOrders->File4);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $DigiOrders->File4 }}" href="{{  asset('uploads/orders/digi/'.$DigiOrders->File4) }}"><img src="{{ asset('uploads/orders/digi/'.$DigiOrders->File4) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a href="{{asset('uploads/orders/digi').'/'.$DigiOrders->File4}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $DigiOrders->File4 }}</a>
                                         
                                                        <?php  } }  ?> 
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    


                                <!-- /.box -->

                            </div>  
                        </div>





                            @if(!$RivisionHistory->IsEmpty())
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Order History </h3>
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
                                         <?php  $RevCount = 0; 
                                            $Rev_heading = 'Order History';
                                         ?>

                                        @foreach($revision_history as $history)
                                        <div class="form-group" style="margin-bottom: 20px">
                                            <?php  
                                                if($RevCount == 0){
                                            ?>
                                            <h4><strong>Order First Response</strong></h4><br>
                                        <?php }else{ ?>

                                            <h4><strong>Revision {{ $RevCount }}</strong></h4><br>
                                        <?php } ?>
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


                            <!-- /.col (left) -->
                            @if($DigiOrders->OrderType == 0 || $DigiOrders->OrderType == 2 || $DigiOrders->OrderType == 3)
                            @if($DigiOrders->Status != 8)
                            @if($DigiOrders->Status != 7)
                            @if($DigiOrders->Status != 4)
                            @if($DigiOrders->Status != 6)
                            {!! Form::open(['url' => 'admin/digi-assign-designer/'.$DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"><strong>Assigment</strong></h3>
                                      
                                    </div>
                                    <div class="box-body">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label>Designer:</label>


                                            {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}

                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Instruction For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your Instruction here']) !!}
                                        </div>
                                        <!-- /.col-->
                                    </div>

                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <!-- Date and time range -->
                                <div class="form-group">

                                    <button type="submit" class="btn btn-block btn-primary">ASSIGN</button>
                                </div>
                                <!-- /.form group -->

                            </div>
                            {!! Form::close() !!}
                           @else
                            {!! Form::open(['url' => 'admin/digi_order_revision/'.$DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revise Order</h3>
                                      
                                    </div>
                                    <div class="box-body">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label>Designer:</label>
                                            {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label>Instruction For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your message here']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-warning">ASSIGN</button>
                                </div>
                                <!-- /.form group -->

                            </div>
                            {!! Form::close() !!}
                            @endif
                            @else
                            @if(!empty($DigiOrders->DesignerID))
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"><strong>Assigment For Complete Order</strong></h3>
                                    </div>
                                    <div class="box-body">
                                        <h2>Assigned to <a href="{{ url('admin/designers/details/'.$DigiOrders->DesignerID) }}">{{ $DigiOrders->DesignerName }}</a></h2>
                                        {!! Form::open(['url' => 'admin/digi-assign-designer/'.$DigiOrders->OrderID]) !!}
                                        <div class="form-group">
                                            <label>Designer:</label>
                                            {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label>Instruction For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your Instruction here']) !!}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary">APPROVE TO  DESIGNER</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            @else
                            {!! Form::open(['url' => 'admin/digi-assign-designer/'.$DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"><strong>Assigment </strong></h3>
                                      
                                    </div>
                                    <div class="box-body">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label>Designer:</label>
                                            {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label>Instruction For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your Instruction here']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary">ASSIGN</button>
                                </div>
                                <!-- /.form group -->

                            </div>
                            {!! Form::close() !!}
                            @endif
                            @endif
                            @else
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Status </h3>
                                    </div>
                                    <div class="box-body">
                                        <h2>Order Sent To Customer</h2>
                                        <h3>Confirmation is Pending</h3>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @else
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Status </h3>
                                    </div>
                                    <div class="box-body">
                                        <h2>Order Completed By <a href="{{ url('admin/designers/details/'.$DigiOrders->DesignerID) }}">{{ $DigiOrders->DesignerName }}</a></h2>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @elseif($DigiOrders->OrderType == 1 && $DigiOrders->Status != 6 && $DigiOrders->Status != 10 && $DigiOrders->Status != 7)
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Status </h3>
                                    </div>
                                    <div class="box-body">
                                        <h2>Order Sent for Revision</h2>
                                    </div>
                                </div>
                            </div>
                          @elseif($DigiOrders->Status == 7)
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Status </h3>
                                    </div>
                                    <div class="box-body">
                                        <h2>Order Sent To Customer</h2>
                                     
                                    </div>
                                </div>
                            </div>
                            @elseif($DigiOrders->Status == 10)
                            @if($DigiOrders->OrderType == 1 || $DigiOrders->OrderType == 9)
                          

                             {!! Form::open(['url' => 'admin/digi_order_revision/'.$DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revise {{ $type }}</h3>
                                      
                                    </div>
                                    <div class="box-body">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label>Designer:</label>
                                            {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label>Instruction For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your Instruction here']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-warning">ASSIGN</button>
                                </div>
                                <!-- /.form group -->

                            </div>
                            {!! Form::close() !!}




<!--         OLD WORK DIRECT ASSIGN TO EXITS DESIGNER

                            {!! Form::open(['url' => 'admin/digi_order_revision/'.$DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revise Order </h3>
                                    </div>
                                    <div class="box-body">
                                      
                                        <div class="form-group">
                                            <label>Message For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your message here']) !!}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-warning">Revise</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}


 -->





                            @elseif($DigiOrders->OrderType == 4 && $DigiOrders->Status == 10 || $DigiOrders->Status == 11 || $DigiOrders->Status != 6)

                            {!! Form::open(['url' => 'admin/digi-assign-designer-rev/'.$DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"><strong>Assigment For Revision</strong></h3>
                                      
                                    </div>
                                    <div class="box-body">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label>Designer:</label>
                                            {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label>Instruction For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your Instruction here']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary">ASSIGN</button>
                                </div>
                                <!-- /.form group -->

                            </div>
                            {!! Form::close() !!}




                          
                            @endif
                            @endif
                            <!-- /.box-body -->
                        

        

                            @if($DigiOrders->OrderType == 4 && $DigiOrders->Status == 6)
                              {!! Form::open(['url' => 'admin/digi_order_revision/'.$DigiOrders->OrderID]) !!}
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Revise {{ $type }}</h3>
                                      
                                    </div>
                                    <div class="box-body">
                                        <!-- Date -->
                                        <div class="form-group">
                                            <label>Designer:</label>
                                            {!! Form::select('DesignerID', $Designers, $DigiOrders->OrderID, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label>Instruction For Designer:</label>
                                            {!! Form::textarea('MessageForDesigner', null, ['class' => 'form-control', 'placeholder' => 'Enter your Instruction here']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-warning">ASSIGN</button>
                                </div>
                                <!-- /.form group -->

                            </div>
                            {!! Form::close() !!}

                            @endif








                        </div>
                        <!-- /.box -->




                        <!-- iCheck -->

                        <!-- /.row -->

                    </section>
                    <!-- /.content -->


                    <div class="modal fade" id="modal-default">
                         {!! Form::open(['url' => '/admin/ddelete/'.$DigiOrders->OrderID]) !!}
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Delete Order</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Do you Want to Delete this Order</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="submit"  class="btn btn-sm btn-danger">Delete Order</button>
                                </div>
                                  {!! Form::close() !!}
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
        
      
      
<script>
    function editmaintenancerequest(url){
        var edit = url.indexOf("edit");
        var add = url.indexOf("create");
        var add = url.indexOf("approval");
        jQuery.ajax({
            url: url,
            type: "get",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(result){
                jQuery('.custom-modal-rj').modal('toggle');
                jQuery('.custom-modal-dialog').addClass('modal-lg');
                if(edit >= 0){
                    title = '';
                }
                else if(add >= 0)
                {
                    title = ' ';
                }else
                {
                    title = '';
                }
                jQuery('.custom-modal-title').html(title);//SET TITLE
                jQuery('.custom-modal-body-rj').html(result);//SET BODY

                //SHOW LOADER B/C AJAX EVENT NOT CALL AFTER ONCOLSE IN JQGRID
                jQuery('.ajax-loader-region').fadeOut('fast');
            }
        });
        return false;
    }
</script>
      
      
      
      
      
      
      
      
      
      
      
        
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
