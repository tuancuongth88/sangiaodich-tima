<?php namespace App\Http\Repositories\Frontends\Users;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\Administrators\Repository;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Validator;

class UsersRepository extends Repository {

    function __construct(ResponseService $response, Request $request, AuthService $auth, User $user, $companyId = 0, $perpages = 2, $current = 1) {
        $this->model    = $user;
        $this->response = $response;
        $this->request  = $request;
        $this->auth     = $auth;
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
    | INPUT FIELD STORE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and store.
    | @Author : tantan
     */
    protected function getInputFieldStore()
    {
        return $this->request->only(
            self::FULLNAME,
            self::PHONE,
            self::USERNAME,
            self::EMAIL,
            self::PASSWORD,
            self::TYPE
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
            self::FULLNAME.'.required'       => 'Vui lòng nhập họ tên',
            self::FULLNAME.'.max'         => 'Họ tên không quá 255 ký tự.',
            self::PASSWORD.'.min'         => 'Mật khẩu phải có tối thiểu 6 ký tự.',
            self::PHONE.'.digits_between' => 'Số điện thoại phải có 10 hoặc 11 số.',
            self::PHONE.'.unique'         => 'Số điện thoại đã được sử dụng.',
        ];
        return Validator::make($array, [
            self::FULLNAME      => 'required|max:255',
            self::PHONE         => 'required|digits_between:10,11|unique:users,phone',
            self::PASSWORD      => 'required|min:6',
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
    public function storeUser(){
        $input = $this->getInputFieldStore();
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
    public function validateOTP(){
        $codeConfirm = $this->request->get('txtCodeConfirm');
        $otp = session('OTP');
        $oldInput = session('input');

        if( $codeConfirm == $otp ){
            ///////// Accept your code, save new user to database
            $oldInput['password'] = Hash::make($oldInput['password']);
            $this->model->create($oldInput);
        } else{
            ///////// Deny your code
            return redirect()->back()->with('errorOTP', 1);
        }

        ///// Remove all session after validate OTP
        $this->request->session()->forget('OTP');
        $this->request->session()->forget('input');
        $this->request->session()->flush();

        return redirect()->back()->with('register_success', true);
    }

    /*
    |--------------------------------------------------------------------------
    | SEND OPT SMS.
    |--------------------------------------------------------------------------
    | @params $input array, $request in Request
    | @return mix response with Flashed Session Data
    | @Author : tantan
     */
    public function sendOTP($input){
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
    public function createOTP($phone){
        return 1234;
    }


}