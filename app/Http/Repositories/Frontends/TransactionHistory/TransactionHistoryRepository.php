<?php namespace App\Http\Repositories\Frontends\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
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

    const USER_ID = 'user_id';
    const CITY_ID = 'city_id';
    const DISTRICT_ID = 'district_id';
    const WARD_ID = 'ward_id';
    const AMOUNT = 'amount';
    const AMOUNT_DAY = 'amount_day';
    const PAYMENT_DAY = 'payment_day';
    const STATUS = 'status';
    const AGREE_TERM = 'agree_term';

    function __construct(
        TransactionHistory $transactionHistory,
        Service $services,
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
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->user = $user;
        $this->perpages = $perpages;
        $this->current = $current;
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT FIELD STORE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and store.
    | @Author : tantan
     */
    protected function getInputFieldStore()
    {
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
    public function validator(array $array){
        $messages = [
            'required'       => 'Vui lòng nhập :attribute',
            self::CITY_ID.'.required'       => 'Vui lòng chọn thành phố',
            self::DISTRICT_ID.'.required'   => 'Vui lòng chọn quận/huyện',
            self::AGREE_TERM.'.required'    => 'Bạn phải đồng ký với điều khoản của chúng tôi',
        ];
        return Validator::make($array, [
            self::CITY_ID      => 'required',
            self::DISTRICT_ID         => 'required',
            self::AGREE_TERM      => 'required',
        ], $messages);
    }

    public function getLatest()
    {
        return $this->model->approve()->orderBy(self::ID, 'desc')->take(5)->get();
    }

    public function index()
    {
        $id = $this->auth->user()->id;

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
            $where_cloud[] = ['service_code', '=', $product];
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
            $where_cloud[] = ['service_code', '=', $product];
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

    public function updateStatus()
    {
        $post_update = $this->request->input('post_update');
        $this->model::where('post_update', '=', $post_update)->update(['set' => 'setval']);
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
    public function getDetailForm($slug){
        $data = $this->services->findBySlug($slug);
        if( $data == null ){
            abort(404);
        }
        $user = \Auth::user();
        if( $user == null ){
            $user = new $this->user();
        }
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
    public function postDetailForm($slug){
        if( !\Auth::check() ){
            return redirect(route('frontend.user.register', ['destination' => '/dang-ky-vay/'.$slug ]))
                ->with('status', true)
                ->withMessage('Bạn phải đăng ký để tiếp tục!');
        }

        $user = \Auth::user();
        $input = $this->getInputFieldStore();
        $validator = $this->validator($input);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $service = $this->services->findBySlug($slug);
        $amountConfig = $service->amount_config();
        $dayConfig = $service->day_config();
        $input['user_id'] = $user->id;
        $unitDay = $input['amount_day'].$dayConfig[0]['unit'];
        $paymentDay = strtotime('+'.$unitDay);
        $input['amount_day'] = round(($paymentDay - time())/(60 * 60 * 24));
        $input['payment_day'] = date('Y-m-d H:i', $paymentDay);
        $input['service_code'] = $service->id;
        $this->model->create($input);
        return redirect()->back()->with('status', true)->with('message', 'Đăng ký thành công!')->with('redirect', true);
    }
}
