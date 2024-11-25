<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class OTP extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $FirstName;
    public $LastName;

    /**
     * Create a new message instance.
     */
    public function __construct($otp, $FirstName, $LastName)
    {
        $this->otp = $otp;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your OTP Code',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'OTPmail', 
            with: [
                'otp' => $this->otp, 
                'FirstName' => $this->FirstName, 
                'LastName' => $this->LastName,
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
        return [
           
        ];
    }
}
