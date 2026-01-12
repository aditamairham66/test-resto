<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'superadmin',
            'name' => 'Super Admin',
            'phone' => '081234567890',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'group' => 1, // Superadmin
            'remember_token' => Str::random(10),
            'status' => 10,
            'is_send_whatsapp' => 1,
            'is_send_email' => 1,
            'created_by' => 'system',
        ]);
    }
}
