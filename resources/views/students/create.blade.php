
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student - FeeFlow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            padding: 30px;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000012;
        }
        h1 { color: #172554; }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        button {
            margin-top: 20px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
        .error { color: #dc2626; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Student</h1>
        <p>Enter student details below.</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/students') }}" method="POST">
            @csrf

            <label>Student Name</label>
            <input type="text" name="name"
                   value="{{ old('name') }}" required>

            <label>Email</label>
            <input type="email" name="email"
                   value="{{ old('email') }}">

            <label>Phone Number</label>
            <input type="text" name="phone"
                   value="{{ old('phone') }}">

            <label>Monthly Fee (PKR)</label>
            <input type="number" name="monthly_fee"
                   min="0" step="0.01"
                   value="{{ old('monthly_fee') }}" required>

            <button type="submit">Save Student</button>
        </form>

        <p><a href="{{ url('/') }}">Back to Dashboard</a></p>
    </div>
</body>
</html>
