<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'customers' && $permission['action'] === 'View Any';
        });
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Customer $customer): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'customers' && $permission['action'] === 'View';
        });
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'customers' && $permission['action'] === 'Create';
        });
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Customer $customer): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'customers' && $permission['action'] === 'Update';
        });
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Customer $customer): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'customers' && $permission['action'] === 'Delete';
        });
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Customer $customer): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'customers' && $permission['action'] === 'Restore';
        });
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Customer $customer): bool
    {
        return $user->roles->pluck('permissions')->flatten()->contains(function ($permission) {
            return $permission['name'] === 'customers' && $permission['action'] === 'Force Delete';
        });
    }
}
