<?php namespace App\Http\Controllers\Frontends\Users;

use Illuminate\Http\Request;
use App\Http\Repositories\Frontends\Users\UsersRepository;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegister;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $repository;

    public function __construct(UsersRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * Get register form
     */
    public function getRegisterForm()
    {
        // If OTP has been sent, we keep session live 1 time.
        if (session('sendOTP')) {
            $this->request->session()->keep(['input', 'OTP']);
            $this->request->session()->flash('sendOTP', false);
        }

        return view('frontend.users.register');
    }

    /**
     * Process request from register form
     */
    public function postRegisterForm(Request $request)
    {
        return $this->repository->storeUser();
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATE SUBMIT ACTIVE OTP CODE.
    |--------------------------------------------------------------------------
    | @params $phone integer
    | @return Response
    | @Author : tantan
     */
    public function validateOTP(Request $request)
    {
        return $this->repository->validateOTP();
    }

    /*
    |--------------------------------------------------------------------------
    | GET LOGIN FORM.
    |--------------------------------------------------------------------------
    | @params 
    | @return Response
    | @method GET
    | @Author : tantan
     */
    public function getloginForm()
    {
        return view('frontend.users.login');
    }

    /*
    |--------------------------------------------------------------------------
    | POST LOGIN FORM.
    |--------------------------------------------------------------------------
    | @params 
    | @return Response
    | @method POST
    | @Author : tantan
     */
    public function postloginForm()
    {
        return $this->repository->doLogin();
    }

    /*
    |--------------------------------------------------------------------------
    | GET PROFILE FORM.
    |--------------------------------------------------------------------------
    | @params 
    | @return Response
    | @method GET
    | @Author : tantan
     */
    public function getProfileForm()
    {
        return view('frontend.users.profile');
    }

    /*
    |--------------------------------------------------------------------------
    | POST LOGIN FORM.
    |--------------------------------------------------------------------------
    | @params 
    | @return Response
    | @method POST
    | @Author : tantan
     */
    public function postProfileForm()
    {
        return $this->repository->saveProfile();
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT.
    |--------------------------------------------------------------------------
    | @params 
    | @return Response
    | @method GET
    | @Author : tantan
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.user.login')
            ->with('status', true)->with('message', 'Bạn đã đăng xuất khỏi hệ thống. Xin chào và hẹn gặp lại!');
    }

    /*
       |--------------------------------------------------------------------------
       | User InFo.
       |--------------------------------------------------------------------------
       | @params
       | @return Response
       | @method GET
       | @Author : phuonglv
     */
    public function getUserInFoForm($user_id)
    {
        return $this->repository->getUser($user_id);
    }

    /*
   |--------------------------------------------------------------------------
   | User InFo.
   |--------------------------------------------------------------------------
   | @params
   | @return Response
   | @method Post
   | @Author : phuonglv
 */
    public function updateUserInfoLender()
    {
        $params = $this->request->all();
        return $this->repository->updateUserInfoLender($params);
    }
}
