<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function checkout(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect('/invoices')
                ->with('success', 'Invoice already paid.');
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->create([
            'allowed_payment_method_types' => ['card'],
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => 'pkr',
                    'product_data' => [
                        'name' => 'Fee Invoice ' . $invoice->invoice_number,
                    ],
                    'unit_amount' => (int) round($invoice->amount * 100),
                ],
                'quantity' => 1,
            ]],

            'metadata' => [
                'invoice_id' => (string) $invoice->id,
            ],

            'success_url' => url('/payment/success')
                . '?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => url('/invoices'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string',
        ]);

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->retrieve(
            $request->session_id
        );

        $invoice = Invoice::findOrFail(
            $session->metadata->invoice_id
        );

        if (
            $session->payment_status === 'paid' &&
            $session->currency === 'pkr' &&
            $session->amount_total ===
                (int) round($invoice->amount * 100)
        ) {
            $invoice->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            return redirect('/invoices')
                ->with('success', 'Payment successful!');
        }

        return redirect('/invoices')
            ->with('error', 'Payment not verified.');
    }
}