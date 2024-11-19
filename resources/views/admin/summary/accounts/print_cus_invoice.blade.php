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
        margin-bottom: 20px;
    }

    .header .logo {
        width: 150px; /* Adjusted size for better visibility */
    }

    .header .invoice-title {
        background-color: #EFBD68;
        color: #fff;
        padding: 10px 20px;
        font-size: 24px; /* Increased for emphasis */
        font-weight: bold;
        text-align: center;
    }

    .info-section {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 18px;
        gap: 20px; /* Added gap for proper spacing */
    }

    .contact-info,
    .invoice-details {
        width: 100%;
        line-height: 1.5; /* Increased line-height for readability */
    }

    .contact-info div,
    .invoice-details div {
        margin-bottom: 10px; /* Added margin for better spacing */
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
        background-color: #EFBD68;
        color: #000;
        padding: 10px;
    }

    .table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .total-row td {
        background-color: #EFBD68;
        color: #000;
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
        font-size: 18px;
        margin-top: 20px;
    }

    .footer .note {
        color: red;
        font-weight: bold;
    }

    .footer-links {
        background-color: #EFBD68;
        color: #000;
        padding: 10px;
        margin-top: 20px;
    }

    .footer-links p {
        margin: 5px 0;
    }
</style>

<div class="container">
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents('https://login.logoartz.com/assets/admin/images/Logo_artz_logo_new.png')) }}" alt="Logo Artz" class="logo" width="250px">
    <div class="header">
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
                <th>Order#</th>
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
            @if (!empty($digiOrders))
                @foreach ($digiOrders as $key => $digi)
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
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="8">TOTAL</td>
                <td>${{ $TotalPrice }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <a href="{{ $Pay_URL }}">
            <p><strong>PLEASE CLICK HERE TO MAKE YOUR PAYMENT</strong></p>
        </a>
        <p class="note">Note: If you have any issues in reference to the invoice, please do not hesitate to give a call or email us.</p>
        <p>WE APPRECIATE YOUR BUSINESS, THANKS FOR CHOOSING LOGO ARTZ!</p>
    </div>

    <div class="footer-links">
        <p>LOGO ARTZ</p>
        <p>917-310-3789 | info@logoartz.com | www.logoartz.com</p>
    </div>
</div>
