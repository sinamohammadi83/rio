<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required','min:3','max:20'],
            'password' => ['required','min:3','max:20']
        ]);

        $user = User::query()
            ->where(['username' => $request->get('username'),'password' => hash('sha256',$request->get('password'))])
            ->first();

        if ($user){
            $user->tokens()->delete();

            $token = $user->createToken('user')->plainTextToken;

            return response()->json([
                'message' => 'login successfull!',
                'token' => $token
            ])->setStatusCode(200);
        }else{

            return response()->json([
                'message' => 'user not found',
            ])->setStatusCode(404);
        }
    }

    public function destroy()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logout successfull!',
        ])->setStatusCode(200);
    }
}
