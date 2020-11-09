<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    
    protected $userInteface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userInterface->getAllUsers();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        return $this->userInterface->createUser($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->userInterface->getUserById($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->userInterface->deleteUser($id);
    }

    /**
     * increment score of a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function plusScore($id)
    {
        return $this->userInterface->plusScore($id);
    }

    /**
     * decrement score of a user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function minusScore($id)
    {
        return $this->userInterface->minusScore($id);
    }

}
