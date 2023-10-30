<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{

    public function run(): void
    {
         User::factory()->create([
             'role' => Roles::Admin->value,
             'first_name' => "Admin",
             'email' => 'admin@gmail.com',
             'email_verified_at' => now(),
             'password' => Hash::make("abracadabra"),
             'remember_token' => Str::random(10),
         ]);

    }
}
