<?php

namespace App\Http\Controllers\Frontends\TransactionHistory;

use App\Http\Repositories\Frontends\TransactionHistory\TransactionHistoryRepository;
use App\Http\Controllers\Controller;

class ListTransactionController extends Controller
{
    private $repository;

    public function  __construct(TransactionHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->getListTransaction();
    }
}
