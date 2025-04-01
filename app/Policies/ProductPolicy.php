<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can view the model.
     */
    // public function view(User $user, Product $product): bool
    // {
    //     //
    // }

    // Chỉ Admin mới được tạo sản phẩm
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

     // Chỉ Admin mới được sửa sản phẩm
     public function update(User $user, Product $product): bool
     {
         return $user->isAdmin() || $user->id === $product->user_id;
     }

    // Chỉ Admin mới được xóa sản phẩm
    public function delete(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Product $product): bool
    // {
        //
    // }

    /**
      * Determine whether the user can permanently delete the model.
      */
    // public function forceDelete(User $user, Product $product): bool
    // {
    //     //
    // }
}
