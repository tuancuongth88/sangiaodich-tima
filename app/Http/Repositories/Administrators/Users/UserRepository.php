<?php

namespace App\Http\Repositories\Administrators\Users;
use App\Http\Repositories\Administrators\Repository;
use App\Http\Services\ActivationService;
use App\Models\Users\AccountLog;
use App\Models\Users\User;
use App\Models\Users\UserType;
use App\Services\AuthService;
use App\Services\ResponseService;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use PhpSpec\Exception\Exception;
use Validator;

/**
 *
 */
class UserRepository extends Repository {

    private $request;

    protected $auth;
    protected $m_accountLog;

    private $response;

    private $user;

    private $perpages;

    private $current;

    private $hash;

    private $type;

    protected $activationService;

    // private $userSearchCollection;

    const ZERO           = 0;
    const ONE            = 1;
    const TWENTY         = 20;
    const DEFAULT_AVATAR = 'avatars/default-avatar.jpg';
    // form input field.
    const OLD_PASSWORD     = 'old_password';
    const NEW_PASSWORD     = 'new_password';
    const PASSWORD_CONFIRM = 'password_confirmation';
    const PERPAGES         = 'perpages';
    const USER             = 'user';
    const SEARCH_INPUT     = 'search';

    // field of user table.
    const ID         = 'id';
    const FULLNAME   = 'fullname';
    const USERNAME   = 'username';
    const EMAIL      = 'email';
    const PHONE      = 'phone';
    const CREATE_BY  = 'create_by';
    const UPDATED_BY = 'updated_by';
    const AVATAR     = 'avatar';
    const BIRTHDAY   = 'birthday';
    //const GENDER     = 'gender';
    const ADDRESS    = 'address';
    const ACTIVE     = 'active';
    const PASSWORD   = 'password';
    const CURRENT    = 'current';
    const DELETED    = 'deleted';
    const ITEMS      = 'items';
    const TYPE       = 'type';
    const IDENTITY   = 'identity';

    const MODULE_NAME = 'USER';
    const MODULE      = 'modules';
    const TABLE       = 'companies';

    public function __construct(
        User $user,
        UserType $userType,
        AccountLog $accountLog,
        AuthService $auth,
        ResponseService $response,
        Request $request,
        $perpages = self::TWENTY,
        $current = self::ONE,
        ActivationService $activationService
    ) {
        $this->user              = $user;
        $this->auth              = $auth;
        $this->m_accountLog      = $accountLog;
        $this->request           = $request;
        $this->current           = $current;
        $this->response          = $response;
        $this->perpages          = $perpages;
        $this->type              = $userType;
        $this->activationService = $activationService;
    }

