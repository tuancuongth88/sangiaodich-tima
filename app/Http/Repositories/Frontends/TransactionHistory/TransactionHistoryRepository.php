<?php namespace App\Http\Repositories\Frontends\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
use App\Models\TransactionHistory\TransactionHistory;
use App\Models\TransactionHistory\TransactionHistoryLog;
use App\Models\Users\AccountLog;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class TransactionHistoryRepository extends Repository {

    private $model;
    protected $model_log;
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
        TransactionHistoryLog $transactionHistoryLog,
        Service $services,
        ResponseService $response,
        Request $request,
        AuthService $auth,
        User $user,
        $perpages = 20,
        $current = 1
    ) {
        $this->model     = $transactionHistory;
        $this->model_log = $transactionHistoryLog;
        $this->services  = $services;
        $this->response  = $response;
        $this->request   = $request;
        $this->auth      = $auth;
        $this->user      = $user;
        $this->perpages  = $perpages;
        $this->current   = $current;
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
        if(!\Auth::check()){
            return redirect('user/login');
        }
        if (\Auth::user()->type != \PermissionCommon::VAY) {
            return redirect('/home');
        }

        $id = $this->auth->user()->id;

        $status_tranhistory = $this->model->status_transactionhistory;
        $newsModel          = $this->model::where('user_id', $id)->orderBy(self::ID, 'DESC');
        $listData           = $newsModel->paginate($this->perpages);
        $count_all_tran     = $newsModel->count();
        //status

        $count_tran_cancel = $this->model::where([['status', TRAN_STATUS_CANCEL], ['user_id', $id]])->get()->count();
        $count_tran_wait   = $this->model::where([['status', TRAN_STATUS_WAIT], ['user_id', $id]])->get()->count();
        $list_services     = $this->services->get()->toArray();

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
        if(!\Auth::check()){
            return redirect('user/login');
        }

        $id = $this->auth->user()->id;
        $product = $this->request->input('product');
        $status = $this->request->input('status');
        $status_tranhistory = $this->model->status_transactionhistory;

        $where_cloud[] = ['id', $id];
        $is_search     = false;
        if ((int) $product > 0) {
            $where_cloud[] = ['service_code', '=', $product];
            $is_search     = true;
        }
        if ((int) $status > 0) {
            $where_cloud[] = ['status', '=', $status];
            $is_search     = true;
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
        if(!\Auth::check()){
            return redirect('user/login');
        }
        if (\Auth::user()->type != \PermissionCommon::CHO_VAY) {
            return redirect('/home');
        }

        $s_mobile = trim($this->request->input('phone'));
        $cardnumber = trim($this->request->input('cardnumber'));
        $current_user_id = $this->auth->user()->id;

        if ($s_mobile == '' && $cardnumber == '') {
            return view('frontend.transactionhistory.s_index');
        }

        $user_current        = $this->user::where('id', $current_user_id)->get()->toArray();
        $user_current_amount = $user_current[0]['amount'];
        if (!$user_current_amount) {
            return response()->json(array('success' => true, 'html' => 'Số dư của bạn không đủ'));
        }

        $status_tranhistory = $this->model->status_transactionhistory;

        $user_search = $this->user::where('phone', $s_mobile)
            ->orWhere('card_number', $cardnumber)->get()->toArray();
        $user_search = isset($user_search[0]) ? $user_search[0] : null;

        if ($user_search) {
            $data_ck = $this->model::where('user_id', $user_search['id'])->get()->toArray();
            if (!empty($data_ck) && count($data_ck) > 0) {
                if ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_SUCCESS) {
                    $this->updateUserAmount($current_user_id, $user_current_amount, self::FEE_SEARCH_LOAN_HISTORY_SUCCESS);
                    $data = $this->model::where('user_id', $user_search['id'])->paginate();
                } elseif ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_DEFAULT) {
                    $this->updateUserAmount($current_user_id, $user_current_amount,  self::FEE_SEARCH_LOAN_HISTORY_DEFAULT);
                    return response()->json(array('success' => true, 'html' => 'Số dư của bạn không đủ'));
                } else {
                    return response()->json(array('success' => true, 'html' => 'Số dư của bạn không đủ'));
                }
            } else {
                if ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_DEFAULT) {
                    $this->updateUserAmount($current_user_id, $user_current_amount, self::FEE_SEARCH_LOAN_HISTORY_DEFAULT);
                }
                return response()->json(array('success' => true, 'html' => 'Tìm kiếm không tồn tại'));
            }
        } else {
            if ($user_current_amount >= self::FEE_SEARCH_LOAN_HISTORY_DEFAULT) {
                $this->updateUserAmount($current_user_id, $user_current_amount, self::FEE_SEARCH_LOAN_HISTORY_DEFAULT);
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
    public function updateUserAmount($id, $amount,$deducted) {
        //store log
        if(!\Auth::check()){
            return redirect('user/login');
        }
        $accountLog['amount']  = -(int) $deducted;
        $accountLog['user_id'] = $id;
        AccountLog::create($accountLog);
        $this->user::where('id', $id)->update(['amount' => ($amount - $deducted)]);
    }

    /*
    |--------------------------------------------------------------------------
    | Quản lý các đơn vay của người mua
    |--------------------------------------------------------------------------
    |
    | @return object
    | @Author : phuonglv
     */

    public function manageTran()
    {
        if(!\Auth::check()){
            return redirect('user/login');
        }
        if (\Auth::user()->type != \PermissionCommon::CHO_VAY) {
            return redirect('/home');
        }
        $id = $this->auth->user()->id;

        $status_tranhistory = $this->model->status_transactionhistory;
        $modelLog           = $this->model_log::where('receiver', $id)->orderBy(self::ID, 'DESC');
        $listData           = $modelLog->paginate($this->perpages);

        //status

        $count_tran_wait_consultant = $this->model_log::where([['status', TRAN_STATUS_WAIT], ['receiver', $id]])->get()->count();
        $count_tran_wait_receive    = $this->model_log::where([['status', TRAN_STATUS_RECEIVED], ['receiver', $id]])->get()->count();
        $count_tran_is_borrowing    = $this->model_log::where([['status', TRAN_STATUS_BORROWING], ['receiver', $id]])->get()->count();

        $sum_amount_tran_is_borrowing = $this->model_log::where([['status', TRAN_STATUS_APPROVE], ['receiver', $id]])->sum('amount');

        $list_services = $this->services->get()->toArray();

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
                'sum_amount_tran_is_borrowing' => number_format($sum_amount_tran_is_borrowing),
            ]
        );
    }

    public function getManageBysServiceAndStatus() {
        $id = $this->auth->user()->id;

        $product            = $this->request->input('product');
        $status             = $this->request->input('status');
        $status_tranhistory = $this->model->status_transactionhistory;

        $where_cloud[] = ['receiver', '=', $id];
        if ((int) $product > 0) {
            $where_cloud[] = ['service_code', '=', $product];
        }
        if ((int) $status > 0) {
            $where_cloud[] = ['status', '=', $status];
        }
        $data = $this->model_log::where($where_cloud)->paginate($this->perpages);

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
    public function updateStatus() {
        $id           = $this->auth->user()->id;
        $loanCreditId = $this->request->input('loanCreditId');
        $status       = $this->request->input('status');
        $this->model::where('id', '=', $loanCreditId)->update(['status' => $status]);
    }

    /*
    |---------------------------------------
    | Update status to table Log
    |---------------------------------------
    | @params
    | @method GET
    | @return Response
    | @author phuonglv
     */
    public function updateStatusTranLog() {
        $id           = $this->auth->user()->id;
        $loanCreditId = $this->request->input('loanCreditId');
        $status       = $this->request->input('status');

        $obj_log = $this->model_log::where([['id', $loanCreditId], ['receiver', $id]])->get()->toArray();
        $obj_log = isset($obj_log[0]) ? $obj_log[0] : null;
        if (!empty($obj_log)) {
            $transaction_id = $obj_log['transaction_id'];
            if ($status == TRAN_STATUS_CANCEL) {
                $this->model::where('id', $transaction_id)->update(['status' => TRAN_STATUS_WAIT]);
            } else {
                $this->model::where('id', $transaction_id)->update(['status' => $status]);
            }
            $this->model_log::where('id', $loanCreditId)->update(['status' => $status]);
        }
    }
    /*
       |---------------------------------------
       | Get all lender in tran log
       |---------------------------------------
       | @params
       | @method GET
       | @return Response
       | @author phuonglv
        */
    public function getListLenderByLoanID() {

        $loanCreditId = $this->request->input('loanCreditId');
        $obj_log = $this->model_log::where([['transaction_id', $loanCreditId]])->get();

        $status_tranhistory = $this->model->status_transactionhistory;

        $html = view('frontend.transactionhistory.listlender', ['data' => $obj_log, 'list_status' => $status_tranhistory])->render();
        return response()->json(array('success' => true, 'html' => $html));
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
        $transaction               = $this->model->create($input);
        if ($transaction->id != null) {
            return redirect()->route('transaction.site.updateform', [$slug, $transaction]);
        }
        return redirect()->back()->with('error', true)->with('message', 'Có lỗi xảy ra! Đơn vay chưa được khỏi tạo. Vui lòng thử lại!');
    }

    /*
    |---------------------------------------
    | GET UPDATE FORM AFTER SEND A TRANSACTION
    |---------------------------------------
    | @params
    | @method GET
    | @return responsive
    | @author tantan
     */
    public function transactionUpdateForm($service, $transaction) {
        $form = \Common::getFormOfService($service);
        return view('frontend.transactionhistory.update_info')->with(compact('service', 'transaction', 'form'));
    }

    /*
    |---------------------------------------
    | SAVE UPDATE FORM AFTER SEND A TRANSACTION
    |---------------------------------------
    | @params
    | @method POST
    | @return responsive
    | @author tantan
     */
    public function postTransactionUpdateForm($service, $tranId) {
        $input       = $this->request->all();
        $transaction = $this->model->findOrFail($tranId);
        if (!empty($input['user'])) {
            ///// Lay thong tin user dang don vay
            $thisUser = $transaction->user();
            if ($thisUser) {
                /// if this filed not empty and user already update before
                /// we will be ignore them
                foreach ($input['user'] as $field => $value) {
                    if ($value != '' && $thisUser->$field != '') {
                        unset($input['user'][$field]);
                    }
                }
                $thisUser->update($input['user']);
            }
        }
        if (!empty($input['transaction'])) {
            $transaction->update($input['transaction']);
        }
        return redirect()->route('frontends.manager.transaction')->with('status', true)->with('message', 'Cảm ơn ' . \Common::getDisplayNameUser($thisUser) . '! Thông tin đơn ' . $service->service_name . ' của bạn đã được lưu thành công!');
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
        $listService      = Service::all();
        $totalMoney       = TransactionHistory::where('status', TransactionHistory::STATUS_APPROVE)->sum('amount');
        $total_reg_borrow = User::where('type', VAY)->count();
        $total_reg_loan   = User::where('type', CHO_VAY)->count();
        $input            = $this->request->all();
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
        // dd($input);
        $listTransactionNews = TransactionHistory::where('status', TransactionHistory::STATUS_WAIT)->where($input)->orderBy('id', 'desc')->paginate($this->perpages);
        return view('frontend.transactionhistory.list_transaction', [
            'data'             => $listTransactionNews,
            'list_service'     => $listService,
            'totalmoney'       => $totalMoney,
            'total_reg_borrow' => $total_reg_borrow,
            'total_reg_loan'   => $total_reg_loan,
        ]);
    }

    public function putStatusTransaction($id) {
        if (!\Auth::check()) {
            return redirect()->back()->with('message', 'Vui lòng đăng nhập');
        }
        $obj = $this->model->find($id);
        if (!$obj) {
            return redirect()->back()->with('message', 'Không tồn tại giao dịch này');
        }
        if ($obj->status != $this->model::STATUS_WAIT) {
            return redirect()->back()->with('message', 'Bạn không thể nhận giao dịch này');
        }
        $obj->status = $this->model::STATUS_RECEIVED;
        if ($obj->fee) {
            $fee = $this->getFeeTransaction($obj);
            $user = $this->user->find($this->auth->user()->id);
            if ($user->amount < $fee) {
                return redirect()->back()->with('message', 'Bạn không đủ tiền để nhận giao dịch này');
            }
            $user->amount -= $fee;
            $user->save();
            //store log
            $accountLog['amount']  = -$fee;
            $accountLog['user_id'] = $user->id;
            AccountLog::create($accountLog);
        }
        $obj->save();
        //store log

        $dataLog['transaction_id']   = $obj->id;
        $dataLog['service_code']     = $obj->service_code;
        $dataLog['created_by']       = $obj->user_id;
        $dataLog['receiver']         = $this->auth->user()->id;
        $dataLog['city_id']          = $obj->city_id;
        $dataLog['district_id']      = $obj->district_id;
        $dataLog['ward_id']          = $obj->ward_id;
        $dataLog['amount']           = $obj->amount;
        $dataLog['amount_day']       = $obj->amount_day;
        $dataLog['status']           = $obj->status;
        $dataLog['fee']              = $obj->fee;
        $dataLog['fee_type']         = $obj->fee_type;
        $dataLog['percent_discount'] = $obj->percent_discount;
        TransactionHistoryLog::create($dataLog);
        return redirect()->action('Frontends\TransactionHistory\ListTransactionController@index');
    }

    public function getFeeTransaction($obj){
        return ((int) $obj->fee * (int)$obj->percent_discount) / 100;
    }

}
