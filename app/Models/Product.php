<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'category_id'
    ];
    // ✅ TAMBAHKAN INI
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
