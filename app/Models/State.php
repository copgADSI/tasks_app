<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $fillable = ['type'];
    public const STATES = ['sin completar','completado'];


    public function tasks()
    {
        return $this->hasMany(Task::class, 'state_id');
    }
}
