<?php

namespace Database\Factories;

use App\Models\Subcription;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SubcriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'names' => $this->faker->name(),
            'number' => $this->faker->e164PhoneNumber(),
            'canal_marketing' => $this->faker->numberBetween($min = 1, $max = 4),
            'birth_date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'location' => $this->faker->address(),
            'observation' => $this->faker->text($maxNbChars = 255),
        ];
    }
}
