<?php

namespace App\Interfaces;

use App\Http\Requests\CreateUser;

interface UserInterface
{
    /**
     * Get all users
     * 
     * @method  GET api/users
     * @access  public
     */
    public function getAllUsers();

    /**
     * Get User By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/users/{id}
     * @access  public
     */
    public function getUserById($id);

    /**
     * Create user
     * 
     * @param   \App\Http\Requests\CreateUser    $request
     * 
     * @method  POST    api/users       For Create  
     * @access  public
     */
    public function createUser(CreateUser $request);

    /**
     * Update user score
     * 
     * @param   integer                           user $id
     * 
     * @method  POST    api/add-score/{id}       For Update user score    
     * @access  public
     */
    public function plusScore($id);

    /**
     * Update user score
     * 
     * @param   integer                           user $id
     * 
     * @method  POST    api/delete-score/{id}       For Update user score    
     * @access  public
     */
    public function minusScore($id);

    /**
     * Delete user
     * 
     * @param   integer     $id
     * 
     * @method  Delete  api/users/{id}
     * @access  public
     */
    public function deleteUser($id);

}