<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function login($request)
    {
        $email = strtolower($request['email']);
        $password = $request['password'];
        $user = User::whereEmail($email)->first();
        if(!$user)
            return response()->json('User Email not exist',422);
        else
            {
                if(Hash::check($password,$user->password))
                {
                    // if(!env('PASSPORT_SECRET_TOKEN'))
                    //     return response()->json('Please setup your passport secret token inside ENV first', 422);
                    $success['token'] = $user->createToken('MyApp')->accessToken;
                    // $token->save();
                   
                  $success['user'] = $user;
                    return response()->json($success,200);
                }
                else
                {
                    return response()->json('User Password not exist',500);
                }
            }



    }
}