<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'baas'
        ]);

        Role::create([
            'id' => Role::EMPLOYEE,
            'name' => 'medewerker'
        ]);

        Role::create([
            'id' => Role::APPLICANT,
            'name' => 'sollicitant'
        ]);

        Role::create([
            'id' => Role::CUSTOMER,
            'name' => 'klant'
        ]);
    }
}
