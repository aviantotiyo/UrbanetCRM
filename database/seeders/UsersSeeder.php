<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;          // <-- penting
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            'id' => (string) Str::uuid(),
            'name' => 'System Admin',
            'password' => Hash::make('12345678'),
            'role' => 'Admin',
            'email_verified_at' => now(),
        ];

        // jika email sudah ada → di-update (password ikut diperbarui)
        User::updateOrCreate(
            ['email' => 'admin@urbanet.test'],
            $values
        );
    }
}
