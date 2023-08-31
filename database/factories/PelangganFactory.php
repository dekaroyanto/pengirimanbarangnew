<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'namapelanggan'  => $this->faker->name(),
            'notelp' => $this->faker->unique()->numberBetween(882006487100, 882006487199),
            'emailpelanggan' => $this->faker->unique()->safeEmail(),
            'alamatpelanggan' => $this->faker->address(),
        ];
    }
}
