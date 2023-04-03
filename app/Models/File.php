<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';

    protected $fillable = [
        'filename',
        'path',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shared()
    {
        return $this->hasMany(Shared::class, 'file_id');
    }
}
