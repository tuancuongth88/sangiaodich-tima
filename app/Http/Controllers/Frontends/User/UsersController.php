<?php

namespace App\Http\Controllers\Frontends\User;

use Illuminate\Http\Request;
use App\Http\Repositories\Frontends\Users\UsersRepository;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    // public function __construct(UsersRepository $repository) {
    //     $this->repository = $repository;
    // }


    /**
     * Get register form
     */
    public function getRegisterForm(){
    	return view('frontend.users.register');
    }

    /**
     * Process request from register form
     */
    public function postRegisterForm(){
    	
    }
}
