<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 95%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            width: 100px;
        }

        .header .invoice-title {
            background-color: #4a5a7d;
            color: #f6d36a;
            padding: 10px 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 14px;
        }

        .contact-info,
        .invoice-details {
            width: 48%;
        }

        .contact-info div,
        .invoice-details div {
            margin-bottom: 5px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            background-color: #4a5a7d;
            color: white;
            padding: 10px;
        }

        .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .total-row td {
            background-color: #4a5a7d;
            color: white;
            font-weight: bold;
        }

        .amount {
            text-align: right;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }

        .footer .note {
            color: red;
            font-weight: bold;
        }

        .footer-links {
            background-color: #4a5a7d;
            color: white;
            padding: 10px;
            margin-top: 20px;
        }

        .footer-links p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="https://www.logoartz.com/assets/images/logo-v1.png" alt="Logo Artz" class="logo">
            <!-- Replace with actual logo path -->
            <div class="invoice-title">Invoice</div>
        </div>

        <div class="info-section">
            <div class="contact-info">
                <div><strong>To:</strong> {{ $Customer->CustomerName }}</div>
                <div><strong>Email:</strong> {{ $Customer->Email }}</div>
                <div><strong>Address:</strong> {{ $Customer->Address }}</div>
                <div><strong>Phone:</strong> {{ $Customer->Cell }}</div>
            </div>

            <div class="invoice-details" style="text-align: right;">
                <div><strong>Invoice Date:</strong> {{ date('j M Y', strtotime($todaydate)) }}</div>
                <div><strong>Due Date:</strong> {{ date('j M Y', strtotime($Duedate)) }} </div>
                <div><strong>Invoice Number:</strong> {{ $invoice_number }}</div>
            </div>
        </div>

        <div class="section-title">{{ $periodline }}</div>

        <table class="table">
            <thead>
                <tr>
                    <th>S. No</th>
                    <th class="th">Order#</th>
                    <th>Description</th>
                    <th>Job Category</th>
                    <th>Date</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>$ Amount</th>

                </tr>
            </thead>
            <tbody>

                @if (!empty($DigiOrders))
                    @foreach ($DigiOrders as $key => $digi)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $digi['orId'] }}</td>
                            <td>{{ $digi['orName'] }}</td>
                            <td>Digitizing</td>
                            <td>{{ date('j M Y', strtotime($digi['orDate'])) }}</td>
                            <td>{{ $digi['orQty'] }}</td>
                            <td>{{ $digi['orUnitPrice'] }} </td>
                            <td>{{ $digi['orDiscount'] }}</td>
                            <td>{{ $digi['orTotal'] }} </td>

                        </tr>
                    @endforeach
                @endif

                @if (!empty($VecOrders))
                    @foreach ($VecOrders as $vector)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $divectorgi['orId'] }}</td>
                            <td>{{ $vector['orName'] }}</td>
                            <td>Vector</td>
                            <td>{{ date('j M Y', strtotime($vector['orDate'])) }}</td>
                            <td>{{ $vector['orQty'] }}</td>
                            <td>{{ $vector['orUnitPrice'] }} </td>
                            <td>{{ $vector['orDiscount'] }}</td>
                            <td>{{ $vector['orTotal'] }} </td>

                        </tr>
                    @endforeach
                @endif
                <tr class="total-row">
                    <td colspan="8">TOTAL</td>
                    <td>$15</td>
                </tr>
            </tbody>
            <tfoot>
                <tr style="text-align: center;">
                    <td></td>
                    <td style="text-align: left;"><b>TOTAL</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="td" style="background-color: #bdbec0; color: red"><b>{{ $totalQuantity }}</b></td>
                    <td></td>
                    <td class="td" style="background-color: #bdbec0; color: red"><b>{{ $Discount }}</b></td>
                    <td class="td" style="background-color: #bdbec0; color: red"><b>${{ $TotalPrice }}</b></td>

                </tr>
            </tfoot>
        </table>

        <div class="amount">In words: Fifteen Dollars Only.</div>

        <div class="footer">
            <a href="{{ $Pay_URL }}">
                <p>
                    <strong>PLEASE CLICK HERE TO MAKE YOUR PAYMENT</strong>
                </p>
            </a>
            <p class="note">Note: If you have any issues in reference to the invoice, please do not hesitate to give a
                call or email us.</p>
            <p>WE APPRECIATE YOUR BUSINESS, THANKS FOR CHOOSING LOGO ARTZ!</p>
        </div>

        <div class="footer-links">
            <p>LOGO ARTZ</p>
            <p>917-310-3789 | info@logoartz.com | www.logoartz.com</p>
        </div>
    </div>

</body>

</html>
