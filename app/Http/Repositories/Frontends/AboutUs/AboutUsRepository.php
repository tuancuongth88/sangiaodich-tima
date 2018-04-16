<?php namespace App\Http\Repositories\Frontends\AboutUs;

use App\Http\Repositories\Administrators\Repository;

use App\Models\AboutUs\AboutUs;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class AboutUsRepository extends Repository
{

    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;


    function __construct(
        AboutUs $aboutus,
        ResponseService $response,
        Request $request,
        AuthService $auth,
        User $user
    )
    {
        $this->model = $aboutus;
        $this->user = $user;
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
    }


    /*
    |--------------------------------------------------------------------------
    | Display about us
    |--------------------------------------------------------------------------
    | @params
    | @return object news
    | @Author : phuonglv
     */
    public function index()
    {
        $data = $this->model::all()->toArray();
        if (isset($data[0])) {
            $data = $data[0];
        }
        return view('frontend.aboutus.index', ['data' => $data]);
    }

}
