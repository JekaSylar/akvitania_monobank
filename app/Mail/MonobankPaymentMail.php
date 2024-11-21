<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonobankPaymentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $reference;
    protected $amount;
    protected $destination;


    /**
     * Create a new message instance.
     */
    public function __construct($reference, $amount, $destination)
    {
        $this->reference = $reference;
        $this->amount = $amount;
        $this->destination = $destination;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Monobank оплата прошла успешно по заказу № '.$this->reference,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.monobank',
            with: [
                'reference' => $this->reference,
                'amount' => $this->amount,
                'destination' => $this->destination,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
