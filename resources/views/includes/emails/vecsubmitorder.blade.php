<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Logo Artz</title>
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/skins/_all-skins.min.css">
       
        
        
        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
                font-size:12px;
                background: #f5f5f5;
                color: #3d3e3e;
                width: 100%;
                height:100%;
            }
            .container {
                width: 50%;
                background: #fff;
                margin:0 auto;
                padding:25px;
            }
            .border {
                border: 1px solid #f5f5f5;
                height: 0px;
                width: 100%;
                border-top: 0;
                margin: 20px 0;
            }
            .blue-text {
                font-size: 18px;
            }
            a.activate-link {
                background: #ec914d;
                display: block;
                padding:10px 0;
                width: 100%;
                color: white;
                text-align: center;
                text-decoration: none;
                font-size: 18px;
            }
            .my-details {
                background: #f5f5f5;
                padding: 20px 20px 0 20px;
                margin-top: 20px;
            }
            a.mailto {
                color: #ec914d;
                text-decoration: none;
            }
            .my-details h3 {
                font-size: 18px;
            }
            .my-details p {
                font-size: 16px;
            }
            .my-details img {
                width: 150px;
                float: right;
            }
            .left {
                width: 50%;
                float: left;
            }
            .right {
                width: 50%;
                float: right;
            }
            .clear {
                clear: both;
            }
                .ed{
                 background: #ede4de61;
            
            }
            
    
        
@media (max-width: 960px) {
                .container {
                    width: 90%;
                    background: #fff;
                    padding:25px;
                }
                .my-details {
                    padding: 10px 0px 0 10px;
                }
                .my-details h3 {
                    font-size: 16px;
                }
                .my-details p {
                    font-size: 14px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
                    <img src="{{ asset('assets/web/img/logo.png') }}" />
            <!--<img src="{{ asset('assets/web/img/logo.png') }}" />-->
            <div class="border"></div>
            
            <?php if($OrderStatus == 0) { ?>
            <p class="blue-text">Dear {{ $CustomerName }},</p>

            
            <p class="blue-text">Your {{ $OrderType }} has been Submitted.</p> <br>
            <?php  }else{ ?>
              <p class="blue-text">Dear admin,</p>
            
             <?php if(isset($Trial) && $Trial == 1) { ?>
               <p class="blue-text">Free Trial New Customer Registration</p> <br>
            <?php }else{ ?>
            <p class="blue-text"> {{ $CustomerName }} Place a {{ $OrderType }}.</p> <br>
         
            
            <?php } 
            
                        } ?>
            
            
            <div class="row">
        
        
         <?php if($OrderStatus == 1) { ?>
            <div class="box ed"  style="border-style: solid; border-color: black; border-width: 1px; padding: 10px" >
            <div class="box-header">
               <h3 style="text-align: center">Customer Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th></th>
                  <th></th>
                 
                </tr>
                </thead>
                <tbody>
              
            
                <tr style="border-style: solid; border-color: white; border-width: 2px; padding: 10px">
                  <td><b>Name:</b></td>
                  <td >{{ $CustomerName }}</td>
                </tr>
                <tr>
                  <td><b>Email:</b></td>
                  <td>{{ $CusEmail }}</td>
                </tr>
                <tr>
                  <td><b>Phone:</b></td>
                  <td>{{ $CusPhone }}</td>
                </tr>
                <tr>
                  <td><b>Company:</b></td>
                  <td>{{ $CusCompany }}</td>
                </tr>
               
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>    
          
          <?php } ?>
          
          
                
                
                
                
                
                
                
                
                
           <div class="box ed"  style="margin-top: 5px; border-style: solid; border-color: black; border-width: 1px; padding: 10px" >
            <div class="box-header">
               <h3 style="text-align: center">Order Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th></th>
                  <th></th>
                 
                </tr>
                </thead>
                <tbody>
              
            
                <tr style="border-style: solid; border-color: white; border-width: 2px; padding: 10px">
                  <td><b>Design Name:</b></td>
                  <td >{{ $DesignName }}</td>
                </tr>
                <tr>
                  <td><b>Requried Format:</b></td>
                  <td>{{ $RequriedFormat }}</td>
                </tr>
                <tr>
                  <td><b>Vector will be use for:</b></td>
                  <td>{{ $Vecuse }}</td>
                </tr>
                <tr>
                  <td><b>Width:</b></td>
                  <td>{{ $Width }}</td>
                </tr>
                <tr>
                  <td><b>Height:</b></td>
                  <td>{{ $Height }}</td>
                </tr>
                <tr>
                  <td><b>Scale:</b></td>
                  <td>{{ $Scale }}</td>
                </tr>
                  <tr>
                  <td><b>Required color:</b></td>
                  <td>{{ $Reqclr }}</td>
                </tr>
                 <tr>
                  <td><b>Number Of Colors:</b></td>
                  <td>{{ $NumClr }}</td>
                </tr>
                 <tr>
                  <td><b>Additional Instructions:</b></td>
                  <td>{{ $ADDITIONALINSTRUCTIONS }}</td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
            
            
    <?php if($OrderStatus == 0){  ?>        
                
         <h4 style="color: #ec914d">Thank you for choosing us!!</h4>
            <div class="my-details">
                <div class="left">
                    <h3>Team LogoArtz</h3>
                    <p>Email: <a class="mailto" href="mailto:technical-team@logoartz.com">info@logoartz.com</a></p>
                </div>
                <div class="clear"></div>
  <?php }else{?>
  
            
         <h4 style="color: #ec914d">Auto Alert Email</h4>
            <div class="my-details">
                <div class="left">
                    <h3>LogoArtz Server Machine</h3>
                    <p>Email: <a class="mailto" href="mailto:technical-team@logoartz.com">technical-team@logoartz.com</a></p>
                </div>

                <div class="clear"></div>
            </div>
            
<?php } ?>
  
  
  
                
                
            </div>
        </div>
    </body>
</html>

