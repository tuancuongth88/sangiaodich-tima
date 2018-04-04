<?php

namespace App\Http\Controllers\Administrators\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\Services\ServiceRepository;

class ServiceController extends Controller
{
    protected $repository;
    public function __construct(ServiceRepository $repository){
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->index();
    }

    public function edit($id){
        return $this->repository->edit($id);
    }

    public function update($id){
        return $this->repository->update($id);
    }

    public function create(){
        return $this->repository->create();
    }

    public function store(){
        return $this->repository->store();
    }

    public function destroy($id){
        return $this->repository->destroy($id);
    }
}
