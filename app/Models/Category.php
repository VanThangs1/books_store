<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'added_by',
        'title',
        'slug',
        'image',
        'thumbnail',
        'status',
        'content',
        'parent_id',
        'meta_title',
        'description',
        'meta_description',
        'parent_id',
        'deleted_at'
    ];

    
}
