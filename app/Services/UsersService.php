<?php

namespace App\Services;

use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UsersService
{
    // Lấy tất cả người dùng
    public function getAll()
    {
        try {
            return Users::all();
        } catch (Exception $e) {
            throw new Exception('Error fetching users: ' . $e->getMessage());
        }
    }

    // Lấy người dùng theo ID
    public function getById($id)
    {
        try {
            return Users::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('User not found with ID ' . $id);
        } catch (Exception $e) {
            throw new Exception('Error fetching user by ID: ' . $e->getMessage());
        }
    }

    // Tạo người dùng mới
    public function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                return Users::create($data);
            });
        } catch (Exception $e) {
            throw new Exception('Error creating user: ' . $e->getMessage());
        }
    }
}
