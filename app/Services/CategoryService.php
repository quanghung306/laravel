<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class CategoryService
{
    // Lấy tất cả danh mục cha + con
    public function getAllCategory()
    {
        return Category::whereNull('parent_id')->with('children')->get();
    }
    // Lấy danh mục cụ thể + danh mục con
    public function getCategoryById($id)
    {
        return Category::with('children')->findOrFail($id);
    }
    // Thêm danh mục mới
    public function createCategory($data)
    {
        return DB::transaction(function () use ($data) {
            return Category::create($data);
        });
    }
    // Cập nhật danh mục
    public function updateCategory($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $category = Category::findOrFail($id);
            $category->update($data);
            return $category;
        });
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        return DB::transaction(function () use ($id) {
            $category = Category::findOrFail($id);
            $category->delete();
            return ['message' => 'Deleted successfully'];
        });
    }

    // Lấy tất cả sản phẩm của danh mục
    public function getCategoryProducts(int $id)
    {
        $category = Category::findOrFail($id);
        return $category->getAllProducts()->get();
    }
    // Lấy danh mục con
    public function getCategoryChildren(int $id)
    {
        $category = Category::with('children')->findOrFail($id);
        return $category->children;
    }

}
