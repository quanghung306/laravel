<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = ['name', 'email', 'password', 'role'];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
