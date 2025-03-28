<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['name','parent_id'];

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

    //   Lấy tất cả sản phẩm của category và các category con
    public function getAllProducts()
    {
        return Product::whereIn('category_id', $this->getAllDescendantIds());
    }

    //   Lấy tất cả ID của các category con (đệ quy)
    protected function getAllDescendantIds(): array
    {
        $ids = [$this->id];
        $this->load('children');
        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllDescendantIds());
        }

        return $ids;
    }
    //  Scope để lấy các category gốc (không có parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
    //   Scope để lấy các category có parent
    public function scopeHasParent($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function color() {
        if ($this->color == 0) return "red";

        return "blue";
    }
}
