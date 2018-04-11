<?php
namespace App\Http\Repositories\Frontends\Homes;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
use App\Models\Slides\Slide;
use App\Models\TransactionHistory\TransactionHistory;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class HomesRepository extends Repository
{
    protected $response;
    protected $request;
    protected $auth;
    protected $perpage;
    protected $curent;

    public function __construct(ResponseService $response, Request $request, AuthService $auth, $perpages = 200, $current = 1) {
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->perpage = $perpages;
        $this->curent = $current;
    }

    public function index(){
        $data = Slide::all();
        $totalMoney = TransactionHistory::where('status', TransactionHistory::STATUS_APPROVE)->sum('amount');
        $listService = Service::all();
//        $total
        $listTransactionNews = TransactionHistory::where('status', TransactionHistory::STATUS_WAIT)->orderBy('id', 'desc')->paginate($this->perpage);
        $total_reg_borrow = User::where('type', VAY)->count();
        $total_reg_loan = User::where('type', CHO_VAY)->count();

        $total_bill_day = TransactionHistory::where('status', TransactionHistory::STATUS_WAIT)
                                            ->where('created_at', DB::raw('CURDATE()'))
                                            ->count();
        $total_bill_system = TransactionHistory::count();
        return view('home', ['data' => $data,
                'totalmoney' => $totalMoney,
                'list_service' => $listService,
                'list_transaction' => $listTransactionNews,
                'total_reg_borrow' => $total_reg_borrow,
                'total_reg_loan' => $total_reg_loan,
                'total_bill_on_day' => $total_bill_day,
                'total_bill_system' => $total_bill_system]
        );
    }

}