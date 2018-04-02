<?php namespace App\Http\Repositories\Frontends\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Services;
use App\Models\TransactionHistory\TransactionHistory;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class TransactionHistoryRepository extends Repository
{

    private $model;
    private $services;
    private $user;
    private $response;
    private $request;
    protected $auth;
    private $perpages;
    private $current;


    function __construct(
        TransactionHistory $transactionHistory,
        Services $services,
        ResponseService $response,
        Request $request,
        AuthService $auth,
        User $user,
        $perpages = 2,
        $current = 1
    )
    {
        $this->model = $transactionHistory;
        $this->services = $services;
        $this->user = $user;
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->perpages = $perpages;
        $this->current = $current;
    }

    public function getLatest()
    {
        return $this->model->approve()->orderBy(self::ID, 'desc')->take(5)->get();
    }

    public function index()
    {
        $status_tranhistory = $this->model->status_transactionhistory;
        $newsModel = $this->model->orderBy(self::ID, 'DESC');
        $listData = $newsModel->paginate($this->perpages);
        $count_all_tran = $newsModel->count();
        //status
        $count_tran_cancel = $this->model::where('status', '=', 5)->get()->count();
        $count_tran_wait = $this->model::where('status', '=', 1)->get()->count();
        $list_services = $this->services->get()->toArray();

        $page = $this->request->input('page');
        if ($page) {
            $html = view('frontend.transactionhistory.search', ['data' => $listData, 'list_status' => $status_tranhistory])->render();
            return response()->json(array('success' => true, 'html' => $html, 'pagination' => $listData->links()->toHtml()));
        }

        return view(
            'frontend.transactionhistory.index',
            [
                'data' => $listData,
                'services' => $list_services,
                'list_status' => $status_tranhistory,
                'count_all_tran' => $count_all_tran,
                'count_tran_cancel' => $count_tran_cancel,
                'count_tran_wait' => $count_tran_wait,
            ]
        );
    }

    public function getTranByProduct()
    {

        $product = $this->request->input('product');
        $status = $this->request->input('status');
        $status_tranhistory = $this->model->status_transactionhistory;

        $where_cloud = array();
        if ((int)$product > 0) {
            $where_cloud[] = ['service_id', '=', $product];
        }
        if ((int)$status > 0) {
            $where_cloud[] = ['status', '=', $status];
        }


        if (!empty($where_cloud)) {
            $data = $this->model::where($where_cloud)->paginate($this->perpages);
        } else {
            $data = $this->model->paginate($this->perpages);
        }
        $html = view('frontend.transactionhistory.search', ['data' => $data, 'list_status' => $status_tranhistory])->render();
        return response()->json(array('success' => true, 'html' => $html, 'pagination' => $data->links()->toHtml()));

    }

    public function searchTranByPhoneAndIdCard()
    {
        $s_mobile = trim($this->request->input('phone'));
        $cardnumber = trim($this->request->input('cardnumber'));
        $status_tranhistory = $this->model->status_transactionhistory;

        $where_cloud = array();
        if ($s_mobile != '') {
            $where_cloud[] = ['customer_mobile', '=', $s_mobile];
        }
        if ($cardnumber != '') {
            $where_cloud[] = ['user_id', '=', $cardnumber];
        }


        if (!empty($where_cloud)) {
            $data = $this->model::where($where_cloud)->paginate(1);
        } else {
            return view('frontend.transactionhistory.s_index');
        }

        if ($data->count() > 0) {
            $html = view(
                'frontend.transactionhistory.s_search',
                ['data' => $data, 'list_status' => $status_tranhistory]
            )->render();
        } else {
            return '';
        }

        return response()->json(array('success' => true, 'html' => $html, 'pagination' => $data->links()->toHtml()));
    }

    public function manageTran()
    {
        $status_tranhistory = $this->model->status_transactionhistory;
        $newsModel = $this->model->orderBy(self::ID, 'DESC');
        $listData = $newsModel->paginate($this->perpages);

        //status
        $count_tran_wait_consultant = $this->model::where('status', '=', 1)->get()->count();
        $count_tran_wait_receive = $this->model::where('status', '=', 2)->get()->count();
        $count_tran_is_borrowing = $this->model::where('status', '=', 3)->get()->count();
        $sum_amount_tran_is_borrowing = $this->model::where('status', '=', 3)->sum('amount');
        $list_services = $this->services->get()->toArray();

        $page = $this->request->input('page');
        if ($page) {
            $html = view('frontend.transactionhistory.m_search', ['data' => $listData, 'list_status' => $status_tranhistory])->render();
            return response()->json(array('success' => true, 'html' => $html, 'pagination' => $listData->links()->toHtml()));
        }

        return view(
            'frontend.transactionhistory.manage',
            [
                'data' => $listData,
                'services' => $list_services,
                'list_status' => $status_tranhistory,
                'count_tran_wait_consultant' => $count_tran_wait_consultant,
                'count_tran_wait_receive' => $count_tran_wait_receive,
                'count_tran_is_borrowing' => $count_tran_is_borrowing,
                'sum_amount_tran_is_borrowing' => $sum_amount_tran_is_borrowing
            ]
        );
    }

    public function getManageBysServiceAndStatus()
    {

        $product = $this->request->input('product');
        $status = $this->request->input('status');
        $status_tranhistory = $this->model->status_transactionhistory;

        $where_cloud = array();
        if ((int)$product > 0) {
            $where_cloud[] = ['service_id', '=', $product];
        }
        if ((int)$status > 0) {
            $where_cloud[] = ['status', '=', $status];
        }


        if (!empty($where_cloud)) {
            $data = $this->model::where($where_cloud)->paginate($this->perpages);
        } else {
            $data = $this->model->paginate($this->perpages);
        }
        $html = view('frontend.transactionhistory.m_search', ['data' => $data, 'list_status' => $status_tranhistory])->render();
        return response()->json(array('success' => true, 'html' => $html, 'pagination' => $data->links()->toHtml()));

    }
}
