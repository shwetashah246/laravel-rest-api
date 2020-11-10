<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPAController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //Load the System build in vue (Single page app running with VueJS)
    public function vueroute()
    {
        return view('vueview');
    }

}
