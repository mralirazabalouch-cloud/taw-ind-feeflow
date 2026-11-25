<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoices - FeeFlow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            padding: 30px;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }
        h1 { color: #172554; }
        .button {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 11px 16px;
            border-radius: 6px;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            padding: 13px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        th { background: #f1f5f9; }
        .success { color: green; }
        .error { color: red; }
        .pending {
            color: #d97706;
            font-weight: bold;
        }
        .paid {
            color: green;
            font-weight: bold;
        }
        .pay-button {
            display: inline-block;
            background: #16a34a;
            color: white;
            padding: 9px 15px;
            border-radius: 6px;
            text-decoration: none;
        }
        .reminder-button {
            background: #f59e0b;
            color: white;
            padding: 9px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Invoices Management</h1>
    <p>Manage all student fee invoices.</p>

    <a class="button" href="{{ url('/invoices/create') }}">
        + Create New Invoice
    </a>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Invoice No.</th>
                <th>Student Name</th>
                <th>Amount</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Reminder</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>

                    <td>{{ $invoice->student->name ?? 'Unknown' }}</td>

                    <td>
                        PKR {{ number_format($invoice->amount, 2) }}
                    </td>

                    <td>
                        {{ $invoice->due_date->format('d M Y') }}
                    </td>

                    <td class="{{ $invoice->status }}">
                        {{ ucfirst($invoice->status) }}
                    </td>

                    <td>
                        @if ($invoice->status === 'pending')
                            <a class="pay-button"
                               href="{{ url('/invoices/'.$invoice->id.'/pay') }}">
                                Pay Now
                            </a>
                        @else
                            <span class="paid">Paid</span>
                        @endif
                    </td>

                    <td>
                        @if ($invoice->status === 'pending')
                            <form method="POST"
                                  action="{{ url('/invoices/'.$invoice->id.'/reminder') }}">
                                @csrf

                                <button type="submit"
                                        class="reminder-button">
                                    Send Reminder
                                </button>
                            </form>
                        @else
                            Not Required
                        @endif
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7">
                        No invoices generated yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p>
        <a href="{{ url('/') }}">Back to Dashboard</a>
    </p>

</div>

</body>
</html>