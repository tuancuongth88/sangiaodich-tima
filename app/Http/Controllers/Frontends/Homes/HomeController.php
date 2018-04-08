<?php

namespace App\Http\Controllers\Frontends\Homes;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontends\Homes\HomesRepository;

class HomeController extends Controller
{
    protected $repository;
    public function __construct(HomesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->index();
    }

}
