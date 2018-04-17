<?php

namespace App\Http\Controllers\Administrators\AboutUs;

use App\Http\Repositories\Administrators\AboutUs\AboutUsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    private $repository;

    function __construct(AboutUsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->edit();
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
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        return $this->repository->update($id);
    }

    public function edit()
    {
        return $this->repository->edit();
    }

}
