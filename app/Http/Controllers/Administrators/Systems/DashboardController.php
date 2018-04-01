<?php

namespace App\Http\Controllers\Administrators\Systems;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\Systems\DashboardRepository;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller {

    private $repository;

    function __construct(DashboardRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->index();
    }

    public function getSearch() {
    }

    /*
    |--------------------------------------------------------------------------
    | GET LOCATION NESTED LIST.
    |--------------------------------------------------------------------------
    | @params
    | @return Response
    | @Author : tantan
     */
    public function getLocation() {
    	return $this->repository->getLocation();
    }

    /*
    |--------------------------------------------------------------------------
    | GET LOCATION NESTED LIST.
    |--------------------------------------------------------------------------
    | @params
    | @method POST
    | @return Response
    | @Author : tantan
     */
    public function postLocation() {
    	return $this->repository->postLocation();
    }
}
