<?php

namespace App\Http\Controllers;

use App\Services\CartsService;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    protected $CartsService;

    public function __construct(CartsService $CartsService)
    {
        $this->CartsService = $CartsService;
    }

    public function index()
    {
        return response()->json($this->CartsService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->CartsService->getById($id));
    }

    public function store(Request $request)
    {
        return response()->json($this->CartsService->create($request->all()), 201);
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->CartsService->update($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Deleted Successfully'], 200);
    }
}
