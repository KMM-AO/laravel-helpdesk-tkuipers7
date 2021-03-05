<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'seeded',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'seeded' => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function created_tickets()
    {
        return $this->hasMany(Ticket::class,'customer_user_id');
    }

    public function processed_tickets()
    {
        return $this->belongsToMany(Ticket::class,'ticket_employee_user','employee_user_id');
    }

    public function color($colors = ['gray', 'indigo', 'green', 'red', 'yellow',  'blue',  'purple', 'pink'])
    {
        return $colors[strlen($this->name) % count($colors)];
    }

    public function initials()
    {
        $regexs =
            [
                '/[A-Z]/',
                '/[a-z]/',
                '/.+/'
            ];
        $count = 0;
        do
        {
            preg_match_all($regexs[$count], $this->name, $matches);
            $count++;
        }
        while(empty($matches[0]));

        return $matches[0][0] . (isset($matches[0][1]) ? $matches[0][1] : '');
    }

    public function applicant()
    {
        return $this->hasOne(Applicant::class);
    }
}
