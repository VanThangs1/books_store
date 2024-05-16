<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $verifylink;
    public function __construct($verifylink)
    {
        $this -> verifylink = $verifylink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.verify-email')
                    ->subject('Verify Email') // Chủ đề của email
                    ->with([
                        'verifylink' => $this -> verifylink,
                    ]);
    }
}
