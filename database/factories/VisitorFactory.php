<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip'         => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'referrer'   => $this->faker->url(),
            'country'    => $this->faker->country(),
            'city'       => $this->faker->city(),
            'status'     => $this->faker->randomElement(['active', 'blocked']),
        ];
    }
}
