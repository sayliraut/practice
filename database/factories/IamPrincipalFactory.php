<?php

namespace Database\Factories;

use App\Models\IamPrincipal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IamPrincipalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = IamPrincipal::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'principal_type_xid' => 1,
            'password' => bcrypt('password'), // You can change the default password if needed
            'email_address' => $this->faker->unique()->safeEmail,
            'gender' => 'male',
            'date_of_birth' => $this->faker->date,
            'phone_number' => 4564894546,
            'is_active' => 1,
        ];
    }
}
