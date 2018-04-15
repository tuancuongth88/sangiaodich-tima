<?php

namespace App\Http\Controllers\Administrators\TransactionHistory;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Administrators\TransactionHistory\TransactionHistoryRepository;

class TransactionHistoryController extends Controller
{
    private $repository;

    function __construct(TransactionHistoryRepository $repository) {
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->index();
    }

    /**
     * @see approve transaction
     * @param $id
     */
    public function approve($id){
        return $this->repository->approve($id);
    }

    /**
     * @see reject transaction
     * @param $id
     */
    public function reject($id){
        return $this->repository->reject($id);
    }
}
