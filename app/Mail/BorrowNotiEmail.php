<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Product;

class BorrowNotiEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     protected $title;
     protected $price;
     protected $total_days;
     protected $borrow_date;
     protected $return_date;

    public function __construct($title, $price, $total_days, $borrow_date, $return_date)
    {
        $this -> title = $title;
        $this -> price = $price;
        $this -> total_days = $total_days;
        $this -> borrow_date = $borrow_date;
        $this -> return_date = $return_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
     
        return $this->view('mail.borrow-noti') // Xác định view cho email
                    ->subject('Thông báo đơn mượn sách') // Chủ đề của email
                    ->with([
                        'title' => $this -> title, 
                        'price' => $this -> price,
                        'total_days' => $this -> total_days,
                        'borrow_date' => $this -> borrow_date,
                        'return_date' => $this -> return_date
                    ]);
    }
}
