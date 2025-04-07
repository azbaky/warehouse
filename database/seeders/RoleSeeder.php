<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Role::creatr(['name'=>'Super-Admin','guard_name'=>'admin']);
        Role::create(['name'=>'Content','guard_name'=>'admin']);
        Role::create(['name'=>'Human-Resources','guard_name'=>'admin']);

        Role::create(['name'=>'Broker','guard_name'=>'broker']);

    }
}
