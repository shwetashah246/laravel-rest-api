<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthInterface;
use App\Http\Requests\ApiLogin;
use App\Http\Requests\ApiRegister;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
   	protected $authInteface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(AuthInterface $authInteface)
    {
        $this->authInteface = $authInteface;
    }

    public function register(ApiRegister $request)
    {
        return $this->authInteface->register($request);
    }

    public function login(ApiLogin $request)
    {
    	return $this->authInteface->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authInteface->logout($request);
    }

}
