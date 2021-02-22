<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->where('seeded','=','1')
            ->where('role_id', '=',Role::CUSTOMER)
            ->delete();

        User::factory()
            ->count(10)
            ->create();
    }
}
