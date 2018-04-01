<?php

namespace App\Http\Controllers\Frontends\TransactionHistory;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Frontends\TransactionHistory\TransactionHistoryRepository;

class TransactionHistoryController extends Controller
{

    private $repository;

    function __construct(TransactionHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function getTranByProduct()
    {
        return $this->repository->getTranByProduct();
    }
}
