<?php namespace App\Http\Controllers\Frontends\Users;

use Illuminate\Http\Request;
use App\Http\Repositories\Frontends\Users\UsersRepository;
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
}
