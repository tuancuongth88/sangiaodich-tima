<?php namespace App\Http\Repositories\Administrators\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
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

    private $services;


    function __construct(
        TransactionHistory $transactionHistory,
        ResponseService $response,
        Service $services,
        Request $request,
        AuthService $auth,
        $perpages = 20,
        $current = 1
    )
    {
        $this->model = $transactionHistory;
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->perpages = $perpages;
        $this->current = $current;
        $this->services = $services;
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
        $list_services = Service::all();
        $input = $this->request->all();
        if (isset($input['fee_type']) && $input['fee_type'] == '0') {
            unset($input['fee_type']);
        }
        if (isset($input['service_code']) && ($input['service_code'] == '0' || !$input['service_code'])) {
            unset($input['service_code']);
        }
        if (!isset($input['city_id'])) {
            unset($input['city_id']);
        }
        if (!isset($input['district_id'])) {
            unset($input['district_id']);
        }

        $query = $this->model->where('status', TransactionHistory::STATUS_WAIT_APPROVE)->where($input)->orderBy('id', 'desc');
        $listData = $query->paginate($this->perpages);
        return view('administrator.transactionhistory.index',
            ['data' => $listData, 'list_service' => $list_services, 'input' => $input]
        );
    }

    public function approve($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return redirect()->route('admin.transaction.list')->with('status', false)->with('message', 'Hợp đồng này không tồn tại!');
        }
        $data->update(['status' => TransactionHistory::STATUS_WAIT]);
        return redirect()->route('admin.transaction.list')->with('status', true)->with('message', 'Giao dịch đã được xác nhận!');
    }

    public function reject($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return redirect()->route('admin.transaction.list')->with('status', false)->with('message', 'Hợp đồng này không tồn tại!');
        }
        $data->update(['status' => TransactionHistory::STATUS_CANCEL]);
        return redirect()->route('admin.transaction.list')->with('status', true)->with('message', 'Giao dịch đã được hủy!');
    }

    public function search()
    {

    }

}
