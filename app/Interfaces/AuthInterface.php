<?php

namespace App\Interfaces;

use App\Http\Requests\ApiLogin;
use App\Http\Requests\ApiRegister;
use Illuminate\Http\Request;

interface AuthInterface
{

    /**
     * Create api token
     * 
     * @param   \App\Http\Requests\ApiLogin    $request
     * 
     * @method  POST    api/login    create token  
     * @access  public
     */
    public function login(ApiLogin $request);

    /**
     * Create api_user
     * 
     * @param   \App\Http\Requests\ApiRegister    $request
     * 
     * @method  POST    api/register       For Create  
     * @access  public
     */
    public function register(ApiRegister $request);

    /**
     * Delete token, revoke accesss
     * 
     * @param   Illuminate\Http\Request    $request
     * 
     * @method  POST    api/logout       Delete access
     * @access  public
     */
    public function logout(Request $request);

}