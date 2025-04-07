<?php

namespace App\Policies;

use App\Models\Broker;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BrokerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($userID): bool
    {
        //
        if(auth('admin')->check() && auth('admin')->user()->hasPermissionTO('Read-MemberCustomer')){
            return true; 
        }
         else{
            return false;
         }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($userID): bool
    {
        //
        if(auth('admin')->check() && auth('admin')->user()->hasPermissionTO('Add-MemberCustomer')){
            return true; 
        }
         else{
            return false;
         }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($userID): bool
    {
        //
        if(auth('admin')->check() && auth('admin')->user()->hasPermissionTO('Add-MemberCustomer')){
            return true; 
        }
         else{
            return false;
         }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($userID, Broker $broker): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($userID, Broker $broker): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($userID, Broker $broker): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($userID, Broker $broker): bool
    {
        //
    }
}
