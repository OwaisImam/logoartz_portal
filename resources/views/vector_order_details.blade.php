<?php  
if(!empty($order)){
    if($order->OrderType == 2 || $order->OrderType == 4){
        $type = "Quote";
    }else{
        $type = "Order";
    }
}
 $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF' ];
?>
<!DOCTYPE html>
<html lang="en" class="demo-2 no-js">
    <!--<![endif]-->


    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!-- Basic Page Needs
      ================================================== -->
        <title>{{ $configuration->WebsiteTitle }} | Vector {{ $type }} Detail</title>
        <meta name="keywords" content="Logo Artz">
        <meta name="description" content="Logo Artz">
        <meta name="author" content="">
        <!-- Mobile Specific Meta
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- All Css -->
          <link rel="icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/bootstrap.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/font-awesome.min.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/icofont.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/hover-min.css') }}" media="screen">
        <!--Owl Carousel-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.carousel.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.theme.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/owl.transitions.css') }}" media="screen">
        <!--Portfolio-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/spsimpleportfolio.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/featherlight.min.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/style.css') }}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/responsive.css') }}" media="screen"> 
        <style>
            .twitter .tweet-block .name::before{
                display: none;
            }
            .item-right{
                position: absolute;
                right: 109px;
                top: 0
            }
            .btn{
                color: #5ec282;
            }
            .btn.green-btn{
                color: #fff;
            }
            label{
                font-size: 18px;
            }
        </style>

    </head>


    <body class="inner body-innerwrapper">

        <!--Header-->


        @include('includes/header')

    


    <!--     <?php // dd($order); ?>
 -->
        <!--Breadcrumb-->

        <section id="breadcrumb" class="two green-color">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 text-center breadcrumb-block">
                        <h3>VECTOR</h3>
                        <ol class="breadcrumb">
                            <    <?php
                        if (\Session::has('CustomerLogin')) {
                            ?>
                        <li>
                            <a href="{{ url('/CustomerDash')}}">Home</a>
                        </li>
                    <?php }else{ ?>

                           <li>
                            <a href="{{ url('/')}}">Home</a>
                        </li>
                    <?php } ?>
                            <li class="active">Vector</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <!--Services-->
        <section id="single-services" class="space one">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 service-block">
                        <div class="inner">
                            
                            
                        
                            <div class="col-sm-12 service-inner" style="font-family: poppins !important; font-size: 20px !important; font-weight: 400px;background-color: #f8f8f8; border: 1px solid #e6ecf2;">

                             
                            
                            <div class="col-sm-6 service-inner" >
                              <div class="box-body">
                                    <div class="box-header with-border">
                                    </div>
                                    <table class="table table-bordered">
                                       <tr>

                                          <td>
                                             <label>Order #</label>
                                          </td>
                                          <td>
                                            {{ App\Http\Helper::getPrefix('vector', $order->OrderType ) . '-'. $order->VectorOrderID }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>Design Name</label>
                                          </td>
                                          <td>
                                             {{ $order->DesignName }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>PO Number</label>
                                          </td>
                                          <td>
                                             {{ $order->PONumber }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>Width </label>
                                          </td>
                                          <td>
                                             {{ $order->Width.' '.$order->Scale }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>Height </label>
                                          </td>
                                          <td>
                                             {{ $order->Height.' '.$order->Scale }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>Required Fromat</label>
                                          </td>
                                          <td>
                                             {{ $order->ReqFormat }}
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                            
                            </div>

                            <div class="col-sm-6 service-inner" >
                                <div class="box-body">
                                    <div class="box-header with-border">
                                    </div>
                                    <table class="table table-bordered">
                                       <tr>
                                          <td>
                                             <label>Req. Color</label>
                                          </td>
                                          <td>
                                             {{ $order->ReqColor }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>No. of Colors </label>
                                          </td>
                                          <td>
                                             {{ $order->NoOfColors }}
                                          </td>
                                       </tr>
                                      
                                       <tr>
                                          <td>
                                             <label>Used For:</label>
                                          </td>
                                          <td>
                                             {{ $order->UsedFor }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>Separation</label>
                                          </td>
                                          <td>
                                             {{ $order->ReqSeparation }}
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <label>Upload On</label>
                                          </td>
                                          <td>
                                             <?php echo date('d-m-Y', strtotime($order->DateAdded)); ?>
                                          </td>
                                       </tr>

                                    </table>
                                 </div>
                                


                            </div>


                          </div>



                            <div class="row"  style="margin-bottom: 10px">


                                <h3 style="margin-left: 15px"><stronge>Your Artwork</stronge></h3>


                                <div class="col-md-3"> 
                                
                                  <?php
                                       if ($order->File1 != "") {
                                                      
                                                        $File =  explode(".", $order->File1);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $order->File1 }}" href="{{  asset('uploads/orders/vector/'.$order->File1) }}"><img src="{{ asset('uploads/orders/vector/'.$order->File1) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a style="margin-left: 10px; margin-top: 10px" href="{{asset('uploads/orders/vector').'/'.$order->File1}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $order->File1 }}</a>
                                         
                                                        <?php  } }  ?>   
                                </div>

                                <div class="col-md-3"> 
                                 <?php
                                                       if ($order->File2 != "") {
                                                      
                                                        $File =  explode(".", $order->File2);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $order->File2 }}" href="{{  asset('uploads/orders/vector/'.$order->File2) }}"><img src="{{ asset('uploads/orders/vector/'.$order->File2) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a style="margin-left: 10px; margin-top: 10px"  href="{{asset('uploads/orders/vector').'/'.$order->File2}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $order->File2 }}</a>
                                         
                                                        <?php  } }  ?>   
                                </div>

                                <div class="col-md-3"> 
                                    <?php
                                                       if ($order->File3 != "") {
                                                      
                                                        $File =  explode(".", $order->File3);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $order->File3 }}" href="{{  asset('uploads/orders/vector/'.$order->File3) }}"><img src="{{ asset('uploads/orders/vector/'.$order->File3) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a style="margin-left: 10px; margin-top: 10px"  href="{{asset('uploads/orders/vector').'/'.$order->File3}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $order->File3 }}</a>
                                         
                                                        <?php  } }  ?>   
                                </div>


                                <div class="col-md-3"> 
                                <?php
                                                       if ($order->File4 != "") {
                                                      
                                                        $File =  explode(".", $order->File4);
                                                        $ext = end($File);
                                                         if (in_array($ext, $allowed_ext)) {
                                                        
                                                ?>
                                                        <a download="{{ $order->File4 }}" href="{{  asset('uploads/orders/vector/'.$order->File4) }}"><img src="{{ asset('uploads/orders/vector/'.$order->File4) }}" width="100%" /></a>
                                                        <?php  }else{  ?>   
                                                    
                                                         <a  style="margin-left: 10px; margin-top: 10px"  href="{{asset('uploads/orders/vector').'/'.$order->File4}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $order->File4 }}</a>
                                         
                                                        <?php  } }  ?>   
                                </div>

                            </div>
                            
                            
                                 <div class="col-sm-8 service-inner padding-left">
                                
                                <div class="service-item item-left">
                                   
                                    @if(!empty($order->CustomerPrice))
                                    <h4>Price: <h2 class="label label-success">${{$order->CustomerPrice}}</h2></h4>
                                   
                                    @endif
                                </div>
                            </div>



                            <div class="col-sm-8 service-inner padding-left" style="margin-top: 20px">
                            <div class="service-item">
                                @if($order->Status == 3 && $order->OrderType == 2 || $order->OrderType == 4)
                                <h4>Quote Files</b></h4>

                                   
                                   <?php
                                             $counta = 0;
                                              $countb = 0;
                                              $countc = 0;
                                        if (count($DesignFiles) > 0) {
                                            foreach ($DesignFiles as $fls) {
                                                ?>

                                                 @if($fls->Category == 'a')
                                                   <?php if($counta < 1) { ?>
                                                   <label>Files A</label><br>
                                                   <?php } ?>
                                                    <a style="font-size: 12px; margin: 4px; padding: 4px" href="{{ asset('uploads').'/orders/vector/'.$fls->File }}" class="btn btn-success btn-flat" download><i class="fa fa-download"></i> {{ $fls->File }}</a> 
                                                <?php $counta++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif


                                                @if($fls->Category == 'b')
                                                  <?php if($countb < 1) { ?>
                                                   <label>Files B</label><br>
                                               <?php } ?>
                                                    <a style="font-size: 12px; margin: 4px; padding: 4px" href="{{ asset('uploads').'/orders/vector/'.$fls->File }}" class="btn btn-success btn-flat" download><i class="fa fa-download"></i> {{ $fls->File }}</a> 
                                                   <?php $countb++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif

                                                @if($fls->Category == 'c')
                                                  <?php if($countc < 1) { ?>
                                                   <label>Files C</label><br>
                                               <?php } ?>
  
                                                 <a style="font-size: 12px; margin: 4px; padding: 4px" href="{{ asset('uploads').'/orders/vector/'.$fls->File }}" class="btn btn-success btn-flat" download><i class="fa fa-download"></i> {{ $fls->File }}</a> 
                                                    <?php $countc++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif


                                                <?php
                                            }
                                        }
                                        ?>


                                   
                                 @endif

                             </div></div>


                            <div class="col-sm-8 service-inner padding-left" style="margin-top: 5%">
                                <div class="service-item">
                                    @if($order->Status == 0 || $order->Status == 1 || $order->Status == 2)
                                    <h4>Your Quote is Pending</h4>
                                    @elseif($order->Status == 3 && $order->OrderType == 2 || $order->OrderType == 4)
                                    <h4>Confirm Your Order</h4>
                                    <p>
                                        <button type="button" class="btn btn-success btn-flat" onclick="location.href ='{{url('vector_order_approve').'/'.$order->VectorOrderID}}'">PROCEED</button>
                                    </p>
                                    @elseif($order->Status == 4 || $order->Status == 5 || $order->Status == 6 || $order->Status == 10)
                                    <h4>This order is under processing</h4>
                                    @elseif($order->Status == 7 && $order->OrderType == 2 || $order->OrderType == 4)
                                    <h4>Convert to Order</h4>
                                   
                                        <button type="button" class="btn btn-success btn-flat" onclick="location.href ='{{url('vector_order_done').'/'.$order->VectorOrderID}}'">PROCEED</button> <br>
                                        <!--asset('uploads').'/orders/vector/'.$order->Image-->
                                        

                                     @elseif($order->Status == 7 && $order->OrderType != 2 || $order->OrderType != 4)

                                         @if($order->OrderType == 1 || $order->OrderType == 4 || $order->OrderType == 9)
                                         <h4>Order Revision Files:</h4>
                                         @else
                                         <h4>Order Files:</h4>
                                         @endif

                                  <?php
                                             $counta = 0;
                                              $countb = 0;
                                              $countc = 0;
                                        if (count($DesignFiles) > 0) {
                                            foreach ($DesignFiles as $fls) {
                                                ?>

                                                 @if($fls->Category == 'a')
                                                   <?php if($counta < 1) { ?>
                                                   <label>Files A</label><br>
                                                   <?php } ?>
                                                    <a style="font-size: 12px; margin: 4px; padding: 4px" href="{{ asset('uploads').'/orders/vector/'.$fls->File }}" class="btn btn-success btn-flat" download><i class="fa fa-download"></i> {{ $fls->File }}</a> 
                                                <?php $counta++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif


                                                @if($fls->Category == 'b')
                                                  <?php if($countb < 1) { ?>
                                                   <label>Files B</label><br>
                                               <?php } ?>
                                                    <a style="font-size: 12px; margin: 4px; padding: 4px" href="{{ asset('uploads').'/orders/vector/'.$fls->File }}" class="btn btn-success btn-flat" download><i class="fa fa-download"></i> {{ $fls->File }}</a> 
                                                   <?php $countb++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif

                                                @if($fls->Category == 'c')
                                                  <?php if($countc < 1) { ?>
                                                   <label>Files C</label><br>
                                               <?php } ?>
  
                                                 <a style="font-size: 12px; margin: 4px; padding: 4px" href="{{ asset('uploads').'/orders/vector/'.$fls->File }}" class="btn btn-success btn-flat" download><i class="fa fa-download"></i> {{ $fls->File }}</a> 
                                                    <?php $countc++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif


                                                <?php
                                            }
                                        }
                                        ?>





                             
                                    @elseif($order->Status == 8)
                                    @elseif($order->Status == 9)
                                    <h4>This Order is Cancelled</h4>
                                    @endif
                                </div>
                                @if($order->Status == 3 || $order->Status == 7)
                                <div class="service-item">
                                    <h4>Revise {{ $type }} With Instruction</h4>
                                    <div class="col-md-12"> 
                                        {!! Form::open([ 'url' => 'vector_revise/'.$order->VectorOrderID,  'files'=>'true', 'id' => 'revise_submit']) !!}
                                        <div class="form-group">
                                            <label for="OtherFormat">Instruction:</label>
                                            {{ Form::textarea('AddIns', null, ['placeholder' => 'Instruction For Logo Artz Support Team', 'class' => 'form-control', 'row' => '5']) }}
                                        </div>

                                         <div class="form-group">
                                             <label for="OtherFormat">Upload Feedback:</label>
                                        {!! Form::file('reviseFiles[]', $attributes = array('class'=>'form-control', 'multiple')) !!}
                                    
                                         </div>

                                         <div class="form-group">
                                            <button type="submit"  id="reviseor" class="btn btn-success btn-flat">Revise {{ $type}}</button>
                                        </div>
                                        {!! FORM::close() !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <aside class="col-sm-3">
                        <div class="widget twitter">
                            <h4>Instruction</h4>
                            <div class="tweet-block">
                                @if(!$revision->isEmpty())
                                @foreach($revision as $revise)
                                <div class="name">Logo Artz</div>
                                <p>"<?= $revise->Message ?>"</p>
                                @endforeach
                                @else
                                <div class="name">Logo Artz</div>
                                <p>"{{$order->MessageForCustomer != '' ? $order->MessageForCustomer : 'No Message'}}"</p>
                                @endif
                            </div>
                        </div>
                        

                          <div class="widget twitter">
                        <div class="name"><strong>Revision History</strong></div><br>
                        <?php  $RevCount = 0; ?>
                         @if(count($customerRevHistory) > 0)
                                @foreach($customerRevHistory as $revise) 

                                    
                                    <?php  
                                           if($RevCount == 0){
                                            ?>
                                            <h4><strong>Order First Response</strong></h4><br>
                                        <?php }else{ ?>

                                            <h4><strong>Revision {{ $RevCount }}</strong></h4><br>
                                        <?php } ?>


                                    <label>Your Instruction:</label><br>
                                    <p>{{ $revise['Message'] }}</p>
                                                  <label>Files:</label><br>
                                         
                                                    <?php
                                              $counta = 0;
                                              $countb = 0;
                                              $countc = 0;
                                                    if(!empty($revise['Files'])) {
                                                        foreach($revise['Files'] as $mfile) {   
                                                    ?>


                                                     @if($mfile->Category == 'a')
                                                         <?php if($counta < 1) { ?>
                                                        <label>Files A</label><br>
                                                         <?php } ?>
                                                    <div class="col-md-12" style="margin-top: 5px">
                                                        <a href="{{asset('uploads/orders/vector').'/'.$mfile->File}}" class="btn btn-success btn-flat btn-sm" download="" id="btn-sm"><i class="fa fa-download"></i> {{ $mfile->File }}</a>
                                                    </div> <br>
                                                  <?php $counta++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif


                                                @if($mfile->Category == 'b')
                                                    <?php if($countb < 1) { ?>
                                                   <label>Files B</label><br>
                                                     <?php } ?>
                                                  <div class="col-md-12" style="margin-top: 5px">
                                                        <a href="{{asset('uploads/orders/vector').'/'.$mfile->File}}" class="btn btn-success btn-flat btn-sm" download="" id="btn-sm"><i class="fa fa-download"></i> {{ $mfile->File }}</a>
                                                    </div> <br>
                                                      <?php $countb++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif

                                                @if($mfile->Category == 'c')
                                                 <?php if($countc < 1) { ?>
                                                   <label>Files C</label><br>
                                                     <?php } ?>
  
                                                <div class="col-md-12" style="margin-top: 5px">
                                                        <a href="{{asset('uploads/orders/vector').'/'.$mfile->File}}" class="btn btn-success btn-flat btn-sm" download="" id="btn-sm"><i class="fa fa-download"></i> {{ $mfile->File }}</a>
                                                    </div> <br>
                                                      <?php $countc++;  ?>
                                                 <div class="clearfix"></div>
                                               @endif

                                                 @if($mfile->Category == '')
                                                  <div class="col-md-12" style="margin-top: 5px">
                                                        <a href="{{asset('uploads/orders/digi').'/'.$mfile->File}}" class="btn btn-success btn-flat" download=""><i class="fa fa-download"></i> {{ $mfile->File }}</a>
                                                     </div> <br>
                                               @endif


                                                         
                                                    <?php 
                                                }
                                                    }
                                                    ?> <br>




                                                    <?php $RevCount++; ?>

                               @endforeach
                            @else
                                <div class="name"></div>
                            @endif
                        </div> 
                    </div>










                    </aside>
                </div>
            </div>
        </section>
        <!--Footer-->





        @include('includes/footer')

        <!--Copyright-->
        
        
      <script type="text/javascript">

       document.getElementById("reviseor").onclick = function() {
          //disable
          this.disabled = true;
          document.getElementById('revise_submit').submit();
      }
         

      </script>
        
        
        <!--All Js-->
        <script type="text/javascript" src="{{ asset('assets/web/js/jQuery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/jquery.easing.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/bootstrap.js') }}"></script>
        <!--<script src="../../../../use.fontawesome.com/e18447245b.js"></script>-->
        <script type="text/javascript" src="{{ asset('assets/web/js/appear.js') }}"></script>
        <!--Portfolio-->
        <script type="text/javascript" src="{{ asset('assets/web/js/isotope.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/spsimpleportfolio.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/featherlight.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/jquery.shuffle.modernizr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/steller.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/smooth-scroll.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/owl.carousel.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/web/js/custom.js') }}"></script>
    </body>

</body>


<!-- Mirrored from themesfoundry.net/demo/html/six/home-digital-marketing.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 12:57:13 GMT -->
</html>

