<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'description',
        'user_id',
        'state_id'
    ];

    public static function getTasksByUserId()
    {
        $user_id = auth()->user()->id;
        return DB::table('tasks')->where('user_id', '=',  $user_id)->get();
    }
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
