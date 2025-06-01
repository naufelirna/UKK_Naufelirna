<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        
        $admin = User::firstOrCreate(
            ['email' => 'coba@example.com'],
            [
                'name' => 'coba',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        
        $admin->assignRole($superAdminRole);
        
        $this->command->info('Admin user created with super_admin role!');
    }
}