<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shared extends Model
{
    use HasFactory;

    protected $table = 'shared';
    protected $appends = [
        'shared_by_me'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getSharedByMeAttribute(): string
    {
        return auth()->user()->id === $this->user_id ? 'Si' : 'No';
    }
}
