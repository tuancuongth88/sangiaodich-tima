<?php

namespace App\Http\Controllers\Administrators\ImportData;

use App\DataTax;
use App\Http\Repositories\Administrators\ImportData\DataTaxRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTaxController extends Controller
{
    protected $repository;
    public function __construct(DataTaxRepository $repository) {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function doUpload(){
        return $this->repository->importFile();
    }

    public function personalUpload(){
        return $this->repository->personalUpload();
    }

    public function doUploadPersenal(){
        return $this->repository->doUploadPersenal();
    }
}