    /*
    |--------------------------------------------------------------------------
    | STORE NEW USER.
    |--------------------------------------------------------------------------
    | @params
    | @return response
    | @Author : haind
     */
    public function store() {
        $fieldInput = [
            self::USERNAME,
            self::FULLNAME,
            self::PASSWORD,
            self::PASSWORD_CONFIRM,
            self::EMAIL,
            self::PHONE,
            //self::GENDER,
            self::ADDRESS,
            self::BIRTHDAY,
            self::PASSWORD,
            self::AVATAR,
            self::IDENTITY,
        ];
        $array     = $this->request->only($fieldInput);
        $validator = $this->validator($array);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($array);
        }
        $count = $this->user->where(self::EMAIL, $array[self::EMAIL])->count();
        if ($count > self::ZERO) {
            return redirect()->back()->withInput($array)->with('error', true)->with('message', 'Email đã đăng ký!');
        }
        $data                  = $array;
        $data[self::CREATE_BY] = \Auth::user()->id;
        $data[self::EMAIL]     = strtolower($array[self::EMAIL]);
        $data[self::ACTIVE]    = self::ZERO;
        $data['avatar']        = '';
        if ($this->request->hasFile('avatar')) {
            $file            = $this->request->avatar;
            $destinationPath = public_path() . IMAGEUSER;
            $filename        = time() . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $data['avatar']  = IMAGEUSER . $filename;
        }
        $obj = $this->user->create($data);
        if ($obj) {
            return redirect()->action('Administrators\Users\UserController@index')->with('status', true)->with('message', 'Thêm mới thành công!');
        }
        return redirect()->back()->withInput($data)->with('error', true)->with('message', 'Thêm mới thất bại!');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATOR ARRAY FIELD.
    |--------------------------------------------------------------------------
    | @params $array array, $admin boolean.
    | @return mix \Validator
    | @Author : haind
     */
    public function validator(array $array, $id = null) {
        $messages = [
            'required'    => ':attribute không được để trống.',
            'max'         => ':attribute không quá 255 ký tự.',
            'confirmed'   => ':attribute không trùng khớp.',
            'date_format' => ':attribute không đúng định dạng.',
            'regex'       => ':attribute không đúng định dạng.',
        ];
        if ($id) {
            return Validator::make($array, [
                self::FULLNAME => 'required|max:60',
                //self::GENDER   => 'required',
            ], $messages);
        }
        return Validator::make($array, [
            self::EMAIL    => 'required|email|max:255',
            self::FULLNAME => 'required|max:60',
            //self::GENDER   => 'required',
            self::BIRTHDAY => 'date|date_format:"d-m-Y"',
            self::PASSWORD => 'required|confirmed',
        ], $messages);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE INFORMATION
    |--------------------------------------------------------------------------
    | @params
    | @return
    | @Author : haind
     */
    public function update($id) {
        $fieldInput = [
            self::FULLNAME,
            self::PHONE,
           // self::GENDER,
            self::ADDRESS,
            self::AVATAR,
            self::BIRTHDAY,
        ];
        $input = $this->request->only($fieldInput);
        // $input = array_filter($input);
        // validator field.
        $validator = $this->validator($input, $id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }
        // check user isset.
        $user = $this->FindDataBySomeModel($this->user, $id);
        if (!$user) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
        $input[self::BIRTHDAY] = \Carbon\Carbon::parse($input['birthday']);
        $obj                   = $this->user->where(self::ID, $id)->update($input);
        if (!$obj) {
            return redirect()->action('Administrators\Users\UserController@index')->with('error', true)->with('message', 'Cập nhật thất bại!');
        }
        return redirect()->action('Administrators\Users\UserController@index')->with('status', true)->with('message', 'Cập nhật thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    |  GET LIST USER BY PERPAGES
    |--------------------------------------------------------------------------
    | @params $input array
    | @return $result array
    | @Author : haind
     */
    public function index() {
        $orderField     = ($this->request->has('field')) ? $this->request->input('field') : self::ID;
        $orderType      = ($this->request->has('type')) ? $this->request->input('type') : self::ID;
        $perpages       = $this->request->input(self::PERPAGES);
        $this->perpages = $perpages ? $perpages : self::TWENTY;
        $query          = $this->user->orderBy($orderField, ($orderType) ? 'asc' : 'desc');

        if ($this->request->has('query')) {
            $query = $query
                ->search($this->request->input('search'))
                ->orderBy('created_at', 'DESC');
        }
        $listData = $query->paginate($this->perpages);

        return view('administrator.users.index', ['data' => $listData]);
    }

    /*
    |--------------------------------------------------------------------------
    | GET USER PROFILE INFOMATION.
    |--------------------------------------------------------------------------
    | @params
    | @return {obj}
    | @Author : haind
     */
    public function show($userId) {
        $user = $this->user->find($userId);
        if (!$user) {
            return $this->response->json(false, '', $this->getErrorMessages($e));
        }
        return $this->response->json(true, $user, '');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE USER.
    |--------------------------------------------------------------------------
    | @params
    | @return obj
    | @Author : haind
     */
    public function destroy($id) {
        $user = $this->user->find($id);
        $user->delete();
        if (!$user) {
            return redirect()->action('Administrators\Users\UserController@index')->with('error', true)->with('message', 'Xóa thất bại!');
        }
        return redirect()->action('Administrators\Users\UserController@index')->with('status', true)->with('message', 'Xóa thành công!');
    }

    public function getSearchData() {
        $user = $this->user->where(self::FULLNAME, $this->request->only('keyword'))->get()->toArray();
        if (!$user) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
        return $this->response->json(true, $user, '');
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH PROJECT
    |--------------------------------------------------------------------------
    | @params
    | @return {array}
    | @Author : haind
     */

    public function getSearch() {
        if ($this->request->has('query')) {
            $objModel = $this->user
                ->search($this->request->input('search'))
                ->orderBy('created_at', 'DESC');
            $total = $objModel->count();
            $data  = $objModel->get()->toArray();
            if ($total > 0) {
                foreach ($data as $key => $value) {
                    $dataResponse[] = [
                        'id'          => $value['id'],
                        'name'        => $value['fullname'],
                        'sub_name'    => $value['phone'],
                        'description' => $value['email'],
                        'url'         => route('user.edit', ['id' => $value['id']]),
                    ];
                }
            }
            return view('administrator.theme.search-result', ['total' => $total, 'data' => $dataResponse]);
        }
    }

    public function create() {
        return view('administrator.users.create');
    }

    public function edit($id) {
        $user = $this->user->find($id)->toArray();
        return view('administrator.users.edit', ['user' => $user]);
        // return view('administrator.users.info', ['data' => $data, 'user' => $user]);
    }

    public function getPurchase($id) {
        return view('administrator.users.purchase', compact('id'));
    }

    public function postPurchase() {
        if (!\Auth::check()) {
            dd('Vui lòng đăng nhập');
        }
        $amount = (int) $this->request->input('amount');
        if ($amount <= 0) {
            dd('Bạn vui lòng kiểm tra lại số tiền nạp');
        }
        $user = $this->user->find($this->request->input('user_id'));
        if (!$user) {
            dd('Không tồn tại tài khoản này');
        }
        $user->amount += $amount;
        $user->save();
        //store log
        $dataLog['amount']  = '+'.$amount;
        $dataLog['user_id'] = $user->id;
        $dataLog['type'] = RECHARGE;
        AccountLog::create($dataLog);
        return redirect()->action('Administrators\Users\UserController@index')->with('message', 'Nạp tiền thành công');
    }

    public function allTranHistory() {
        if (!\Auth::check()) {
            dd('Vui lòng đăng nhập');
        }

        $data = AccountLog::all();
        $lis_type = AccountLog::$account_log_type;




        $input = $this->request->all();
        $from = isset($input['from']) ? ($input['from']) : 0;
        $to = isset($input['to']) ? ($input['to']) : 0;
        $isDownload = isset($input['download']) ? $input['download'] : 0;

        $where = array();

        if (isset($input['type']) && !$input['type'] == 0) {
            $where[] = ['type', '=', $input['type']];
        }
        if (isset($input['phone'])) {
            $user_search = $this->user::where('phone', 'like', '%' . $input['phone'] . '%')->get()->toArray();
        }

        $users_id = array();
        if (isset($user_search[0]) && !empty($user_search[0])) {
            foreach ($user_search as $key => $user) {
                $users_id[] = $user['id'];
            }
        }

        if ($from) {
            $where[] = [DB::raw('date(created_at)'), '>=',  convertDate('Y-m-d',$from)];
        }
        if ($to){
            $where[] = [DB::raw('date(created_at)'), '<=',  convertDate('Y-m-d',$to)];
        }


        if (!empty($users_id)) {
            $query = $this->m_accountLog->where($where)->whereIn('user_id', $users_id)->orderBy('id', 'desc');
        } else {
            $query = $this->m_accountLog->where($where)->orderBy('id', 'desc');
        }
        $listData = $query->paginate($this->perpages);
        if ($isDownload) {
            $this->booksListPhpExcelUser($listData);
        }
        return view('administrator.users.alltranhistory',
            ['data' => $listData, 'lis_type'=>$lis_type, 'input' => $input]
        );
    }

    public function booksListPhpExcelUser($bookData)
    {
        $fileType = \PHPExcel_IOFactory::identify(storage_path('excels/all_tran_history_acount_log.xlsx')); // đọc loại file template
        $objReader = \PHPExcel_IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load(storage_path('excels/all_tran_history_acount_log.xlsx')); //load dữ liệu từ file excel luu vao bien $objPHPExcel

        $this->addDataToExcelFileUser($objPHPExcel->setActiveSheetIndex(0), $bookData); //chay ham them du lieu vao excel
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //Ham tao moi file excel
        $namedownload = 'report_trans' . time() . '.xlsx';
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        header('Content-Disposition: attachment; filename="' . $namedownload . '"');
        // Write file to the browser
        $objWriter->save('php://output');

    }

    private function addDataToExcelFileUser($setCell, $bookData) //HAM THEM DU LIEU VAO FILE EXCEL
    {
        //$setCell->setCellValue('D7', 'Đào Hải Long');   //them doan text Dao Hai Long vao o D7
        $lis_type = AccountLog::$account_log_type;
        $index = 1;

        $row = 2;  //danh dau dong bat dau them data, su dung trong vong lap foreach

        foreach ($bookData as $key => $item) {
            $setCell
                ->setCellValue('A' . $row, $index)//them du lieu vao cot B
                ->setCellValue('B' . $row, $lis_type[$item->type])
                ->setCellValue('C' . $row, $item->user->phone)
                ->setCellValue('D' . $row, $item->amount)
                ->setCellValue('E' . $row, $item->created_at);
            //->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri

            $index++;

            $row++;
        }

        //them duong vien cho du lieu trong file excel
//
//        $setCell->getStyle("A2:E" . ($index + 10))->applyFromArray(array(
//            'borders' => array(
//                'outline' => array(
//                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
//                    'color' => array('argb' => '000000'),
//                    'size' => 1,
//                ),
//                'inside' => array(
//                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
//                    'color' => array('argb' => '000000'),
//                    'size' => 1,
//                ),
//            ),
//        ));
        //------------------------------------------------------------------

        return $this;
    }

}