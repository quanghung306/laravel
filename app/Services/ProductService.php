<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductService
{
    // Lấy tất cả sản phẩm
    public function getAll()
    {
        return Product::with('category')->get();
    }

    // Lấy sản phẩm theo ID
    public function getById($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    // Tạo sản phẩm
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Product::create($data);
        });
    }

    // Cập nhật sản phẩm
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $product = Product::findOrFail($id);
            $product->update($data);
            return $product;
        });
    }

    // Xóa sản phẩm
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $product = Product::findOrFail($id);
            $product->delete();
            return true;
        });
    }
}
