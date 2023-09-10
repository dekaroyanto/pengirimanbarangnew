<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KurirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nik' => $this->faker->unique()->nik(),
            'nama'  => $this->faker->name(),
            'emailkurir' => $this->faker->unique()->safeEmail(),
            'notelpkurir' => $this->faker->unique()->numberBetween(81320321880, 81320321899),
            'kelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'alamatkurir' => $this->faker->address(),
        ];
    }
}
