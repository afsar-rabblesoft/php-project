<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
define('MAIL_FROM_EMAIL', 'no-reply@sportingsequal.com');

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data = [])
    {
        $this->user_data = $user_data;
        // error_log(print_r(config('mail.from.name')));

        // error_log(print_r($user_data, true));

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(MAIL_FROM_EMAIL, config('mail.from.name'))
            ->subject('Forgot Password - ' . config('mail.from.name'))
            ->view('mail.forgot-password')
            ->with(['user_data' => $this->user_data]);
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Forgot Password',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }
}
