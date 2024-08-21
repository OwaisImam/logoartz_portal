<?php  
if(!empty($quotation)){
    if($quotation->OrderType == 2 || $quotation->OrderType == 4){
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
        <title>{{ $configuration->WebsiteTitle }} | Quotation Details</title>
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

       

                    <section class="content">
             <div class="box-body"  style="font-size: 18px">
    <div class="row">

        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Bordered Table</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table class="table table-bordered" >
             
                <tr>
    
                  <td><label>Quotation NO</label></td>
                  <td>
                    {{ $quotation->quotation_no }}
                  </td>
              
                </tr>
                <tr>

                  <td><label>Full Name</label></td>
                  <td>
                   {{ $quotation->full_name }} 
                  </td>
                
                </tr>
                <tr>

                  <td><label>Email</label></td>
                  <td>
                   {{ $quotation->email }}
                  </td>
               
                </tr>
                <tr>
    
                  <td> <label>Phone </label> </td>
                  <td>
                   {{ $quotation->phone }} 
                  </td>
                
                </tr>
                 <tr>
    
                  <td> <label>Width </label> </td>
                  <td>
                   {{ $quotation->width }} 
                  </td>
                
                </tr>
                <tr>
                    
                  <td>  <label>Height </label></td>
                  <td>
                    {{ $quotation->height }}
                  </td>
              
                </tr>

                 <tr>
                  <td><label>Need By</label></td>
                  <td>
                   {{ $quotation->needby }}
                  </td>
               
                </tr>

               <tr>
                  <td><label>Design Format </label></td>
                  <td>
                   {{ $quotation->design_format }} 
                  </td>
                
                </tr>

                <tr>
    
                    <td><label>Stock </label></td>
                    <td>
                      {{ $quotation->stock }}
                    </td>
                
                  </tr>
  
                  <tr>
                      <td><label>Embroider Coverage </label></td>
                      <td>
                        {{ $quotation->embroidery_coverage }}
                      </td>
                  
                    </tr>
                    <tr>
      
                                           
                      <td><label>Backing </label></td>
                      <td>
                        {{ $quotation->backing }}
                      </td>
                  
                    </tr>
                    <tr>
      
                                           
                      <td><label>Pvc Patch Type </label></td>
                      <td>
                        {{ $quotation->pvc_patch_type }}
                      </td>
                  
                    </tr>
                    <tr>
      
                                           
                      <td><label>Colors </label></td>
                      <td>
                        {{ $quotation->colors }}
                      </td>
                  
                    </tr>
                    <tr>
      
                                           
                      <td><label>Material </label></td>
                      <td>
                        {{ $quotation->material }}
                      </td>
                  
                    </tr>
                    <tr>
      
                                           
                      <td><label>Fold </label></td>
                      <td>
                        {{ $quotation->fold }}
                      </td>
                  
                    </tr>
  
                    <tr>
      
                                           
                      <td><label>Border Color </label></td>
                      <td>
                        {{ $quotation->bordercolor }}
                      </td>
                  
                    </tr>
  
                    <tr>
      
                                           
                      <td><label>Name </label></td>
                      <td>
                        {{ $quotation->name }}
                      </td>
                  
                    </tr>
                    <tr>
      
                                           
                      <td><label>Font </label></td>
                      <td>
                        {{ $quotation->font }}
                      </td>
                  
                    </tr>
                    <tr>
      
                                           
                      <td><label>Name Color </label></td>
                      <td>
                        {{ $quotation->namecolor }}
                      </td>
                  
                    </tr>
                    
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            
            </div>
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>



        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Bordered Table</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
               
                <tr>
                  <td><label>Time Frame</label></td>
                  <td>
                   {{ $quotation->time_frame }} 
                  </td>
                
                </tr>
                 <tr>

                  <td><label>Placement</label></td>
                  <td>
                   {{ $quotation->placement }} 
                  </td>
                
                </tr>

                 <tr>
    
                                         
                  <td><label>Instructions</label></td>
                  <td>
                    {{ $quotation->instruction }}
                  </td>
              
                </tr>

                   <tr>
    
                                         
                  <td><label>String Color </label></td>
                  <td>
                    {{ $quotation->string_color }}
                  </td>
              
                </tr>

                   <tr>
    
                                         
                  <td><label>Product Quantity </label></td>
                  <td>
                    {{ $quotation->product_quantity }}
                  </td>
              
                </tr>

                  
                  <tr>
    
                                         
                    <td><label>Twill Color </label></td>
                    <td>
                      {{ $quotation->twillcolor }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Type </label></td>
                    <td>
                      {{ $quotation->type }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Corners </label></td>
                    <td>
                      {{ $quotation->corners }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Border Style </label></td>
                    <td>
                      {{ $quotation->borderstyle }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Shape </label></td>
                    <td>
                      {{ $quotation->shape }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Sticker Size </label></td>
                    <td>
                      {{ $quotation->stickersize }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Bumber Sticker Type </label></td>
                    <td>
                      {{ $quotation->bumper_sticker_type }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Sticker Extra Colors </label></td>
                    <td>
                      {{ $quotation->sticker_extra_colors }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Base Color </label></td>
                    <td>
                      {{ $quotation->basecolor }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Embossed </label></td>
                    <td>
                      {{ $quotation->embossed }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Chenille Colors </label></td>
                    <td>
                      {{ $quotation->chenille_colors }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Thread Color </label></td>
                    <td>
                      {{ $quotation->thread_colors }}
                    </td>
                
                  </tr>
                  <tr>
    
                                         
                    <td><label>Border </label></td>
                    <td>
                      {{ $quotation->border }}
                    </td>
                
                  </tr>
                  <tr>
    
                  
                  <tr>

                  <td><label>Created On</label> </td>
                  <td>

                   <?php echo date('d-m-Y', strtotime($quotation->created_at)); ?>
                  </td>
                
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            
            </div>
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>
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
            function cal_price(text){
            
             var price = '';   
             var discount = '';   
             var price = document.getElementById('price').value;
             var discount = document.getElementById('disc').value;
             var qty = document.getElementById('qty').value;
             var price = parseInt(price);
             var discount = parseInt(discount);
                
            if(price == ''){
                alert('Please Enter Price First!!');
            }

            // alert(price+' P yaha D '+discount);

            if(qty > 0){
                price = price * qty;
            }
         

            if(price != '' || discount != ''){
            
                if(discount >= price){

                    // alert('Discount Bara Ha Price say'); 
        
                    document.getElementById("sndorder").reset();
                    alert('Discount Price Not Bigger than actual price amount please check');
                }else if(discount < price){
                  var actualprice = price - discount;
                  document.getElementById("fnlprice").value = actualprice;
                  document.getElementById("actfinalprice").value = actualprice;
                  document.getElementById("actfinalprice").style.display='block';


                }else if(price != '' && discount == ''){    
                    document.getElementById("fnlprice").value = price;
                    document.getElementById("actfinalprice").style.display='block';
                }
            }else{
                alert('Check Prices Please');
            }
           

            }

            function setPricebyQty(text){
                var vp = document.getElementById('price').value;
                var qty = document.getElementById('qty').value;
                 var d = document.getElementById('disc').value;
                if(vp === ''){

                }else{
                    finalprice = vp * qty;
                    if(d !== ''){
                     finalprice = finalprice - d;   
                    }
                   document.getElementById("actfinalprice").value = finalprice;
                   document.getElementById("actfinalprice").style.display='block';

                }
            }

            function set_final(text){
                var p = document.getElementById('price').value;
                var d = document.getElementById('disc').value;
                var qty = document.getElementById('qty').value;
                var Price = 0;
                d = parseInt(d);
               
                if(qty > 0){
                    p = parseInt(p);
                    qty =  parseInt(qty);
                    Price  = p * qty;
              }
                if(d > 0){
                    // alert('GALAT H AYA');
                    Price = Price - d;
                }

                //  alert('Its Answer of Price: ' + Price);
                document.getElementById("actfinalprice").value = Price;
                document.getElementById("actfinalprice").style.display='block';


            }

            $(document).ready(function () {
                $("#sndorder").submit(function () {
                    $("#releaseSubmit").attr("disabled", true);
                    return true;
                });
            });
                        
             
        </script>



    </body>
</html>

