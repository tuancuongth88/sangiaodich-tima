<?php

namespace App\Http\Controllers\Frontends\News;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontends\News\NewsRepository;

class NewsController extends Controller {
    protected $repository;

    public function __construct(NewsRepository $repository) {
        $this->repository = $repository;
    }

    public function getNewsByCategory($id) {
        return $this->repository->getNewsByCategory($id);
    }

    public function getDetail($slug) {
        return $this->repository->getDetail($slug);
    }

    public function getViewMore() {
        return $this->repository->getViewMore();
    }
}
