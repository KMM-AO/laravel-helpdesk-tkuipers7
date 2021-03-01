<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'subject',
        'contents',
        'category_id',
        'customer_user_id'
    ];
}
