<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $password = "abracadabra";

         $data = [
             [
                 'first_name' => "User1",
                 'last_name' => fake()->lastName(),
                 'email' => 'user1@gmail.com',
                 'email_verified_at' => now(),
                 'password' => Hash::make($password),
                 'remember_token' => Str::random(10),
             ],
             [
                 'first_name' => "User2",
                 'last_name' => fake()->lastName(),
                 'email' => 'user2@gmail.com',
                 'email_verified_at' => now(),
                 'password' => Hash::make($password),
                 'remember_token' => Str::random(10),
             ],
             [
                 'first_name' => "User3",
                 'last_name' => fake()->lastName(),
                 'email' => 'user3@gmail.com',
                 'email_verified_at' => now(),
                 'password' => Hash::make($password),
                 'remember_token' => Str::random(10),
             ],
             [
                 'first_name' => "User4",
                 'last_name' => fake()->lastName(),
                 'email' => 'user4@gmail.com',
                 'email_verified_at' => now(),
                 'password' => Hash::make($password),
                 'remember_token' => Str::random(10),
             ]
         ];

         foreach ($data as $item) {
             User::create($item);
         }

    }
}
