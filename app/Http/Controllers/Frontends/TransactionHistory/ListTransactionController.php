<?php

namespace App\Http\Controllers\Frontends\TransactionHistory;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontends\TransactionHistory\TransactionHistoryRepository;

class ListTransactionController extends Controller {
    private $repository;

    public function __construct(TransactionHistoryRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->getListTransaction();
    }

    public function getTable() {
        return $this->repository->getTable();
    }
}
