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
            'tell',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getGenderLabelAttribute()
        {
            switch ($this->attributes['gender']) {
                case 1:
                    return '男性';
                case 2:
                    return '女性';
                case 3:
                    return 'その他';
                default:
                    return '不明';
            }
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
                switch ($gender) {
                    case '男性':
                        $query->where('gender', 1);
                        break;
                    case '女性':
                        $query->where('gender', 2);
                        break;
                    case 'その他':
                        $query->where('gender', 3);
                        break;
                    default:
                        $query->whereNull('gender');
                }
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
