<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->all())) {
            return response()->json(['message' => 'Not Authorized'], 403);
        }

        return response()->json(['message' => 'Authorized', "token" => $request->user()->createToken('token')], 200);
    }
}
