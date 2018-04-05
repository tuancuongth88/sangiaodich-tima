<?php namespace App\Http\Repositories\Frontends\Services;
use App\Http\Repositories\Administrators\Repository;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Validator;

class ServicesRepository extends Repository {

    function __construct(ResponseService $response, Request $request, AuthService $auth, User $user) {
        $this->model    = $user;
        $this->response = $response;
        $this->request  = $request;
        $this->auth     = $auth;
    }



}