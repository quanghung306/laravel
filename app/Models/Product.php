<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];
    public function Cart_items()
    {
        return $this->hasMany(cart_items::class);
    }
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
