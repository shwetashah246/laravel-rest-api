<?php

namespace App\Repositories;

use App\Http\Requests\ApiLogin;
use App\Http\Requests\ApiRegister;
use App\Interfaces\AuthInterface;
use App\Traits\ResponseAPI;
use App\Models\ApiUser;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthRepository implements AuthInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function login(ApiLogin $request)
    {
        try {

            $user = ApiUser::where('email', $request->email)->first();
            if (!$user) {
                throw new \Exception("User does not exist", 422);
            }
            if (!Hash::check($request->password, $user->password)) {
                throw new \Exception("Invalid Credentials", 404);
            } 

            $accessToken = $user->createToken('authToken')->accessToken;
            return $this->success("Login success",['user' => $user, 'access_token' => $accessToken],200);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function register(ApiRegister $request)
    {
        DB::beginTransaction();
        try {
            $user = new ApiUser;
            $user->name = $request->name;
            // Remove a whitespace and make to lowercase
            $user->email = preg_replace('/\s+/', '', strtolower($request->email));
            $user->password = bcrypt($request->password);
            
            $user->save();

            $accessToken = $user->createToken('authToken')->accessToken;

            DB::commit();
            return $this->success("User created",[ 'user' => $user, 'access_token' => $accessToken],200);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function logout (Request $request) {
        $request->user()->tokens->each(function ($token, $key) {
            $token->revoke();
        });
        return $this->success("You have been successfully logged out!",null,200);
    }
    
}