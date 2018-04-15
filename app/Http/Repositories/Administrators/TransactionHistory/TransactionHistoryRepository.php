<?php namespace App\Http\Repositories\Administrators\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\TransactionHistory\TransactionHistory;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class TransactionHistoryRepository extends Repository
{

    private $model;

    private $request;

    private $response;

    protected $auth;

    private $perpages;

    private $current;


    function __construct(TransactionHistory $transactionHistory, ResponseService $response, Request $request, AuthService $auth, $perpages = 20, $current = 1)
    {
        $this->model = $transactionHistory;
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->perpages = $perpages;
        $this->current = $current;
    }

    /*
    |--------------------------------------------------------------------------
    | ALL NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return object news
    | @Author : cuongnt
     */

    public function index()
    {
        $query = $this->model->where('status', TransactionHistory::STATUS_WAIT_APPROVE)->orderBy('id', 'desc');
        $listData = $query->paginate($this->perpages);
        return view('administrator.transactionhistory.index', ['data' => $listData]);
    }

    public function approve($id){
        $data = $this->model->find($id);
        if(!$data){
            return redirect()->route('admin.transaction.list')->with('status', false)->with('message', 'Hợp đồng này không tồn tại!');
        }
        $data->update(['status' => TransactionHistory::STATUS_WAIT]);
        return redirect()->route('admin.transaction.list')->with('status', true)->with('message', 'Giao dịch đã được xác nhận!');
    }

    public function reject($id){
        $data = $this->model->find($id);
        if(!$data){
            return redirect()->route('admin.transaction.list')->with('status', false)->with('message', 'Hợp đồng này không tồn tại!');
        }
        $data->update(['status' => TransactionHistory::STATUS_CANCEL]);
        return redirect()->route('admin.transaction.list')->with('status', true)->with('message', 'Giao dịch đã được hủy!');
    }

    public function search(){

    }

}
