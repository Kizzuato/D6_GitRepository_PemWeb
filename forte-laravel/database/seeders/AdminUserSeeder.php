<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // User::firstOrCreate(
        //     ['username' => 'Admin'],
        //     [
        //         'name' => 'Administrator Forte',
        //         'email' => 'adminbaik@forte.com',
        //         'password' => Hash::make('0'),
        //         'role' => 'admin',
        //     ]
        // );
        // \App\Models\User::create([
        //     'name' => 'Admin Demo',
        //     'username' => 'admin1',
        //     'email' => 'admin@demo.com',
        //     'password' => bcrypt('password123'),
        //     'role_id' => \App\Models\Role::where('name', 'admin')->first()->id,
        // ]);
        // 2. Buat Akun Superadmin Default
        $user = User::create([
            'username' => 'Super Admin Forte',
            'email' => 'superadmin@forte.com',
            'password' => bcrypt('password123'), // Ganti sesuai mau lo
        ]);

        // 3. Tempelkan Role ke User
        $user->assignRole('superadmin');
    }
}
