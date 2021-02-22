<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->join('applicants', 'users.id', '=','applicants.user_id')
            ->where('users.seeded','=','1')
            ->delete();

        Applicant::factory()->count(10)->create();
    }
}
