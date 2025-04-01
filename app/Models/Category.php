<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['name', 'parent_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Lấy tất cả sản phẩm của category và category con
    public function getAllProducts()
    {
        return Product::whereIn('category_id', $this->getAllDescendantIds())->get();
    }

    // Lấy tất cả ID của các category con (đệ quy)
    protected function getAllDescendantIds(): array
    {
        $ids = [$this->id];
        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllDescendantIds());
        }
        return $ids;
    }

    // Lấy category gốc (không có parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // Lấy category có parent
    public function scopeHasParent($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
