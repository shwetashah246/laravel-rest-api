<?php

namespace App\Repositories;

use App\Http\Requests\CreateUser;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use DB;

class UserRepository implements UserInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllUsers()
    {
        try {
            $users = User::orderBy('score','desc')->get();
            return $this->success("All Users", ['users'=>$users],200);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getUserById($id)
    {
        try {
            $user = User::find($id);
            
            // Check the user
            if(!$user) throw new \Exception("No user with ID $id", 404);

            return $this->success("User Detail", ['user'=>$user],200);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createUser(CreateUser $request)
    {
        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            // Remove a whitespace and make to lowercase
            $user->email = preg_replace('/\s+/', '', strtolower($request->email));
            $user->age = $request->age;
            $user->address = $request->address;

            $user->save();

            DB::commit();
            return $this->success("User created",['user'=>$user],200);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            // Check the user
            if(!$user) throw new \Exception("No user with ID $id", 404);

            // Delete the user
            $user->delete();

            DB::commit();
            return $this->success("User deleted", ['user'=>$user],200);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function plusScore($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            // Check the user
            if(empty($user->id)) throw new \Exception("No user with ID $id", 404);

            $user->increment('score');
            $user->save();

            DB::commit();
            return $this->success("Score added.", ['user'=>$user],200);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function minusScore($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            // Check the user
            if(!$user) throw new \Exception("No user with ID $id", 404);
            if($user->score<=0) throw new \Exception("User score is zero.", 404);

            $user->decrement('score');

            $user->save();

            DB::commit();
            return $this->success("Score subtract.", ['user'=>$user],200);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

}