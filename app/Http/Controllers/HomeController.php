<?php

namespace App\Http\Controllers;

use App\Models\Services\Service;
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
        $data = Slide::all();
        $totalMoney = TransactionHistory::where('status', TransactionHistory::STATUS_APPROVE)->sum('amount');
        $listService = Service::all();
//        $total
        $listTransactionNews = TransactionHistory::orderBy('id', 'desc')->paginate(50);
        return view('home', ['data' => $data,
                                        'totalmoney' => $totalMoney,
                                        'list_service' => $listService,
                                        'list_transaction' => $listTransactionNews]);
    }
}
