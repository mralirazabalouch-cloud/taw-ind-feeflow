
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Invoice - FeeFlow</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h1 { color: #172554; }

        label {
            display: block;
            margin-top: 18px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            margin-top: 25px;
            background: #2563eb;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        a { color: #2563eb; }

        .error { color: red; }
    </style>
</head>

<body>

<div class="container">

    <h1>Create New Invoice</h1>
    <p>Generate a fee invoice for a student.</p>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ url('/invoices') }}" method="POST">

        @csrf

        <label>Select Student</label>

        <select name="student_id" id="student_id" required>
            <option value="">Choose Student</option>

            @foreach ($students as $student)
                <option
                    value="{{ $student->id }}"
                    data-fee="{{ $student->monthly_fee }}"
                    {{ old('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </select>

        <label>Invoice Amount (PKR)</label>

        <input
            type="number"
            name="amount"
            id="amount"
            step="0.01"
            min="0.01"
            value="{{ old('amount') }}"
            required>

        <label>Payment Due Date</label>

        <input
            type="date"
            name="due_date"
            min="{{ date('Y-m-d') }}"
            value="{{ old('due_date') }}"
            required>

        <button type="submit">Generate Invoice</button>

    </form>

    <p>
        <a href="{{ url('/students') }}">Back to Students</a>
    </p>

</div>

<script>
    const studentSelect = document.getElementById('student_id');
    const amountInput = document.getElementById('amount');

    studentSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];

        amountInput.value = selected.dataset.fee || '';
    });
</script>

</body>
</html>
