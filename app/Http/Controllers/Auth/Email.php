<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;

class Email extends Controller
{
    public function Validate(string $email)
    {
        $user = User::where('email', $email)->first();
        return response()->json([
            'message' => is_null($user) ? 'Email no encontrado' : 'Email encontrado en los registros',
            'class_list' => is_null($user) ? 'alert-danger' : 'alert-success'
        ],  is_null($user) ? 404 : 200);
    }
}
