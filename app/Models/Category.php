<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ tambahkan ini
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; // ✅ WAJIB

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}