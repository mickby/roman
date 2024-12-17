<?php

namespace Database\Factories;

use App\Models\Conversion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
{

    protected $model = Conversion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'integer_value' => $this->faker->numberBetween(1, 3999), // Random integer between 1 and 3999
            'roman_value' => $this->faker->randomElement(['I', 'II', 'III', 'IV', 'V', 'X', 'L', 'C', 'D', 'M']),
        ];
    }
}
