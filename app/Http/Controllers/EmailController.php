<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * @param string $email
     */
    public function validateEmail(string $email)
    {
        $user = User::where('email', $email)->first();
        return response()->json([
            'found' => !is_null($user),
            'message' => is_null($user) ? 'Email no encontrado' : 'Email encontrado en los registros',
            'class_list' => is_null($user) ? 'alert-danger' : 'alert-success'
        ]);
    }
}
