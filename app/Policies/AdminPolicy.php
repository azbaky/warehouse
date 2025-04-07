<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;


class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($userId)
    {
        //
        // return auth('admin')->check() && auth('admin')->user()->hasPermissionTo('Read-Admins')
        // ? $this->allow()
        // : $this->deny();
          $user=auth('admin')->check()?'admin':'broker';
        if(auth($user)->check() && auth($user)->user()->hasPermissionTO('Read-Admins')){
            return true; 
        }
         else{
            return false;
         }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($userId, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($userId)
    {
        //
        // $user=auth('admin')->check()?'admin':'broker';
        if(auth('admin')->check() && auth('admin')->user()->hasPermissionTO('Add-Admin')){
            return true; 
        }
         else{
            return false;
         }

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($userId, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($userId, Admin $admin)
    {
        //
        if(auth('admin')->check() && auth('admin')->user()->hasPermissionTO('Delete-Admin')){
            return true; 
        }
         else{
            return false;
         }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($userId, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($userId, Admin $admin)
    {
        //
    }
}
