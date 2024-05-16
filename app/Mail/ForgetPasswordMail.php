<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $newpassword;
    protected $resetlink;


    public function __construct(User $user, $newpassword, $resetlink)
    {
        $this->user = $user;
        $this->newpassword = $newpassword;
        $this->resetlink = $resetlink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.forget-password') // Xác định view cho email
                    ->subject('Xác nhận lấy lại mật khẩu') // Chủ đề của email
                    ->with([
                        'name' => $this -> user -> name, 
                        'newpassword' => $this -> newpassword,
                        'resetlink' => $this -> resetlink,
                    ]);
    }
}
