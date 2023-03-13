<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'title'         => $this->faker->title,
            'name'          => $this->faker->name,
            'gender'        => $this->faker->randomElement(['M', 'F']),
            'phone_number'  => $this->faker->phoneNumber,
            'image'         => $this->faker->imageUrl(),
            'email'         => $this->faker->unique()->safeEmail,
        ];
    }
}
