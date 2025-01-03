<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
use HasFactory;
protected $fillable = [
        'category_id', // 追加
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'content'
];

public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}
}
