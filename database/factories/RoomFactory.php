<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_name' => $this->faker->text(8),
            'room_number' => $this->faker->numberBetween(100, 999),
            'room_type' => $this->faker->randomElement(['Standard', 'Deluxe', 'Luxury', 'Suite']),
            'short_description' => $this->faker->text(100),
            'description' => $this->faker->paragraph(4, true),
            'slug' => $this->faker->slug(),
            'beds' => $this->faker->numberBetween(1, 5),
            'occupancy' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(10000, 99999),
            'status' => 'Available',
        ];
    }
}
