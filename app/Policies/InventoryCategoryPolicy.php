<?php

namespace App\Policies;

use App\Models\InventoryCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class InventoryCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InventoryCategory $inventoryCategory): bool
    {
        //
        
    }

    // index
    public function index(User $user): Response
    {
        return $user->role === 'admin'
            ? Response::allow()
            : Response::deny('You are not authorized to view this page');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InventoryCategory $inventoryCategory): bool
    {   
        // Check if $inventoryCategory created less than 5 minute from current time
        return $inventoryCategory->created_at->diffInMinutes(now()) < 5 ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InventoryCategory $inventoryCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InventoryCategory $inventoryCategory): bool
    {
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InventoryCategory $inventoryCategory): bool
    {
        //
    }
}
