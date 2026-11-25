
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students - FeeFlow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }
        h1 { color: #172554; }
        a.button {
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
        .success {
            color: green;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Students Management</h1>
        <p>Manage all registered students.</p>

        <a class="button" href="{{ url('/students/create') }}">
            + Add New Student
        </a>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Monthly Fee</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email ?? '-' }}</td>
                        <td>{{ $student->phone ?? '-' }}</td>
                        <td>PKR {{ number_format($student->monthly_fee, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No students added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p><a href="{{ url('/') }}">Back to Dashboard</a></p>
    </div>
</body>
</html>
