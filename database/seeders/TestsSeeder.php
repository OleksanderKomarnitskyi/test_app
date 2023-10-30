<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class TestsSeeder extends Seeder
{

    public function run(): void
    {
        $managers = User::where('role', Roles::Manager->value)->get();

        foreach ($managers as $manager) {
            $manager->tests()->createMany(
            [    [
                    'user_name' => fake()->firstName() . " " . fake()->lastName(),
                    'data_test' => Carbon::now()->subYears(rand(1, 20))->format('Y-m-d H:i:s'),
                    'address' => fake()->address,
                    'assessment' => rand(1, 100),
                    'criterion' => rand(1, 100),
                ],
                [
                    'user_name' => fake()->firstName()  . " " .  fake()->lastName(),
                    'data_test' => Carbon::now()->subYears(rand(1, 20))->format('Y-m-d H:i:s'),
                    'address' => fake()->address,
                    'assessment' => rand(1, 100),
                    'criterion' => rand(1, 100),
                ],
            ]);
        }
    }
}
