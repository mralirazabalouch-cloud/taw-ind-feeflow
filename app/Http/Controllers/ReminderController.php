<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Mail\FeeReminder;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    public function send(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect('/invoices')
                ->with('error', 'This invoice is already paid.');
        }

        if (!$invoice->student || !$invoice->student->email) {
            return redirect('/invoices')
                ->with('error', 'Student email address is missing.');
        }

        Mail::to($invoice->student->email)
            ->send(new FeeReminder($invoice));

        return redirect('/invoices')
            ->with('success', 'Reminder processed successfully!');
    }
}