<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Uploader;
use App\Http\Requests\Client\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {

        $avatar = $this->upload($request,'avatars','avatar');

        $user = User::query()->create([
            'username' => $request->get('username'),
            'password' => hash('sha256',$request->get('password')),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'role' => 'customer',
            'avatar' => $avatar,
        ]);

        $token = $user->createToken('user')->plainTextToken;

        return response()->json([
            'message' => 'register successfull!',
            'token' => $token
        ])->setStatusCode(200);
    }
}
