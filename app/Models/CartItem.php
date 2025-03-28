<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_items extends Model
{
    use HasFactory;
    protected $fillable = ['carts_id', 'product_id', 'quantity'];
    public function carts()
    {
        return $this->belongsTo(Carts::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
