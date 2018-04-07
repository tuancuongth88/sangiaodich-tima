<?php

namespace App\Http\Controllers;

use App\Models\Services\Services;
use App\Models\Slides\Slide;
use App\Models\TransactionHistory\TransactionHistory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
}
