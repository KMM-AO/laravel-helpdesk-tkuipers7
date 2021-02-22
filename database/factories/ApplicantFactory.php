<?php

namespace Database\Factories;

use App\Models\Applicant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;
    private $order = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->state([
                'role_id' => Role::APPLICANT,
                'email' => 'applicant'. $this->order++ . '@helpdesk.nl',
                ]),
            'queued' => 0
        ];
    }
}
