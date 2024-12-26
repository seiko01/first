<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
        protected $fillable = [
                'category_id',
                'name',
                'gender',
                'email',
                'tel',
                'address',
                'building',
                'inquiry_type',
                'content'
        ];

        public function category()
        {
        return $this->belongsTo(Category::class);
        }
}
