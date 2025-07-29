<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log; // Pastikan ini diimpor untuk logging

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Umumnya, semua user UMKM bisa melihat daftar produk mereka sendiri
        return $user->role === 'umkm';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        // User admin bisa melihat semua produk.
        // User UMKM bisa melihat produk miliknya.
        return $user->role === 'admin' || ($user->umkm && $user->umkm->id === $product->umkm_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya user dengan role 'umkm' dan sudah memiliki entri UMKM yang bisa membuat produk
        return $user->role === 'umkm' && $user->umkm()->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): Response
    {
        // Semua user diizinkan mengedit produk
        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): Response
    {
        Log::info('ProductPolicy@delete called', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'user_umkm_id' => $user->umkm ? $user->umkm->id : null,
            'product_id' => $product->id,
            'product_umkm_id' => $product->umkm_id
        ]);

        // User admin selalu bisa menghapus.
        if ($user->role === 'admin') {
            Log::info('User is admin, allowing delete');
            return Response::allow();
        }

        // User UMKM hanya bisa menghapus produk miliknya.
        // Pastikan user memiliki UMKM terlebih dahulu ($user->umkm)
        if (!$user->umkm) {
            Log::warning('User does not have UMKM association');
            return Response::deny('Anda tidak memiliki izin untuk menghapus produk ini.');
        }

        // Kemudian bandingkan ID UMKM user dengan umkm_id produk.
        $canDelete = $user->umkm->id === $product->umkm_id;
        Log::info('Checking UMKM ownership', ['can_delete' => $canDelete]);
        
        return $canDelete
            ? Response::allow()
            : Response::deny('Anda tidak memiliki izin untuk menghapus produk ini.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false; // Umumnya tidak diizinkan untuk UMKM
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false; // Umumnya tidak diizinkan untuk UMKM
    }
}
