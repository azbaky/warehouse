<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Ensure the role exists
       Role::firstOrCreate(['name' => 'Super-Admin']);

       // Create or get the admin
       $admin = Admin::firstOrCreate([
           'email' => 'admin@gmail.com'
       ], [
           'name' => 'admin',
           'password' => Hash::make('12345'),
       ]);

       // Sync the role
       $admin->syncRoles('Super-Admin');

    }
}
