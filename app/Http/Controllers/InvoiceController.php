<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Student;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Show all invoices
    public function index()
    {
        $invoices = Invoice::with('student')
            ->latest()
            ->get();

        return view('invoices.index', compact('invoices'));
    }

    // Show invoice creation form
    public function create()
    {
        $students = Student::orderBy('name')->get();

        return view('invoices.create', compact('students'));
    }

    // Save new invoice
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0.01',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $invoice = Invoice::create([
            'student_id' => $validated['student_id'],
            'invoice_number' => 'INV-' . now()->format('YmdHis') . '-' . random_int(100, 999),
            'amount' => $validated['amount'],
            'due_date' => $validated['due_date'],
            'status' => 'pending',
        ]);

        return redirect('/invoices')
            ->with('success', 'Invoice generated successfully!');
    }
}
