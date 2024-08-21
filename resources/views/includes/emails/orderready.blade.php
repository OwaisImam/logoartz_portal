<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Logo Artz</title>
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

    <body>  designName
        <div class="container">
                    <img src="{{ asset('assets/web/img/logo.png') }}" />
            <!--<img src="{{ asset('assets/web/img/logo.png') }}" />-->
            <div class="border"></div>
            <p class="blue-text">Hi {{ $CustomerName }},</p>
            <p class="blue-text">Your {{ $designName }} {{ $OrderType }} design is ready please click the link below and check the attached files on portal. if you need any of our assistance, please feel free to let us known.</p> <br>

            <a class="activate-link" href="http://logoartz.com/login">login</a>


            <p class="blue-text">
                <b>Thank You</b> 
                
            </p>

            <p class="blue-text"><b>Please Note: </b>We have done our best with your order. Please check proof & take a sample sew-out or print before productions, as Logo Artz will not be responsible for embroidered or printed items.</p> <br>


            <div class="my-details">
                <div class="left">
                    <h3>Logo Artz Team</h3>
                    <p>Email: <a class="mailto" href="mailto:info@logoartz.com">info@logoartz.com</a></p>
                </div>

                <div class="clear"></div>
            </div>
             <!--<p style="text-align: center; font-size: 16px">Developed by: <a target="_blank" class="mailto" href="http://boostanz.com">Boostanz Technologies</a></p>-->
        </div>
    </body>
</html>

