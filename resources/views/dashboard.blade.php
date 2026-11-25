<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FeeFlow Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            margin: 0;
            padding: 30px;
        }
        h1 { color: #172554; }
        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 25px;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            min-width: 180px;
            box-shadow: 0 3px 12px #00000012;
        }
        .card h2 { color: #2563eb; }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
        }
        .button {
            background: #2563eb;
            color: white;
            padding: 13px 20px;
            border-radius: 6px;
            text-decoration: none;
        }
        .button:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
    <h1>FeeFlow Dashboard</h1>
    <p>School & Tutor Fee Management System</p>

    <div class="cards">
        <div class="card">
            <h3>Total Students</h3>
            <h2>{{ $totalStudents }}</h2>
        </div>

        <div class="card">
            <h3>Total Invoices</h3>
            <h2>{{ $totalInvoices }}</h2>
        </div>

        <div class="card">
            <h3>Pending Payments</h3>
            <h2>PKR {{ number_format($pendingPayments, 2) }}</h2>
        </div>

        <div class="card">
            <h3>Paid Invoices</h3>
            <h2>{{ $paidInvoices }}</h2>
        </div>
    </div>

    <div class="actions">
        <a class="button" href="{{ url('/students') }}">
            Manage Students
        </a>

        <a class="button" href="{{ url('/invoices') }}">
            Manage Invoices
        </a>

        <a class="button" href="{{ url('/invoices/create') }}">
            + Create Invoice
        </a>
    </div>
</body>
</html>