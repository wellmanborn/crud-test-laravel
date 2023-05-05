<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
            'phone_number' => "+98912" . fake()->regexify('[0-9]{7}'),
            'date_of_birth' => fake()->date("Y-m-d"),
            'bank_account_number' => fake()->regexify('[0-9]{12}'),
        ];
    }
}
