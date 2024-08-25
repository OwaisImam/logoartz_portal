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
                    <img src="{{ asset('assets/web/img/logo-v1.png') }}" />
            <!--<img src="{{ asset('assets/web/img/logo-v1.png') }}" />-->
            <div class="border"></div>
           
              <p class="blue-text">Dear admin,</p>
             
            <p class="blue-text">New Customer Registration</p> <br>
            
          
            
            
            <div class="row">
       
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
                <tr>
                  <td><b>City:</b></td>
                  <td>{{ $CusCity }}</td>
                </tr>
                <tr>
                  <td><b>Country:</b></td>
                  <td>{{ $CusCountry }}</td>
                </tr>
                <tr>
                  <td><b>Currency:</b></td>
                  <td>{{ $CusCurrency }}</td>
                </tr>
                <tr>
                  <td><b>Hear About:</b></td>
                  <td>{{ $HearAbout }}</td>
                </tr>
               
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>    
          
           
          </div>
            
            </div>
        </div>
    </body>
</html>

