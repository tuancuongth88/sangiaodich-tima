<?php namespace App\Http\Repositories\Frontends\Faqs;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Faqs\Faq;
use App\Models\Faqs\FaqCategories;
use App\Models\Services\Service;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class FaqCategoriesRepository extends Repository {

    protected $request;

    protected $model;

    protected $auth;

    protected $response;

    protected $moduleName;

    protected $faq;

    const ZERO = 0;
    const ONE  = 1;
    // field of branch table.
    const ID              = 'id';
    const NAME            = 'name';
    const CREATED_BY      = 'created_by';
    const UPDATED_BY      = 'updated_by';
    const DELETED         = 'deleted';
    const CATEGORY_FAQ_ID = 'category_faq_id';
    const CATEGORY_ID     = 'category_id';

    const MODULE_NAME = 'FAQS';

    function __construct(FaqCategories $categories, AuthService $auth, ResponseService $response, Request $request, Faq $faq) {
        $this->model     = $categories;
        $this->auth      = $auth;
        $this->response  = $response;
        $this->request   = $request;
        $this->companyId = $this->auth->user()->company_id;
        $this->faq       = $faq;
    }

    public function getQuestion() {
        //1 = hoi dap
        $listData = $this->model
            ->where('type', 1)
        // ->orderBy(self::ID, 'desc')
            ->with('faqs')
            ->get();
        $listService = Service::all();
        $data = null;
        if (!$listData->isEmpty()) {
            foreach ($listData as $key => $value) {
                $data[$key]       = new \stdClass();
                $data[$key]       = $value;
                $data[$key]->list = $this->faq->where('category_id', $value->id)->get();
            }
        }
        return view('frontend.faqs.list', ['data' => $data, 'list_service' => $listService]);
    }
}