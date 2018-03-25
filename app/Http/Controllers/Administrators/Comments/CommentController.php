<?php

namespace App\Http\Controllers\Administrators\Comments;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\Comments\CommentRepository;

class CommentController extends Controller {
    private $repository;

    function __construct(CommentRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->index();
    }
    public function approve() {

    }

    public function destroy($id) {

    }
}
