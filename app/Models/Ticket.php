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

    public function processing_users()
    {
        return $this->belongsToMany(User::class,'ticket_employee_user','ticket_id','employee_user_id');
    }

    public function creating_user()
    {
        return $this->belongsTo(User::class,'customer_user_id');
    }

    public function status()
    {
        if ($this->trashed()) return 'Closed';
        if ($this->processing_users->isEmpty()) return 'Waiting';
        return 'Processed';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
