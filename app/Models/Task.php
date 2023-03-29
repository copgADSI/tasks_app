<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'description',
        'user_id',
        'state_id'
    ];

    //relationships

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
