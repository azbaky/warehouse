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
         Role::firstOrCreate(['name'=>'Super-Admin','guard_name'=>'admin']);
        Role::firstOrCreate(['name'=>'Content','guard_name'=>'admin']);
        Role::firstOrCreate(['name'=>'Human-Resources','guard_name'=>'admin']);

        Role::firstOrCreate(['name'=>'Broker','guard_name'=>'broker']);

    }
}
