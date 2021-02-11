<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'name' => 'Tristan',
            'email' => 'baas@helpdesk.nl',
            'role_id' => Role::BOSS,
            'email_verified_at' => now(),
            'password' => Hash::make('noorderpoort')
        ]);
    }
}
