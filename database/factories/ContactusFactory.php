<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\contactuses>
 */
class ContactusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => $this->faker->name(),
            'email'      => $this->faker->unique()->safeEmail(),
            'phone'      => $this->faker->phoneNumber(),
            'subject'    => $this->faker->sentence(4),
            'message'    => $this->faker->paragraph(),
            'agree'      => $this->faker->boolean(),
            'send_email' => $this->faker->boolean(),
            'read_or_not' => $this->faker->boolean(0),
            'ip_address' => $this->faker->ipv4(),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
