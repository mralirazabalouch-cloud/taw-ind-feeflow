<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fee Payment Reminder</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <h1 style="color: #2563eb;">FeeFlow</h1>

    <h2>Fee Payment Reminder</h2>

    <p>Dear {{ $invoice->student->name }},</p>

    <p>This is a friendly reminder that your fee payment is pending.</p>

    <p><strong>Invoice Number:</strong>
        {{ $invoice->invoice_number }}
    </p>

    <p><strong>Amount:</strong>
        PKR {{ number_format($invoice->amount, 2) }}
    </p>

    <p><strong>Due Date:</strong>
        {{ $invoice->due_date->format('d M Y') }}
    </p>

    <a href="{{ url('/invoices/'.$invoice->id.'/pay') }}"
       style="background: #2563eb; color: white; padding: 12px 20px; text-decoration: none; border-radius: 6px;">
        Pay Now
    </a>

    <p>Please complete your payment as soon as possible.</p>

    <p>Thank you,<br>FeeFlow Team</p>

</body>
</html>