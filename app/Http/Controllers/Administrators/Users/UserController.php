<?php

namespace App\Http\Controllers\Administrators\Users;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\Users\UserRepository;

class UserController extends Controller {

    private $repository;

    function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->index();
    }

    public function store() {
        return $this->repository->store();
    }

    public function show($id) {
        return $this->repository->show($id);
    }

    public function update($id) {
        return $this->repository->update($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        return $this->repository->destroy($id);
    }

    public function getSearch() {
        return $this->repository->getSearch();
    }

    public function getSearchData() {
        return $this->repository->getSearchData();
    }

    public function create() {
        return $this->repository->create();
    }

    public function edit($id) {
        return $this->repository->edit($id);
    }

    public function getPurchase($id) {
        return $this->repository->getPurchase($id);
    }

    public function postPurchase() {
        return $this->repository->postPurchase();
    }

}
