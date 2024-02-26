<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                
                $token = $user->createToken('JWT')->plainTextToken;
    
                $responseData = [
                    'token' => $token,
                    'user' => [
                        'name' => $user->name,
                        'id' => $user->id,
                        'email' => $user->email,
                    ]
                ];
    
                return response()->json($responseData, 200);
            }
    
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            // Log do erro ou outra ação apropriada
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }
}
