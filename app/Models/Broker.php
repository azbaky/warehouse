<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Broker extends Authenticatable
{
    use HasFactory,HasRoles;
    public function getUserNameAttribute(){


        return $this->name;
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
