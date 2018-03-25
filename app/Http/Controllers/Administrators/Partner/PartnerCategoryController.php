<?php

namespace App\Http\Controllers\Administrators\Partner;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\Partner\PartnerCategoryRepository;

class PartnerCategoryController extends Controller {
    protected $repository;
    public function __construct(PartnerCategoryRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->repository->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->repository->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
        return $this->repository->store();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner\PartnerCategory  $partnerCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return $this->repository->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        return $this->repository->update($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner\PartnerCategory  $partnerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        return $this->repository->destroy($id);
    }

    public function getSearch() {
        return $this->repository->getSearch();
    }
}
