<?php namespace App\Http\Repositories\Frontends\Users;

use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\Administrators\Repository;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegister;
use Validator;

class UsersRepository extends Repository
{

    protected $user;

    function __construct(ResponseService $response, Request $request, AuthService $auth, User $user, $companyId = 0, $perpages = 2, $current = 1)
    {
        $this->model = $user;
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->user = $user;
    }

    // field of user table.
    const ID = 'id';
    const FULLNAME = 'fullname';
    const PHONE = 'phone';
    const USERNAME = 'username';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const TYPE = 'type';

    /*
    |--------------------------------------------------------------------------
    | VALIDATOR ARRAY FIELD FOR ONLY LOGIN.
    |--------------------------------------------------------------------------
    | @params $array array.
    | @return mix \Validator
    | @Author : tantan
     */
    public function loginValidator(array $array)
    {
        $messages = [
            'required' => 'Vui lòng nhập :attribute',
            self::PASSWORD . '.required' => 'Vui lòng nhập mật khẩu.',
            self::PHONE . '.required' => 'Vui lòng nhập số điện thoại.',
        ];
        return Validator::make($array, [
            self::PHONE => 'required',
            self::PASSWORD => 'required',
        ], $messages);
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATOR ARRAY FIELD.
    |--------------------------------------------------------------------------
    | @params $array array.
    | @return mix \Validator
    | @Author : tantan
     */
    public function validator(array $array)
    {
        $messages = [
            'required' => 'Vui lòng nhập :attribute',
            self::FULLNAME . '.required' => 'Vui lòng nhập họ tên',
            self::FULLNAME . '.max' => 'Họ tên không quá 255 ký tự.',
            self::PASSWORD . '.min' => 'Mật khẩu phải có tối thiểu 6 ký tự.',
            self::PHONE . '.digits_between' => 'Số điện thoại phải có 10 hoặc 11 số.',
            self::PHONE . '.unique' => 'Số điện thoại đã được sử dụng.',
        ];
        return Validator::make($array, [
            self::FULLNAME => 'required|max:255',
            self::PHONE => 'required|digits_between:10,11|unique:users,phone',
            self::PASSWORD => 'required|min:6',
        ], $messages);
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE USER.
    |--------------------------------------------------------------------------
    | @params $array array.
    | @return mix response
    | @Author : tantan
     */
    public function storeUser()
    {
        $input = $this->request->all();
        $validator = $this->validator($input);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }
        return $this->sendOTP($input);
        // $input['password'] = Hash::make($input['password']);
        // $this->model->create($input);
        // return redirect()->back()->with('status', true)->with('message', 'Đăng ký thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATE OPT STRING.
    |--------------------------------------------------------------------------
    | @params $phone integer
    | @return Response
    | @Author : tantan
     */
    public function validateOTP()
    {
        $codeConfirm = $this->request->get('txtCodeConfirm');
        $otp = session('OTP');
        $oldInput = session('input');

        if (trim($codeConfirm) == $otp) {
            $user = $this->model->create($oldInput);
            ////////// Khai bao event, thong bao cho cac Listener biet
            event(new UserRegister($user));
        } else {
            ///////// Deny your code
            return redirect()->back()->with('errorOTP', 1);
        }

        ///// Remove all session after validate OTP
        $this->request->session()->forget('OTP');
        $this->request->session()->forget('input');

        return redirect()->back()->with('register_success', true)->with('redirect', true);
    }

    /*
    |--------------------------------------------------------------------------
    | SEND OPT SMS.
    |--------------------------------------------------------------------------
    | @params $input array, $request in Request
    | @return mix response with Flashed Session Data
    | @Author : tantan
     */
    public function sendOTP($input)
    {
        $OTP = $this->createOTP($input['phone']);
        return redirect()->back()->with(['input' => $input, 'OTP' => $OTP, 'sendOTP' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE OPT STRING.
    |--------------------------------------------------------------------------
    | @params $phone integer
    | @return random string
    | @Author : tantan
     */
    public function createOTP($phone)
    {
        return 1234;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE OPT STRING.
    |--------------------------------------------------------------------------
    | @params 
    | @return response
    | @method POST
    | @Author : tantan
     */
    public function doLogin()
    {
        $input = $this->request->all();
        $validator = $this->loginValidator($input);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $remember = (isset($input['agree']) && $input['agree'] == 'on') ? true : false;
        if (\Auth::attempt(['phone' => $input['phone'], 'password' => $input['password']], $remember)) {
            return redirect()->route('frontend.user.edit', [\Auth::user()->id])->with('status', true)->with('message', 'Đăng nhập thành công!');
        } else {
            return redirect()->back()->with('error', true)->with('message', 'Tài khoản hoặc mật khẩu không đúng!');
        }

    }

    /*
    |--------------------------------------------------------------------------
    | CREATE OPT STRING.
    |--------------------------------------------------------------------------
    | @params 
    | @return response
    | @method POST
    | @Author : tantan
     */
    public function saveProfile()
    {
        $input = $this->request->all();
        dd($input);
    }

    /*
   |--------------------------------------------------------------------------
   | CREATE OPT STRING.
   |--------------------------------------------------------------------------
   | @params
   | @return response
   | @method POST
   | @Author : phuonglv
    */
    public function getUser($user_id)
    {
        $user_data = $this->user::where('id', '=', $user_id)->get()->toArray();
        $user_data = isset($user_data[0]) ? $user_data[0] : null;
        if ($user_data) {
            return view('frontend.users.userinfo', ['data' => $user_data]);
        }
    }

    /*
   |--------------------------------------------------------------------------
   | CREATE OPT STRING.
   |--------------------------------------------------------------------------
   | @params
   | @return response
   | @method POST
   | @Author : phuonglv
    */
    public function updateUserInfoLender($params)
    {
        //check user
        $where = array(['id', '=', $params['id']], ['phone', '=', $params['phone']]);
        $user_data = $this->user::where($where)->get()->toArray();
        $user_data = isset($user_data[0]) ? $user_data[0] : null;
        if ($user_data) {
            $id = (int)$params['id'];
            unset($params['id']);
            unset($params['phone']);
            $this->user::where('id', '=', $id)->update($params);
        }
    }
}