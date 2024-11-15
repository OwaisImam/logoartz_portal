<title></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" type="text/css" />

<meta name="color-scheme" content="light dark">
<meta name="supported-color-schemes" content="light dark">

<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500,700);

    * {
        box-sizing: border-box !important;
    }

    * div {
        display: block;
    }

    @media (prefers-color-scheme: dark) {
        /* Dark mode styles */
    }
</style>
<div class="email-template" style="background-color: #ffff;display: block;padding-top: 80px;padding-bottom: 80px;">
    <div class="email-container"
        style="max-width: 700px;width: 100%;margin: 0 auto;display: block;border-radius: 8px;background-color: #FBF2E6;overflow: hidden;">
        <div class="email-header" style="display: block;padding: 60px 10px 0px 10px;text-align: center;">
            <img
                alt="" src="https://login.logoartz.com/assets/admin/images/Logo_artz_logo_new.png"
                style="display: block;margin: 0 auto;padding: 0 0 25px 0; width: 300px" />
            <h4
                style="font-family: 'Roboto', sans-serif;font-size: 28px;font-weight: 500;line-height: 28px;letter-spacing: 0em;text-align: center;margin: 0;display: block;">
                Your order has been confirmed</h4>
        </div>

        <div class="email-content" style="width: 90%;margin: 0 auto; font-size:19px">


            <div class="ul" style="margin-top: 60px;">
                <div class="email-order-details" style="">
                    <div
                        style="font-family: 'Roboto', sans-serif; font-weight: 600; color: #333; border-radius: 8px; margin-bottom: 15px;">

                        @if ($OrderStatus == 0)
                            <p>Dear {{ $CustomerName }},</p>
                            <p>Your {{ $OrderType }} has been submitted.</p>
                        @else
                            <p>Dear admin,</p>
                            @if (isset($Trial) && $Trial == 1)
                                <p>Free Trial New Customer Registration</p>
                            @else
                                <p>{{ $CustomerName }} Place a {{ $OrderType }}.</p>
                            @endif
                        @endif
                    </div>

                    @if ($OrderStatus == 1)
                        <div
                            style="padding: 5px 25px; border-radius: 8px; background-color: #E7D098; width: 100%; margin: 0 auto; font-family: 'Roboto', sans-serif; font-weight: 600; color: #333; margin-bottom: 15px;">
                            <div class="box-header">
                                <h3 style="text-align: center">Customer Details</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul style="list-style-type: none; padding: 0; margin: 0;">
                                    <li
                                        style="padding: 5px 25px; background-color: #FBF2E6; width: 100%; margin: 0 auto; font-family: 'Roboto', sans-serif; font-weight: 600; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                        Name: <span style="font-weight: 300; color: #333;">{{ $CustomerName }}</span>
                                    </li>
                                    <li
                                        style="padding: 5px 25px; background-color: #FBF2E6; width: 100%; margin: 0 auto; font-family: 'Roboto', sans-serif; font-weight: 600; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                        Email: <span style="font-weight: 300; color: #333;">{{ $CusEmail }}</span>
                                    </li>
                                    <li
                                        style="padding: 5px 25px; background-color: #FBF2E6; width: 100%; margin: 0 auto; font-family: 'Roboto', sans-serif; font-weight: 600; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                        Phone: <span style="font-weight: 300; color: #333;">{{ $CusPhone }}</span>
                                    </li>
                                    <li
                                        style="padding: 5px 25px; background-color: #FBF2E6; width: 100%; margin: 0 auto; font-family: 'Roboto', sans-serif; font-weight: 600; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                        Company: <span style="font-weight: 300; color: #333;">{{ $CusCompany }}</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @endif

                    <ul style="list-style-type: none; padding: 0; margin: 0;">
                        @if ($DesignName != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600;background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Design Name: <span style="font-weight: 300; color: #333;">{{ $DesignName }}</span>
                            </li>
                        @endif
                        @if ($RequriedFormat != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif;  color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Required Format: <span
                                    style="font-weight: 300; color: #333;">{{ $RequriedFormat }}</span>
                            </li>
                        @endif
                        @if ($FABRIC != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Fabric: <span style="font-weight: 300; color: #333;">{{ $FABRIC }}</span>
                            </li>
                        @endif
                        @if ($PLACEMENT != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Placement: <span style="font-weight: 300; color: #333;">{{ $PLACEMENT }}</span>
                            </li>
                        @endif
                        @if ($Width != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Width: <span style="font-weight: 300; color: #333;">{{ $Width }}</span>
                            </li>
                        @endif
                        @if ($Height != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Height: <span style="font-weight: 300; color: #333;">{{ $Height }}</span>
                            </li>
                        @endif
                        @if ($Scale != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Scale: <span style="font-weight: 300; color: #333;">{{ $Scale }}</span>
                            </li>
                        @endif
                        @if ($NumClr != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Number of Colors: <span
                                    style="font-weight: 300; color: #333;">{{ $NumClr }}</span>
                            </li>
                        @endif
                        @if ($Fbrclr != null)
                            <li
                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Fabric Color: <span style="font-weight: 300; color: #333;">{{ $Fbrclr }}</span>
                            </li>
                        @endif
                        @if ($ADDITIONALINSTRUCTIONS != null)
                            <li                                style="padding: 5px 25px; font-weight: 600; background-color: #E7D098; width: 90%; margin: 0 auto; font-family: 'Roboto', sans-serif; color: #333; margin-bottom: 15px; border-radius: 8px;">
                                Additional Instructions: <span
                                    style="font-weight: 300; color: #333;">{{ $ADDITIONALINSTRUCTIONS }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <p
                style="color: #00000; margin: 0 0 30px 0;font-family: 'Roboto', sans-serif;font-size: 22px;font-weight: 500;line-height: 32px;letter-spacing: 0em;text-align: center;display: block;">
                Thank you for your business!</p>

            <div class="footer-images" style="text-align: center; margin-bottom: 20px;">
                <a href="https://www.logoartz.com/products/embroidered-patches"><img alt="Custom Patches"
                        src="https://login.logoartz.com/assets/admin/images/email_images/Custom.png"
                        style="width: 100px; margin-right: 15px;" />
                </a>
                <a href="https://www.logoartz.com/products/hang-tags">
                    <img alt="Hang Tags" src="https://login.logoartz.com/assets/admin/images/email_images/Hang-Tag.png"
                        style="width: 100px; margin-right: 15px; max-height:100px" />
                </a>
                <a href="https://www.logoartz.com/products/embroidery-digitizing">
                    <img alt="Digitizing"
                        src="https://login.logoartz.com/assets/admin/images/email_images/Digitizing.png"
                        style="width: 100px; margin-right: 15px;" />
                </a>
                <a href="https://www.logoartz.com/products/woven-labels">
                    <img alt="Woven Clothing Labels"
                        src="https://login.logoartz.com/assets/admin/images/email_images/Woven.png"
                        style="width: 100px; margin-right: 15px;" />
                </a>
                <a href="https://www.logoartz.com/products/vector">
                    <img alt="Vector" src="https://login.logoartz.com/assets/admin/images/email_images/Vector.png"
                        style="width: 100px;" />
                </a>
            </div>
        </div>

        <div class="email-footer" style="background-color: #FBF2E6;padding: 30px 10px 40px 10px;">
            <div class="email-footer-logo"><img alt=""
                    src="https://login.logoartz.com/assets/admin/images/Logo_artz_logo_new.png"
                    style="width: 220px;display: block;margin: 0 auto 0 auto;" /></div>

            <div style="display: block;text-align: center;">
                <p class="email-footer-copy"
                    style="display: inline-block;margin: 0 auto;padding: 15px 0 20px 0;font-family: 'Roboto', sans-serif;font-size: 16px;font-weight: 500;line-height: 23px;letter-spacing: 0em;text-align: center;">
                    &copy; Copyright {{ date('Y') }} | All rights reserved</p>
            </div>

            {{-- <p class="footer-links"
                style="margin: 0;display: block;font-family: 'Roboto', sans-serif;font-size: 13px;font-weight: 500;line-height: 19px;letter-spacing: 0em;text-align: center;text-decoration: none;color: #A4A4A4;">
                <a href="https://www.guardpass.com/terms"
                    style="font-family: 'Roboto', sans-serif;font-size: 13px;font-weight: 500;line-height: 19px;letter-spacing: 0em;text-align: center;text-decoration: none;color: #A4A4A4;display: inline-block;">Terms
                    of service</a> <span style="margin: 0 2px;">|</span> <a href="https://www.guardpass.com/privacy"
                    style="font-family: 'Roboto', sans-serif;font-size: 13px;font-weight: 500;line-height: 19px;letter-spacing: 0em;text-align: center;text-decoration: none;color: #A4A4A4;display: inline-block;">Privacy
                    policy</a></p>

            <p style="margin: 0;display: block;text-align: center;padding: 25px 0 0 0;"><a href=""
                    style="font-family: 'Roboto', sans-serif;font-size: 16px;font-weight: 500;line-height: 21px;letter-spacing: 0em;text-align: center;color: #242429;text-decoration: underline;">Unsubscribe</a>
            </p> --}}
        </div>
    </div>
</div>
