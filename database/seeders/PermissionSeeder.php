<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        Permission::create(['name'=>'Create-','guard_name'=>'']);
        Permission::create(['name'=>'Read-','guard_name'=>'']);
        Permission::create(['name'=>'Update-','guard_name'=>'']);
        Permission::create(['name'=>'Delete-','guard_name'=>'']);
         */
        // Permission::create(['name'=>'Create-Role','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Roles','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Role','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Role','guard_name'=>'admin']);
        
        // Permission::create(['name'=>'Create-Permission','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Permissions','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Permission','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Permission','guard_name'=>'admin']);

        // Permission::create(['name'=>'Create-City','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Cities','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-City','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-City','guard_name'=>'admin']);


        // Permission::create(['name'=>'Create-Category','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Categories','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Category','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Category','guard_name'=>'admin']);

       

        // Permission::create(['name'=>'Create-','guard_name'=>'']);
        // Permission::create(['name'=>'Read-',  'guard_nam'=>'']);
        // Permission::create(['name'=>'Update-','guard_nam'=>'']);
        // Permission::create(['name'=>'Delete-','guard_nam'=>'']);

        Permission::create(['name'=>'Read-Categories','guard_name'=>'broker']);
        Permission::create(['name'=>'Read-Cities','guard_name'=>'broker']);




    }
}
