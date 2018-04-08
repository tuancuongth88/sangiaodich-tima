<?php namespace App\Http\Controllers\Frontends\Users;

use Illuminate\Http\Request;
use App\Http\Repositories\Frontends\Users\UsersRepository;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegister;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $repository;

    public function __construct(UsersRepository $repository, Request $request) {
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * Get register form
     */
    public function getRegisterForm(){
        // If OTP has been sent, we keep session live 1 time.
        if( session('sendOTP') ){
            $this->request->session()->keep(['input', 'OTP']);
            $this->request->session()->flash('sendOTP', false);
        }
        $array = ['test' => 'test22'];
    	return view('frontend.users.register');
    }

    /**
     * Process request from register form
     */
    public function postRegisterForm(Request $request){
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
    public function validateOTP(Request $request){
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
    public function getloginForm(){
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
    public function postloginForm(){
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
    public function getProfileForm(){
        return $this->repository->getProfile();
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
    public function postProfileForm(){
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
    public function logout(){
        Auth::logout();
        return redirect()->route('frontend.user.login')->with('status', true)->with('message', 'Bạn đã đăng xuất khỏi hệ thống. Xin chào và hẹn gặp lại!');
    }

}
