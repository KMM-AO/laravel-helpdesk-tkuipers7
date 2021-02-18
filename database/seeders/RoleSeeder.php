<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => Role::BOSS,
            'name' => 'Boss'
        ]);

        Role::create([
            'id' => Role::EMPLOYEE,
            'name' => 'Employee'
        ]);

        Role::create([
            'id' => Role::APPLICANT,
            'name' => 'Applicant'
        ]);

        Role::create([
            'id' => Role::CUSTOMER,
            'name' => 'Costumer'
        ]);
    }
}
