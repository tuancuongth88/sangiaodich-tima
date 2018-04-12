<?php namespace App\Http\Repositories\Frontends\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
use App\Models\TransactionHistory\TransactionHistory;
use App\Models\TransactionHistory\TransactionHistoryLog;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class TransactionHistoryRepository extends Repository {

    private $model;
    private $services;
    private $user;
    private $response;
    private $request;
    protected $auth;
    private $perpages;
    private $current;

    const USER_ID     = 'user_id';
    const CITY_ID     = 'city_id';
    const DISTRICT_ID = 'district_id';
    const WARD_ID     = 'ward_id';
    const AMOUNT      = 'amount';
    const AMOUNT_DAY  = 'amount_day';
    const PAYMENT_DAY = 'payment_day';
    const STATUS      = 'status';
    const AGREE_TERM  = 'agree_term';

    const FEE_SEARCH_LOAN_HISTORY_DEFAULT = 2000;
    const FEE_SEARCH_LOAN_HISTORY_SUCCESS = 10000;



    function __construct(
        TransactionHistory $transactionHistory,
        Service $services,
        ResponseService $response,
        Request $request,
        AuthService $auth,
        User $user,
        $perpages = 20,
        $current = 1
    ) {
        $this->model    = $transactionHistory;
        $this->services = $services;
        $this->response = $response;
        $this->request  = $request;
        $this->auth     = $auth;
        $this->user     = $user;
        $this->perpages = $perpages;
        $this->current  = $current;
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT FIELD STORE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and store.
    | @Author : tantan
     */
    protected function getInputFieldStore() {
        return $this->request->only(
            self::CITY_ID,
            self::DISTRICT_ID,
            self::AMOUNT,
            self::AGREE_TERM,
            self::AMOUNT_DAY
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATOR ARRAY FIELD.
    |--------------------------------------------------------------------------
    | @params $array array.
    | @return mix \Validator
    | @Author : tantan
     */
    public function validator(array $array) {
        $messages = [
            'required'                      => 'Vui lòng nhập :attribute',
            self::CITY_ID . '.required'     => 'Vui lòng chọn thành phố',
            self::DISTRICT_ID . '.required' => 'Vui lòng chọn quận/huyện',
            self::AGREE_TERM . '.required'  => 'Bạn phải đồng ký với điều khoản của chúng tôi',
        ];
        return Validator::make($array, [
            self::CITY_ID     => 'required',
            self::DISTRICT_ID => 'required',
            self::AGREE_TERM  => 'required',
        ], $messages);
    }

    public function getLatest() {
        return $this->model->approve()->orderBy(self::ID, 'desc')->take(5)->get();
    }


    /*
        |--------------------------------------------------------------------------
        | Hiển thị lich sử đơn vay
        |--------------------------------------------------------------------------
        |
        | @return object
        | @Author : phuonglv
         */
    public function index()
    {
        $id = $this->auth->user()->id;

        $status_tranhistory = $this->model->status_transactionhistory;
        $newsModel = $this->model::where('user_id', $id)->orderBy(self::ID, 'DESC');
        $listData = $newsModel->paginate($this->perpages);
        $count_all_tran = $newsModel->count();
        //status

        $count_tran_cancel = $this->model::where([['status', TRAN_STATUS_CANCEL], ['user_id', $id]])->get()->count();
        $count_tran_wait = $this->model::where([['status', TRAN_STATUS_WAIT], ['user_id', $id]])->get()->count();
        $list_services = $this->services->get()->toArray();

        $page = $this->request->input('page');
        if ($page) {
            $html = view('frontend.transactionhistory.search', ['data' => $listData, 'list_status' => $status_tranhistory])->render();
            return response()->json(array('success' => true, 'html' => $html, 'pagination' => $listData->links()->toHtml()));
        }

        return view(
            'frontend.transactionhistory.index',
            [
                'data'              => $listData,
                'services'          => $list_services,
                'list_status'       => $status_tranhistory,
                'count_all_tran'    => $count_all_tran,
                'count_tran_cancel' => $count_tran_cancel,
                'count_tran_wait'   => $count_tran_wait,
            ]
        );
    }

    /*
       |--------------------------------------------------------------------------
       | Tra cứu lịch theo gói dịch vụ
       |--------------------------------------------------------------------------
       |
       | @return object
       | @Author : phuonglv
        */
    public function getTranByProduct()
    {
        $id = $this->auth->user()->id;
        $product = $this->request->input('product');
        $status = $this->request->input('status');
        $status_tranhistory = $this->model->status_transactionhistory;

        $where_cloud = ['id', $id];
        $is_search = false;
        if ((int)$product > 0) {
            $where_cloud[] = ['service_code', '=', $product];
            $is_search = true;
        }
        if ((int) $status > 0) {
            $where_cloud[] = ['status', '=', $status];
            $is_search = true;
        }

        if ($is_search) {
            $data = $this->model::where($where_cloud)->paginate($this->perpages);
        } else {
            $data = $this->model->paginate($this->perpages);
        }
        $html = view('frontend.transactionhistory.search', ['data' => $data, 'list_status' => $status_tranhistory])->render();
        return response()->json(array('success' => true, 'html' => $html, 'pagination' => $data->links()->toHtml()));

    }

    /*
       |--------------------------------------------------------------------------
       | Tra cứu lịch theo số điện thoại hoặc chứng minh thư
       |--------------------------------------------------------------------------
       |
       | @return object
       | @Author : phuonglv
        */
    public function searchTranByPhoneAndIdCard()
    {
        $current_user_id = $this->auth->user()->id;
        $user_current = $this->user::where('id', $current_user_id)->get()->toArray();
        $user_current_amount = $user_current[0]['amount'];
        if (!$user_current_amount) {
            return response()->json(array('success' => true, 'html' => 'Số dư của bạn không đủ'));
        }


        $s_mobile = trim($this->request->input('phone'));
        $cardnumber = trim($this->request->input('cardnumber'));
        $status_tranhistory = $this->model->status_transactionhistory;

        $user_search = $this->user::where('phone', $s_mobile)
            ->orWhere('card_number', $cardnumber)->get()->toArray();
        $user_search = isset($user_search[0]) ? $user_search[0] : null;


        if ($user_search) {
            $data_ck = $this->model::where('user_id', $user_search['id'])->get()->toArray();
            if (!empty($data_ck) && count($data_ck) > 0) {
                if ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_SUCCESS) {
                    $this->updateUserAmount($current_user_id, ($user_current_amount - self::FEE_SEARCH_LOAN_HISTORY_SUCCESS));
                    $data = $this->model::where('user_id', $user_search['id'])->paginate();
                } elseif ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_DEFAULT) {
                    $this->updateUserAmount($current_user_id, ($user_current_amount - self::FEE_SEARCH_LOAN_HISTORY_DEFAULT));
                    return response()->json(array('success' => true, 'html' => 'Số dư của bạn không đủ'));
                } else {
                    return response()->json(array('success' => true, 'html' => 'Số dư của bạn không đủ'));
                }
            } else {
                if ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_DEFAULT) {
                    $this->updateUserAmount($current_user_id, ($user_current_amount - self::FEE_SEARCH_LOAN_HISTORY_DEFAULT));
                }
                return response()->json(array('success' => true, 'html' => 'Tìm kiếm không tồn tại'));
            }
        } else {
            if ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_DEFAULT) {
                $this->updateUserAmount($current_user_id, ($user_current_amount - self::FEE_SEARCH_LOAN_HISTORY_DEFAULT));
            }
            return response()->json(array('success' => true, 'html' => 'Tìm kiếm không tồn tại'));
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


    /*
       |--------------------------------------------------------------------------
       | Trừ tiền của user khi tra cứu
       |--------------------------------------------------------------------------
       |
       | @return object
       | @Author : phuonglv
        */
    public function updateUserAmount($id, $amount)
    {
        $this->user::where('id', $id)->update(['amount' => $amount]);
    }


    public function manageTran()
    {
        $status_tranhistory = $this->model->status_transactionhistory;
        $newsModel          = $this->model->orderBy(self::ID, 'DESC');
        $listData           = $newsModel->paginate($this->perpages);

        //status
        $count_tran_wait_consultant = $this->model::where('status', 1)->get()->count();
        $count_tran_wait_receive = $this->model::where('status', 2)->get()->count();
        $count_tran_is_borrowing = $this->model::where('status', 3)->get()->count();

        $sum_amount_tran_is_borrowing = $this->model::where('status', 3)->sum('amount');
        $list_services                = $this->services->get()->toArray();

        $page = $this->request->input('page');
        if ($page) {
            $html = view('frontend.transactionhistory.m_search', ['data' => $listData, 'list_status' => $status_tranhistory])->render();
            return response()->json(array('success' => true, 'html' => $html, 'pagination' => $listData->links()->toHtml()));
        }

        return view(
            'frontend.transactionhistory.manage',
            [
                'data'                         => $listData,
                'services'                     => $list_services,
                'list_status'                  => $status_tranhistory,
                'count_tran_wait_consultant'   => $count_tran_wait_consultant,
                'count_tran_wait_receive'      => $count_tran_wait_receive,
                'count_tran_is_borrowing'      => $count_tran_is_borrowing,
                'sum_amount_tran_is_borrowing' => $sum_amount_tran_is_borrowing,
            ]
        );
    }

    public function getManageBysServiceAndStatus() {
        $product            = $this->request->input('product');
        $status             = $this->request->input('status');
        $status_tranhistory = $this->model->status_transactionhistory;

        $where_cloud = array();
        if ((int) $product > 0) {
            $where_cloud[] = ['service_code', '=', $product];
        }
        if ((int) $status > 0) {
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

    /*
        |---------------------------------------
        | Update status
        |---------------------------------------
        | @params
        | @method GET
        | @return Response
        | @author phuonglv
       */
    public function updateStatus()
    {
        $loanCreditId = $this->request->input('loanCreditId');
        $status = $this->request->input('status');
        $this->model::where('id', '=', $loanCreditId)->update(['status' => $status]);
    }

    /*
    |---------------------------------------
    | Get form user register to borrow
    |---------------------------------------
    | @params
    | @method GET
    | @return view
    | @author tantan
     */
    public function getDetailForm($slug) {
        $data = $this->services->findBySlug($slug);
        if ($data == null) {
            abort(404);
        }
        $user = \Auth::user();
        return view('frontend.service.register')->with(compact('user', 'data'));
    }

    /*
    |---------------------------------------
    | Process form user register to borrow
    |---------------------------------------
    | @params
    | @method POST
    | @return Response
    | @author tantan
     */
    public function postDetailForm($slug) {
        if (!\Auth::check()) {
            return redirect(route('frontend.user.register', ['destination' => '/dang-ky-vay/' . $slug]))
                ->with('status', true)
                ->withMessage('Bạn phải đăng ký để tiếp tục!');
        }

        $user  = \Auth::user();
        $input = $this->request->all();

        $validator = $this->validator($input);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $service                   = $this->services->findBySlug($slug);
        $amountConfig              = $service->amount_config();
        $dayConfig                 = $service->day_config();
        $input['status']           = $this->model::STATUS_WAIT;
        $input['user_id']          = $user->id;
        $unitDay                   = $input['amount_day'] . $dayConfig[0]['unit'];
        $paymentDay                = strtotime('+' . $unitDay);
        $input['amount_day']       = round(($paymentDay - time()) / (60 * 60 * 24));
        $input['payment_day']      = date('Y-m-d H:i', $paymentDay);
        $input['service_code']     = $service->id;
        $input['fee']              = $service->fee;
        $input['percent_discount'] = $service->discount;
        $input['fee_type']         = ($input['fee'] > 0 && $input['percent_discount'] < 100) ? $this->services::COPHI : $this->services::MIENPHI;
        $this->model->create($input);
        return redirect()->back()->with('status', true)->with('message', 'Đăng ký vay thành công!');
    }

    /*
    |---------------------------------------
    | San giao dich
    |---------------------------------------
    | @params
    | @method GET
    | @return Response
    | @author cuongnt
     */
    public function getListTransaction() {
        $listService         = Service::all();
        $totalMoney          = TransactionHistory::where('status', TransactionHistory::STATUS_APPROVE)->sum('amount');
        $total_reg_borrow    = User::where('type', VAY)->count();
        $total_reg_loan      = User::where('type', CHO_VAY)->count();
        $listTransactionNews = TransactionHistory::where('status', TransactionHistory::STATUS_WAIT)->orderBy('id', 'desc')->paginate($this->perpages);
        return view('frontend.transactionhistory.list_transaction', [
            'data'             => $listTransactionNews,
            'list_service'     => $listService,
            'totalmoney'       => $totalMoney,
            'total_reg_borrow' => $total_reg_borrow,
            'total_reg_loan'   => $total_reg_loan,
        ]);
    }

    public function putStatusTransaction($id) {
        $obj = $this->model->find($id);
        if (!$obj) {
            dd('Không tồn tại giao dịch này');
        }
        if ($obj->status != $this->model::STATUS_WAIT) {
            dd('Bạn không thể nhận giao dịch này');
        }
        $obj->status = $this->model::STATUS_RECEIVED;
        if ($obj->fee) {
            $user = $this->user->find($this->auth->user()->id);
            if ($user->fee <= (int) $obj->fee) {
                dd('Bạn không đủ tiền để nhận giao dịch này');
            }
            $user->amount -= (int) $obj->fee;
            $user->save();
        }
        $obj->save();
        //store log
        $dataLog['transaction_id'] = $obj->id;
        $dataLog['service_code']   = $obj->service_code;
        $dataLog['created_by']     = $this->auth->user()->id;
        $dataLog['city_id']        = $obj->city_id;
        $dataLog['district_id']    = $obj->district_id;
        $dataLog['ward_id']        = $obj->ward_id;
        $dataLog['amount']         = $obj->amount;
        $dataLog['amount_day']     = $obj->amount_day;
        TransactionHistoryLog::create($dataLog);
        return redirect()->action('Frontends\TransactionHistory\ListTransactionController@index');
    }
}
