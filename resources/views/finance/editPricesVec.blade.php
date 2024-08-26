<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $configuration->WebsiteTitle }} | Edit Order Price</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('assets/web/images/favicon.png')}}" type="image/x-icon">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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


            <!-- Left side column. contains the logo and sidebar -->
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
                        <h1>Update Order Price Vector</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li><a href="{{ url('admin/customers') }}">Order Prices</a></li>
                            <li class="active">Edit</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        {!! Form::open([ 'url' => 'admin/vector_prices/'.$order_vec->VectorOrderID, 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Edit</h3>
                                        <div class="box-tools pull-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Update</button>
                                            <button type="button" class="btn btn-sm btn-warning" onclick="location.href = '{{ url('admin/cus/accounts') }}'"><i class="fa fa-times"></i> Cancel</button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Info</h3>
                                                    </div>


                                                    <iv class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="CustomerName">Order ID:<span class="mandatory">*</span></label>
                                                                    {!! Form::text('OrderID', $order_vec->VectorOrderID, ['class' => 'form-control', 'readonly' => 'true']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="CustomerName">Design Name: <span class="mandatory">*</span></label>
                                                                    {!! Form::text('DesignName', $order_vec->DesignName, ['placeholder' => 'Enter Design Name', 'class' => 'form-control', 'id' => 'CustomerName']) !!}
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Cell">Quantity: </label>
                                                                
                                                                     <input type="number" placeholder="Enter Quantity" value="{{$order_vec->Quantity}}" class="form-control" name="qty"  onchange="setPricebyQty(this);" id="qty"  required="true" >
                                                                </div>
                                                            </div>
                                                             <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Cell">Unit Price:</label>

                                                                      <input type="text" placeholder="Enter Price" onchange="set_final(this);" id="price" class="form-control" value="{{$order_vec->PriceBeforeDiscount}}" name="OrderPrice" required="true" ?>


                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Cell">Discount: </label>
                                            
                                                                    <input type="text" placeholder="Enter Discount" value="{{ $order_vec->Discount}}" id="disc" onchange="cal_price(this);" class="form-control" name="Discount" ><br>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Cell">Order Full Price: </label>

                                                                      <input type="text" id="actfinalprice" value="{{$order_vec->Price}}" class="form-control" name="myText" <?php  if($order_vec->Price == ''){ ?> style="display:none" <?php } ?> disabled>
                                                                       <input type="hidden"  id="fnlprice" name="finalprice">
                                                                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Email">Designer Price:</label>
                                                                    PKR{!! Form::number('DesignerPrice', $order_vec->DesignerPrice, ['placeholder' => 'Enter Designer Price', 'class' => 'form-control', 'id' => 'Email']) !!}
                                                                </div>
                                                            </div>
                                                            <?php  if($order_vec->SalesPersonID > 0){ ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Fax">Sales Commision: </label>
                                                                    PKR{!! Form::number('SalesComm', $order_vec->SalesPrice, ['placeholder' => 'Enter Sales Commission', 'class' => 'form-control']) !!}
                                                                </div>
                                                            </div>

                                                           <?php  } ?> 
                                                        </div>
                                                     
                                                      
                                                       
                                                       
                                                    </div>


                                                
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="box-tools pull-right">
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Update</button>
                                            <button type="button" class="btn btn-sm btn-warning" onclick="location.href = '{{ url('admin/cus/accounts') }}'"><i class="fa fa-times"></i> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- /.col (right) -->
                        </div>
                        <!-- /.row -->
                        {!! FORM::close() !!}
                    </section>
                    <!-- /.content -->
                </div>
            </div>

            @include('admin/includes/footer')
        </div>
        <!-- ./wrapper -->

        <script src="{{ asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/admin/plugins/fastclick/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/admin/dist/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>
        <script src="{{ asset('assets/admin/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

        <script>

            $( document ).ready(function() {
                     var actualprice = document.getElementById('actfinalprice').value;
                 document.getElementById("fnlprice").value = actualprice;
                });
           

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

            alert(price+' P yaha D '+discount);

            if(qty > 0){
                price = price * qty;
            }
         

            if(price != '' || discount != ''){
            
                if(discount >= price){

                    alert('Discount Bara Ha Price say'); 
        
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
                   document.getElementById("fnlprice").value = finalprice;
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
                    alert('GALAT H AYA');
                    Price = Price - d;
                }

                 alert('Its Answer of Price: ' + Price);
                document.getElementById("fnlprice").value = Price;
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
