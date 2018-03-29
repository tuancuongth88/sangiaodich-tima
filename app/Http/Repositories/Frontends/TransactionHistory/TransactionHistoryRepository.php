<?php namespace App\Http\Repositories\Frontends\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services;
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
    private $auth;
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
        if ($this->request->has('query')) {
            $newsModel = $newsModel
                ->search($this->request->input('query'));
        }
        $listData = $newsModel->paginate($this->perpages);
        return view(
            'frontend.tranhistory.index',
            [
                'data' => $listData,
                'services' => $this->services,
                'list_status' => $status_tranhistory,
            ]
        );
    }
}
