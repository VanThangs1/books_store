<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Product;

class OrderDetail extends Model
{
    use HasFactory;

    protected $filable = [
        'addby_id',
        'product_id',
        'order_id',
        'quantity',
        'item_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
