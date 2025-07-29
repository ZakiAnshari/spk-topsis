<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Role: Admin dan Pemilik
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Pemilik'] // Ganti dari "Pimpinan BPJS"
        ];

        foreach ($roles as $role) {
            Roles::create($role);
        }

        // Buat User Admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'contact' => '082202020202',
            'role_id' => 1,
            'email' => 'admin@example.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti dengan password aman
            'remember_token' => Str::random(10),
        ]);

        // Buat User Pemilik
        User::create([
            'name' => 'Pemilik',
            'username' => 'pemilik',
            'contact' => '082204040404',
            'role_id' => 2,
            'email' => 'pemilik@example.com',
            'jenis_kelamin' => 'Laki-Laki',
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // Ganti dengan password aman
            'remember_token' => Str::random(10),
        ]);
    }
}
