<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'added_by',
        'name',
        'slug',
        'biography',
        'image',
        'thumbnail',
        'status',
        'email',
        'phone_number',
        'address',
        'gender',
        'date_of_birth',
        'deleted_at',
    ];
}
