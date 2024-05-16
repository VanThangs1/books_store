<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class OrderNotiMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $order_list;
    protected $total_amount;
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $order_list, $total_amount, $order)
    {
        $this -> user = $user;
        $this -> order_list = $order_list;
        $this -> total_amount = $total_amount;
        $this -> order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order-noti')
            ->subject('Thông báo đơn hàng') // Chủ đề của email
            ->with([
                'user' => $this -> user, 
                'order' => $this -> order,
                'order_list' => $this -> order_list,
                'total_amount' => $this -> total_amount,
            ]);;
    }
}
