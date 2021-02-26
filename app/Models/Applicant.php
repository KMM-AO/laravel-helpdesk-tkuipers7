<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $casts = [
        'queued' => 'boolean',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
