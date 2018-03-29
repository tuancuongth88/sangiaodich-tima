<?php

namespace App\Http\Controllers\Administrators\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\Faqs\FaqCategoriesRepository;

class FaqCategoriesController extends Controller
{
    private $repository;

    function __construct(FaqCategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        return $this->repository->store();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        return $this->repository->update($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    public function create()
    {
        return $this->repository->create();
    }

    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    public function getSearch()
    {
        return $this->repository->getSearch();
    }
}
