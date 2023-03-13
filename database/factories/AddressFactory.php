<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'customer_id'   => $this->faker->numberBetween($min = 1, $max = 10),
            'address'       => $this->faker->address,
            'district'      => $this->faker->state,
            'city'          => $this->faker->city,
            'province'      => $this->faker->state,
            'postal_code'   => $this->faker->numberBetween($min = 1000, $max = 9999),
        ];
    }
}
