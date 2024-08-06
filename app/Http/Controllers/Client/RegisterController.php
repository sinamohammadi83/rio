<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Uploader;
use App\Http\Requests\Client\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {

        $checkUserExists = User::query()->where('username',$request->get('username'))->exists();

        if ($checkUserExists)
        {
            return response()->json([
                'code' => 2
            ])->setStatusCode(400);
        }

        if($request->hasFile('avatar'))
            $avatar = $this->upload($request,'avatars','avatar');
        else
            $avatar = URL::to('/').'/'.'public/avatar.png';
        $user = User::query()->create([
            'username' => $request->get('username'),
            'password' => hash('sha256',$request->get('password')),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'role' => '1',
            'avatar' => $avatar,
        ]);

        if ($user)
        {
            $token = $user->createToken('user')->plainTextToken;

            return response()->json([
                'code' => 0,
                'token' => $token
            ])->setStatusCode(200);
        }else{
            return response()->json([
                'code' => 1,
            ])->setStatusCode(200);
        }
    }
}
