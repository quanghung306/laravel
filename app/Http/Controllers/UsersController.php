<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $UsersService;

    public function __construct(UsersService $UsersService)
    {
        $this->UsersService = $UsersService;
    }

    public function index()
    {
        return response()->json($this->UsersService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->UsersService->getById($id));
    }
     // Tạo sản phẩm mới
     public function store(Request $request)
     {
         $product = $this->UsersService->create($request->all());
         return response()->json($product, 201);
     }
}
