<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;

use App\Services\categoryService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(categoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        // return response()->json($this->categoryService->getAllCategory());
        return CategoryResource::collection(
            $this->categoryService->getAllCategory()
        );
    }

    public function show($id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);
            return new CategoryResource($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        // return response()->json(
        //     $this->categoryService->getCategoryById($id));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|exists:category,id',
        ]);
        $category = $this->categoryService->createCategory(($validated), 201);
        return new CategoryResource($category);
    }


    public function update(Request $request, $id)
    {
        try {

            $validated = $request->validate([
                'name' => 'string|max:255',
                'parent_id' => 'nullable|exists:category,id'
            ]);
            $category = $this->categoryService->updateCategory($id, $validated);
            return response()->json([
                'category'=>new CategoryResource($category),
                'message'=> 'Category updated successfully'

            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    // Lấy tất cả sản phẩm thuộc danh mục (bao gồm cả danh mục con)
    public function products($id)
    {
        $products = $this->categoryService->getCategoryProducts($id);
        return new CategoryResource($products);
    }

    // Lấy tất cả danh mục con
    public function children($id)
    {
        $children = $this->categoryService->getCategoryChildren($id);
        return CategoryResource::collection($children);
    }

}
