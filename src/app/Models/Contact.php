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

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        return $query;
    }
    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
            $query->where(function ($q) use ($gender) {
                if ($gender === '男性') {
                    $q->where('gender', 'male');
                }elseif ($gender === '女性') {
                $q->where('gender', 'female');
                }elseif ($gender === 'その他') {
                $q->where('gender', 'other');
                }
            });
        }
        return $query;
    }

    public function scopeNameSearch($query, $name)
    {
        if (!empty($name)) {
            $query->where(function ($q) use ($name) {
            $q->where('first_name', 'like', '%' . $name . '%')
            ->orWhere('last_name', 'like', '%' . $name . '%')
            ->orWhere('email', 'like', '%' . $name . '%');
            });
        }
        return $query;
    }

    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
        return $query;
    }

}
