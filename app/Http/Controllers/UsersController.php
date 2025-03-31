<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UsersService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index(Request $request)
    {
        $user = $this->usersService->getAll($request);
        return new UserResource($user);
    }
    public function show($id)
    {
        try {
            $user = $this->usersService->getById($id);
            return new UserResource($user);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
