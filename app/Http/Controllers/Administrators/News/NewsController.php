<?php

namespace App\Http\Controllers\Administrators\News;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\News\NewsRepository;

class NewsController extends Controller {
    protected $repository;

    public function __construct(NewsRepository $repository) {
        $this->repository = $repository;
    }

    public function getOnload() {
        return $this->repository->onload();
    }

    public function store() {
        return $this->repository->store();
    }

    public function index() {
        return $this->repository->index();
    }

    public function show($id) {
        return $this->repository->show($id);
    }

    public function update($id) {
        return $this->repository->update($id);
    }

    public function destroy($id) {
        return $this->repository->destroy($id);
    }

    public function putApprove($id) {
        return $this->repository->putApprove($id);
    }

    public function getSearch() {
        return $this->repository->getSearch();
    }

    public function create() {
        return $this->repository->create();
    }

    public function edit($id) {
        return $this->repository->edit($id);
    }
}
