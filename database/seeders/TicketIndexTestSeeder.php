<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Ticket;

class TicketIndexTestSeeder extends Seeder {
    public function run() {
        foreach(['x' => 'M', 'y' => 'M', 'a' => 'K', 'b' => 'K'] as $user => $role) {
            $users[$user] = User::create([
                'name'              => $role . $user,
                'email'             => $role . $user . '@helpdesk.nl',
                'password'          => Hash::make('helpdesk'),
                'role_id'           => $role == 'M' ? Role::EMPLOYEE : Role::CUSTOMER,
                'seeded' => true
            ]);
            if ($role == 'K') {
                foreach ([[], ['x'], ['y'], ['x', 'y']] as $employees) {
                    foreach (['', 'c'] as $closed) {
                        $ticket = Ticket::create([
                            'subject'           => 'T' . $user . join('', $employees) . $closed,
                            'contents'          => 'test',
                            'category_id'       => 1,
                            'customer_user_id'  => $users[$user]->id,
                            'created_at'        => now()->subDays(random_int(1,100)),
                            'deleted_at'        => $closed ? now() : null
                        ]);
                        foreach ($employees as $employee) {
                            DB::table('ticket_employee_user')->insert([
                                'ticket_id'         => $ticket->id,
                                'employee_user_id'  => $users[$employee]->id
                            ]);
                        }
                    }
                }
            }
        }
    }
}

