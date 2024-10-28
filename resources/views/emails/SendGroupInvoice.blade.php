
<!-- resources/views/emails/sendInvoice.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Details</title>
</head>
<body>
<h1>Invoice Details</h1>
<p>Dear {{ $invoice->patient->name }},</p>
<p>We hope this message finds you well. Below are the details of your invoice:</p>

<table>
    <tr>
        <th>Invoice Date</th>
        <td>{{ $invoice->invoice_date }}</td>
    </tr>
    <tr>
        <th>Patient Name</th>
        <td>{{ $invoice->patient->name }}</td>
    </tr>
    <tr>
        <th>Doctor</th>
        <td>{{ $invoice->doctor->name }}</td>
    </tr>
    <tr>
        <th>Section</th>
        <td>{{ $invoice->section->name }}</td>
    </tr>
    <tr>
        <th>Service</th>
        <td>{{ $invoice->multiservice->name }}</td>
    </tr>
    <tr>
        <th>Price Before Discount</th>
        <td>{{ $invoice->price }}</td>
    </tr>
    <tr>
        <th>Discount</th>
        <td>{{ $invoice->discount_value }}</td>
    </tr>
    <tr>
        <th>Tax Rate</th>
        <td>{{ $invoice->tax_rate }}%</td>
    </tr>
    <tr>
        <th>Tax Value</th>
        <td>{{ $invoice->tax_value }}</td>
    </tr>
    <tr>
        <th>Total with Tax</th>
        <td>{{ $invoice->tot_with_tax }}</td>
    </tr>
    <tr>
        <th>Payment status</th>

            @if($invoice->type==1)
                <td style="color:green">Paid</td>
            @else
            <td style="color:Red">Unpaid</td>
            @endif

    </tr>
</table>

<p>Thank you for choosing our hospital. If you have any questions, feel free to contact us.</p>

<p>Best regards,<br>Hospital Team</p>
</body>
</html>
