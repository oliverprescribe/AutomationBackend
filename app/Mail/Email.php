<?php

namespace App\Mail;

use App\Models\Letter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Headers;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this-> details = $details;

    }

    /**
     * Get the message envelope.
     */
    public function headers(): Headers
{
    if( !empty($this->details['ojn_priority']) ||  !empty($this->details['ojn_routine']) ){
        return new Headers(

            text: [
                'X-Priority' => '1',
                'X-MSMail-Priority' => 'High',
                'Importance' => 'High',
            ],
        );
    }else {
        return new Headers(
            text: [

            ],
        );
    }

}
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->details['subject'],

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {


        return new Content(
            view: 'emails.mail',
            with: [
                'details' => $this->details,
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
