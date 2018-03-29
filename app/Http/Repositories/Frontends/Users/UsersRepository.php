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
    | @Author : haind
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

    public function validator(array $array){
        $messages = [
            'required'       => 'Vui lòng nhập :attribute',
            self::FULLNAME.'.required'       => 'Vui lòng nhập họ tên',
            self::FULLNAME.'max:255'        => 'Họ tên không quá 255 ký tự.',
            self::PHONE.'.max:13'         => 'Số điện thoại không quá 11 số.',
            self::PHONE.'.unique'         => 'Số điện thoại đã được sử dụng.',
        ];
        return Validator::make($array, [
            self::FULLNAME      => 'required|max:255',
            self::PHONE         => 'required|max:13|unique:users,phone',
            self::PASSWORD      => 'required|min:6',
        ], $messages);
    }

    public function storeUser(){
        $input = $this->getInputFieldStore();
        $validator = $this->validator($input);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }
        $input['password'] = Hash::make($input['password']);
        $this->model->create($input);
        return redirect()->back()->with('status', true)->with('message', 'Đăng ký thành công!');;
    }

}