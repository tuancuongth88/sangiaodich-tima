<?php namespace App\Http\Repositories\Administrators\Systems;

use App\Http\Repositories\Administrators\Repository;
use App\Http\Requests;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class DashboardRepository extends Repository {

    protected $request;

    protected $model;

    protected $response;

    const ZERO = 0;
    // field of branch table.
    const ID         = 'id';
    const NAME       = 'name';
    const CRETED_BY  = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED    = 'deleted';
    const COMPANY_ID = 'company_id';

    function __construct(AuthService $auth, ResponseService $response, Request $request) {
        $this->auth     = $auth;
        $this->response = $response;
        $this->request  = $request;
    }

    public function index() {
        return view('administrator.dashboard');
    }

}
