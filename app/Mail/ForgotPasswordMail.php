<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $reset_code;

    /**
     * Create a new message instance.
     */
    public function __construct($name,$reset_code)
    {
        $this->name = $name;
        $this->reset_code = $reset_code;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'emails.auth.forgot_password_mail',
    //     )->with([
    //         'name'=>$this->name,
    //         'reset_code'=>$this->reset_code
    //     ]);
    // }

    public function build(){
        return $this->markdown('emails.auth.forgot_password_mail')->with([
            'name'=>$this->name,
            'reset_code'=>$this->reset_code
        ]);
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
