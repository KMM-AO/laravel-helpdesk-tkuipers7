<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    const BOSS = 11,
        EMPLOYEE = 21,
        APPLICANT = 31,
        CUSTOMER = 41;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
