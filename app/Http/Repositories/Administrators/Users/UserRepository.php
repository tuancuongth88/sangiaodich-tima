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
use JWTAuth;
use PhpSpec\Exception\Exception;
use Validator;

/**
 *
 */
class UserRepository extends Repository {

    private $request;

    protected $auth;

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
    const GENDER     = 'gender';
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

    public function __construct(User $user, UserType $userType, AuthService $auth, ResponseService $response, Request $request, $perpages = self::TWENTY, $current = self::ONE, ActivationService $activationService) {
        $this->user              = $user;
        $this->auth              = $auth;
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
            self::GENDER,
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
        $data[self::CREATE_BY] = $this->auth->user()->id;
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
                self::GENDER   => 'required',
            ], $messages);
        }
        return Validator::make($array, [
            self::EMAIL    => 'required|email|max:255',
            self::FULLNAME => 'required|max:60',
            self::GENDER   => 'required',
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
            self::GENDER,
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

    public function getPurchase() {
        return view('administrator.users.purchase');
    }

    public function postPurchase() {
        if (!\Auth::check()) {
            dd('Vui lòng đăng nhập');
        }
        $amount = (int) $this->request->input('amount');
        if ($amount <= 0) {
            dd('Bạn vui lòng kiểm tra lại số tiền nạp');
        }
        $user = $this->user->where('email', $this->request->input('email'))->first();
        if (!$user) {
            dd('Không tồn tại tài khoản này');
        }
        $user->amount += $amount;
        $user->save();
        //store log
        $dataLog['amount']  = $amount;
        $dataLog['user_id'] = $user->id;
        AccountLog::create($dataLog);
        return redirect()->back();
    }

}