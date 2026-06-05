<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'image',
        'price',
        'stock',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
