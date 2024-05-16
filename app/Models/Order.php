<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'total_amount',
        'order_title',
        'payment_method',
        'payment_status',
        'order_code',
        'order_note',
        'successfully_delivery_at',
        'shipping_address',
        'total_order_value',
        'order_status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user() {
        return $this -> belongsTo(User::class, 'user_id');
    }
}
