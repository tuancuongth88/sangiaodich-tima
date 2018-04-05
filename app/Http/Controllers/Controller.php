<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(){
    	/*
    	|-------------------------------------------------------------------
		| * Middleware redirect after submit form
		|-------------------------------------------------------------------
    	| neu co request->get('destination') thi redirect ve dia chi nay
        | @author tantan
        */
        $this->middleware('redirect');
	}
}
