<?php
namespace App\Services;
use App\Models\Cart;


class CartsService
{
    public function getAll()
    {
        return Cart::all();
    }

    public function getById($id)
    {
        return Cart::findOrFail($id);
    }

    public function create(array $data)
    {
        return Cart::create($data);
    }

    public function update($id, array $data)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($data);
        return $cart;
    }

    public function delete($id)
    {
        return Cart::findOrFail($id)->delete();
    }
}
