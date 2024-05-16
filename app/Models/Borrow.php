<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product;
use App\Models\User;
use App\Models\Branch;


class Borrow extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'branch_id',
        'borrow_date',
        'return_date',
        'actual_return_date'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function customer() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch() {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
