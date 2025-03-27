<?php
namespace App\Services;
use App\Models\Carts;


class CartsService
{
    public function getAll()
    {
        return Carts::all();
    }

    public function getById($id)
    {
        return Carts::findOrFail($id);
    }

    public function create(array $data)
    {
        return Carts::create($data);
    }

    public function update($id, array $data)
    {
        $cart = Carts::findOrFail($id);
        $cart->update($data);
        return $cart;
    }

    public function delete($id)
    {
        return Carts::findOrFail($id)->delete();
    }
}
