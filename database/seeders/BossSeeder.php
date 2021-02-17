<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class BossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->state([
                'name' => 'Tristan',
                'email' => 'baas@helpdesk.nl',
                'role_id' => Role::BOSS,
                'seeded' => 1
            ])
            ->create();
    }
}
