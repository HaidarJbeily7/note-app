<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;


use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends BaseController
{
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $auth = Auth::user();
            $customer = $auth->customer;
            $auth->token = $auth->createToken('view-token')->plainTextToken;
            $success = new UserResource($auth);
            return $this->handleResponse($success, 'User logged-in!');
        }

        return $this->handleError('Unauthorized.', ['email'=>'email or password is incorrect'], 401);


    }

    public function register(RegisterRequest $request)
    {
        $input = $request->validated();
        $input['password'] = bcrypt($input['password']);
        $input['name'] = $input['username'];
        $input['email'] = $input['email'];
        $user = User::create($input);
        $input['user_id'] = $user->id;
        $user->token = $user->createToken('note-token')->plainTextToken;
        $success = new UserResource($user);
        return $this->handleResponse($success, 'User Created Successfully!', 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->handleResponse([], 'Logout completed!');
    }

    public function getUser(Request $request)
    {
        $user = Auth::user();
        return $this->handleResponse(new UserResource($user), 'Profile Data Fetched');
    }

}
