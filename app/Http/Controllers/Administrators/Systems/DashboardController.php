<?php

namespace App\Http\Controllers\Administrators\Systems;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\Systems\DashboardRepository;

class DashboardController extends Controller {

    private $repository;

    function __construct(DashboardRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->index();
    }

    public function getSearch() {
    }
}
