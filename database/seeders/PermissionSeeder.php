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
        
        Permission::firstOrCreate(['name'=>'Create-','guard_name'=>'']);
        Permission::firstOrCreate(['name'=>'Read-','guard_name'=>'']);
        Permission::firstOrCreate(['name'=>'Update-','guard_name'=>'']);
        Permission::firstOrCreate(['name'=>'Delete-','guard_name'=>'']);
         
        Permission::firstOrCreate(['name'=>'Create-Role','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Read-Roles','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Update-Role','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Delete-Role','guard_name'=>'admin']);
        
        Permission::firstOrCreate(['name'=>'Create-Permission','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Read-Permissions','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Update-Permission','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Delete-Permission','guard_name'=>'admin']);

        Permission::firstOrCreate(['name'=>'Create-City','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Read-Cities','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Update-City','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Delete-City','guard_name'=>'admin']);


        Permission::firstOrCreate(['name'=>'Create-Category','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Read-Categories','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Update-Category','guard_name'=>'admin']);
        Permission::firstOrCreate(['name'=>'Delete-Category','guard_name'=>'admin']);

       

        Permission::firstOrCreate(['name'=>'Create-','guard_name'=>'']);
        Permission::firstOrCreate(['name'=>'Read-',  'guard_name'=>'']);
        Permission::firstOrCreate(['name'=>'Update-','guard_name'=>'']);
        Permission::firstOrCreate(['name'=>'Delete-','guard_name'=>'']);

        Permission::firstOrCreate(['name'=>'Read-Categories','guard_name'=>'broker']);
        Permission::firstOrCreate(['name'=>'Read-Cities','guard_name'=>'broker']);




    }
}
