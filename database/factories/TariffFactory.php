<?php

namespace Database\Factories;

use App\Enums\Statuses;
use App\Models\Tariff;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tariff>
 */
class TariffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        $statuses[] = Statuses::Active->value;
        $statuses[] = Statuses::Blocked->value;

        return [
            'title' => fake()->realText(10),
            'posts_count' => rand(1,100),
            'price' => random_int(2, 99),
            'status' => $statuses[array_rand($statuses)],
        ];
    }
}
