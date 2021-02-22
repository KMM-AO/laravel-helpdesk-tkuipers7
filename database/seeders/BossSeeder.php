<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BossSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('role_id','=',Role::BOSS)->where('seeded','=',1)->delete();
        User::factory()
            ->state([
                'name' => 'Tristan',
                'email' => 'baas@helpdesk.nl',
                'role_id' => Role::BOSS,
            ])
            ->create();
    }
}
