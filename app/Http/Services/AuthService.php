<?php namespace App\Services;
use App\Http\Services\ActivationService;
use App\Models\Users\User;
use App\Models\Users\UserToken;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthService {

    public static $message;

    public $user;

    private $request;

    private $response;

    private $model;

    protected $activationService;

    public function __construct(Request $request, ResponseService $response, User $model, ActivationService $activationService) {
        $this->request           = $request;
        $this->response          = $response;
        $this->model             = $model;
        $this->activationService = $activationService;
    }

    public function login() {
        $data      = $this->request->all();
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($data);
        } else {
            // $user = $this->model->where('email', $this->request->input('email'))->first();
            // if (!$user) {
            //     return redirect()->back()->withInput($data)->with('error', true)->with('message', 'Không tồn tại tài khoản này!');
            // }
            // if ($user->active == 0) {
            //     $this->activationService->sendActivationMail($user);
            //     // auth()->logout();
            //     return redirect()->back()->with('error', true)->with('message', 'Bạn cần xác thực tài khoản, chúng tôi đã gửi mã xác thực vào email của bạn, hãy kiểm tra và làm theo hướng dẫn.');
            // } else {
            if (Auth::guard('admin')->attempt(['email' => $this->request->input('email'), 'password' => $this->request->input('password')])) {
                return redirect()->action('Administrators\Systems\DashboardController@index');
            } else if (Auth::guard('admin')->attempt(['username' => $this->request->input('email'), 'password' => $this->request->input('password')])) {
                return redirect()->action('Administrators\Systems\DashboardController@index');
            } else { 
                return redirect()->back()->withInput($data)->with('error', true)->with('message', 'Tài khoản hoặc mật khẩu không đúng!');
            }
            // }
        }
        return redirect()->back();
    }

    public function logout() {
        Auth::guard('admin')->logout();
        // UserToken::where('token', $token)->delete();
        return self::redirectLogin();
    }

    /**
     * [validator validator]
     * @param  array  $array [all input need validate]
     * @return
     */

    private function validator(array $array) {
        $messages = [
            'required' => ':attribute không được để trống.',
            'min'      => ':attribute ít nhất 6 ký tự.',
        ];
        return Validator::make($array, [
            'email'    => 'required',
            'password' => 'required|min:6',
        ], $messages);
    }

    public static function user() {
        // if ($user = session('user')) {
        if ($user = Auth::guard('admin')->user()) {
            return $user;
        }
        return self::redirectLogin();
    }

    public static function token() {
        if ($user = self::user()) {
            return $user->token;
        }
        return null;
    }

    public static function isLogged() {
        $currentTime = time();
        $userToken   = UserToken::where('token', self::token())
            ->where('expire', '>', $currentTime)->first();
        if (empty($userToken)) {
            return false;
        }
        $user = User::where('id', $userToken->user_id)->first();
        if (!empty($user)) {
            return true;
        }
        return false;
    }

    public static function redirectLogin() {
        return view('administrator.auth.login');
    }

}
