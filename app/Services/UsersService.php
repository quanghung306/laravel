<?php

namespace App\Services;

use App\Models\User; // Đổi từ Users thành User
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersService
{
    // Lấy tất cả người dùng
    public function getAll(Request $request)
    {
        return $request->user();
    }

    // Lấy người dùng theo ID
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    // Tạo người dùng mới
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['password'] = Hash::make($data['password']); // Hash password
            return User::create($data);
        });
    }
}
