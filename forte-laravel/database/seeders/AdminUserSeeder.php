<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        Users::firstOrCreate(
            ['username' => 'Admin'],
            [
                'name' => 'Administrator Forte',
                'email' => 'adminbaik@forte.com',
                'password' => Hash::make('0'),
                'role' => 'admin',
            ]
        );
    }
}
