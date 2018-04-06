<?php

namespace App\Http\Controllers\Frontends\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontends\Services\ServicesRepository;
use App\Models\TransactionHistory\TransactionHistory;

class ServicesController extends Controller
{
	private $repository;

    public function __construct(ServicesRepository $repository, Request $request) {
        $this->repository = $repository;
        $this->request = $request;
    }

    /*
    |---------------------------------------
    | Get list all service for user
    |---------------------------------------
    | @params
    | @return responsive
    | @author tantan
    */
    public function index(){
    	return $this->repository->getList();
    }
}
