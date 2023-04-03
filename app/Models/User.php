<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'full_name'
    ];


    public static function getUsersPerMonth()
    {
        return DB::table('users')
            ->select(DB::raw("DATE_FORMAT(created_at, '%M') AS month"), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->map(function ($count) {
                return (int) $count;
            })
            ->toArray();
    }


    public static function getUsersByDateRange(string $start_date, string $end_date)
    {
        return DB::table('users')->whereBetween('created_at', [
            $start_date . ' 00:00:00',
            $end_date . ' 23:59:59'
        ])->get();
    }


    public function getFullNameAttribute(): string
    {
        return $this->name . '._';;
    }


    /* RELACIONES */

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'user_id');
    }

    public function shared()
    {
        return $this->hasMany(shared::class, 'user_id');
    }
}
