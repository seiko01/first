<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
            'first_name',
            'last_name',
            'email',
            'address',
            'building',
            'detail',
            'category_id',
            'gender',
            'tel',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
