<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(AuthService $auth)
    {
        $this->service = $auth;
        
    }
    public function login(LoginRequest $request)
    {
        
        // try
        // {
          
            return $this->service->login($request->all());
        // }
        // catch(\Exception $exception)
        // {
        //     return 'exception found in this code';
        // }

    }
}
