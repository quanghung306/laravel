<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'quantity'];
    public function user()
    {
        return $this->belongsTo(Users::class);
    }
    public function cart_items()
    {
        return $this->hasMany(cart_items::class);
    }
}
