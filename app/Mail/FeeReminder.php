<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FeeReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Invoice $invoice)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fee Payment Reminder - FeeFlow',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.fee-reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}