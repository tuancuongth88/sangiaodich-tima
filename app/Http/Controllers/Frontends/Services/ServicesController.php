<?php

namespace App\Http\Controllers\Frontends\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function registerForm($service){
    	return view('frontend.service.register');
    }

    public function postRegisterForm(){

    }
}
