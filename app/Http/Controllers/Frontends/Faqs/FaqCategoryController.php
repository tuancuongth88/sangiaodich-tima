<?php

namespace App\Http\Controllers\Frontends\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontends\Faqs\FaqCategoriesRepository;

class FaqCategoryController extends Controller {
    protected $repository;

    public function __construct(FaqCategoriesRepository $repository) {
        $this->repository = $repository;
    }

    public function getQuestion() {
        return $this->repository->getQuestion();
    }

}
