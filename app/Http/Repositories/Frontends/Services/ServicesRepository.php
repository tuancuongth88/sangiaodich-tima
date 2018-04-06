<?php namespace App\Http\Repositories\Frontends\Services;
use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
// use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Validator;

class ServicesRepository extends Repository
{
	
	private $model;
    private $services;
    private $response;
    private $request;
    protected $auth;

    function __construct(ResponseService $response, Request $request, Auth $auth, Service $services) {
        $this->model    = $services;
        $this->response = $response;
        $this->request  = $request;
        $this->auth     = $auth;
    }

    // field of user table.
    const ID = 'id';

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
            self::FULLNAME
        );
    }

    /*
    |---------------------------------------
    | Get list of service to borrow
    |---------------------------------------
    | @params
    | @method GET
    | @return view
    | @author tantan
    */
    public function getList(){
    	$data = $this->model->orderBy('created_at', 'desc')->get();
    	return view('frontend.service.list')->with(compact('data'));
    }


}