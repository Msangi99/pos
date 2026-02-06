<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@restapos.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'tenant_id' => 'DEMO-001',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Cashier User
        User::create([
            'name' => 'John Cashier',
            'email' => 'cashier@restapos.com',
            'email_verified_at' => now(),
            'role' => 'cashier',
            'tenant_id' => 'DEMO-001',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
