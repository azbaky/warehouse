<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Permission::create(['name'=>'Create-Brokers','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Brokers','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Brokers','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Brokers','guard_name'=>'admin']);
        // User::create(['name'=>'mohammed','mobile'=>'0456754656','email'=>'admin@admin.com','password'=>Hash::make('123456')]);
        // Admin::create(['name'=>'mohammed','email'=>'admin@admin.com','password'=>Hash::make('123456')]);
        // $this->call([
        //     CategorySeeder::class,
        //     // Other seeders can be added here
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',

        

        // Permission::create(['name'=>'Create-Role','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Roles','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Role','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Role','guard_name'=>'admin']);

        // Permission::create(['name'=>'Create-Permission','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Permissions','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Permission','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Permission','guard_name'=>'admin']);

        // Permission::create(['name'=>'Create-Customer','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Customers','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Customer','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Customer','guard_name'=>'admin']);


        // Permission::create(['name'=>'Create-Item','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Items','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Item','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Item','guard_name'=>'admin']);

        // Permission::create(['name'=>'Create-Order','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Order','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Order','guard_name'=>'admin']);

        // Permission::create(['name'=>'Create-Category','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-Categorys','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-Category','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-Category','guard_name'=>'admin']);
        
        //  Permission::create(['name'=>'Change-order-status','guard_name'=>'admin']);
        // Permission::create(['name'=>'test','guard_name'=>'broker']);

        $this->call(ItemSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);

        $this->call(RoleHasPermissionsTableSeeder::class);

        
    }
}
