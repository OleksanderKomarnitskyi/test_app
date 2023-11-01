<?php

namespace Database\Seeders;

use App\Enums\Statuses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    public function run(): void
    {

        $users = User::select('id')->get();
        $statuses[] = Statuses::Active->value;
        $statuses[] = Statuses::Draft->value;

        foreach ($users as $user)
        {
            $user->posts()->createMany([

                [
                    'title' => fake()->realText(10),
                    'description' => fake()->realText(100),
                    'status' => $statuses[array_rand($statuses)],
                    'publish_date' => Carbon::today()->subMonths(rand(0, 6))->format('Y-m-d  H:i:s'),
                ],
                [
                    'title' => fake()->realText(10),
                    'description' => fake()->realText(100),
                    'status' => $statuses[array_rand($statuses)],
                    'publish_date' => Carbon::today()->subMonths(rand(0, 6))->format('Y-m-d  H:i:s'),
                ],
                [
                    'title' => fake()->realText(10),
                    'description' => fake()->realText(100),
                    'status' => $statuses[array_rand($statuses)],
                    'publish_date' => Carbon::today()->subMonths(rand(0, 6))->format('Y-m-d  H:i:s'),
                ],
                [
                    'title' => fake()->realText(10),
                    'description' => fake()->realText(100),
                    'status' => $statuses[array_rand($statuses)],
                    'publish_date' => Carbon::today()->subMonths(rand(0, 6))->format('Y-m-d  H:i:s'),
                ],
                [
                    'title' => fake()->realText(10),
                    'description' => fake()->realText(100),
                    'status' => $statuses[array_rand($statuses)],
                    'publish_date' => Carbon::today()->subMonths(rand(0, 6))->format('Y-m-d  H:i:s'),
                ]
            ]);
        }


    }
}
