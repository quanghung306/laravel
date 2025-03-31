<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Exception;
use Illuminate\Support\Facades\Log;

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
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    // Tạo sản phẩm mới
    public function store(StoreProductRequest $request)
    {

        $product = $this->productService->create($request->validated());
        return new ProductResource($product);
    }
    // Cập nhật sản phẩm
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $updatedProduct = $this->productService->update($id, $request->validated());
            return response()->json([
                'product' => new ProductResource($updatedProduct),
                'message' => 'Product updated successfully',
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    // Xóa sản phẩm
    public function destroy($id)
    {
        try {
            $this->productService->delete($id);
            return response()->json(['message' => 'Product deleted successfully'], 204);
        } catch (Exception $e) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
