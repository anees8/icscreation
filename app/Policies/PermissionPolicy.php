<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'permissions' && $permission['action'] === 'View Any';
        });
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
       return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'permissions' && $permission['action'] === 'View';
        });
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
       return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'permissions' && $permission['action'] === 'Create';
        });
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
       return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'permissions' && $permission['action'] === 'Update';
        });
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
       return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'permissions' && $permission['action'] === 'Delete';
        });
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
       return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'permissions' && $permission['action'] === 'Restore';
        });
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
       return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'permissions' && $permission['action'] === 'Force Delete';
        });
    }
}
