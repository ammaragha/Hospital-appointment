<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTrait;

    /**
     * Login into system
     * @param \App\Http\Requests\Auth\LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = $this->authAttemp($credentials);
        if ($token) {
            $data = ['token' => $token, 'user' => new UserResource(Auth::user())];
            return $this->succWithData($data, 'Logged in ');
        } else {
            return $this->errMsg('email or password are incorrect');
        }
    }


    /**
     * Login into system
     * @param \App\Http\Requests\Auth\LoginRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $user = new User();
        try {
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->name = $request->name;

            $user->save();
            $token = $this->authAttemp($request->only('email', 'password'));
            return $this->succWithData(['token' => $token, 'user' => new UserResource(Auth::user())]);
        } catch (\Exception $th) {
            return $this->errMsg($th->getMessage());
        }
    }


    private function generateToken()
    {
        return Auth::user()->createToken('api')->plainTextToken;
    }


    private function authAttemp($credentials)
    {
        if (Auth::attempt($credentials))
            return $this->generateToken();
        else
            return false;
    }
}
