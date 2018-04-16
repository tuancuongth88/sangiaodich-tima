<?php

namespace App\Http\Controllers\Frontends\AboutUs;

use App\Http\Repositories\Frontends\AboutUs\AboutUsRepository;
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
        return $this->repository->index();
    }
}
