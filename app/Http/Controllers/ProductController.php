<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Lấy tất cả sản phẩm
    public function index()
    {
        return ProductResource::collection(
            $this->productService->getAll()->load('category')
        );
    }

    // Lấy sản phẩm theo ID
    public function show($id)
    {
        try {
            $product = $this->productService->getById($id);
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    // Tạo sản phẩm mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:category,id',
        ]);

        $product = $this->productService->create($validated);
        return new ProductResource($product);
    }

   // Cập nhật sản phẩm
   public function update(Request $request, $id)
   {
       try {
           $validated = $request->validate([
               'name' => 'sometimes|string|max:255',
               'description' => 'nullable|string',
               'price' => 'sometimes|numeric|min:0',
               'stock' => 'sometimes|integer|min:0',
               'category_id' => 'nullable|exists:category,id',
           ]);

           $updatedProduct = $this->productService->update($id, $validated);
           return response()->json([
               'product' => new ProductResource($updatedProduct),
               'message' => 'Product updated successfully',
        ]);

       } catch (ModelNotFoundException $e) {
           return response()->json(['message' => 'Product not found'], 404);
       }
   }
    // Xóa sản phẩm
    public function destroy($id)
    {
        try {
            $this->productService->delete($id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
