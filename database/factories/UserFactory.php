<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;
    protected $order = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => 'customer'. $this->order++ . '@helpdesk.nl',
            'email_verified_at' => now(),
            'role_id' => Role::CUSTOMER,
            'password' => Hash::make('helpdesk'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
