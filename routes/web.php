<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReminderController;
use App\Models\Student;
use App\Models\Invoice;

// Dashboard
Route::get('/', function () {
    $totalStudents = Student::count();
    $totalInvoices = Invoice::count();
    $pendingPayments = Invoice::where('status', 'pending')->sum('amount');
    $paidInvoices = Invoice::where('status', 'paid')->count();

    return view('dashboard', compact(
        'totalStudents',
        'totalInvoices',
        'pendingPayments',
        'paidInvoices'
    ));
});

// Student Management
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students', [StudentController::class, 'store']);

// Invoice Management
Route::get('/invoices', [InvoiceController::class, 'index']);
Route::get('/invoices/create', [InvoiceController::class, 'create']);
Route::post('/invoices', [InvoiceController::class, 'store']);

// Stripe Payment Routes
Route::get('/invoices/{invoice}/pay', [PaymentController::class, 'checkout']);
Route::get('/payment/success', [PaymentController::class, 'success']);

// Payment Reminder Route
Route::post('/invoices/{invoice}/reminder', [ReminderController::class, 'send']);