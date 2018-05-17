<?php

namespace App\Http\Controllers\Frontends\ImportData;

use App\Http\Repositories\Frontends\ImportData\DataTaxRepository;
use App\Http\Controllers\Controller;

class DataTaxController extends Controller
{
    protected $repository;
    public function __construct(DataTaxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->index();
    }

    public function canhan(){
        return $this->repository->canhan();
    }

}
