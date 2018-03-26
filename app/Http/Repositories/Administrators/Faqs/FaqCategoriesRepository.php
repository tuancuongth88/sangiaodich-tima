<?php namespace App\Http\Repositories\Administrators\Faqs;

use App\Http\Repositories\Administrators\Repository;
use App\Models\FaqCategories\FaqCategories;
use App\Models\Faqs\Faq;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class FaqCategoriesRepository extends Repository
{

    protected $request;

    protected $model;

    protected $auth;

    protected $response;

    protected $moduleName;

    protected $faq;

    const ZERO = 0;
    const ONE = 1;
    // field of branch table.
    const ID = 'id';
    const NAME = 'name';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED = 'deleted';
    const CATEGORY_FAQ_ID = 'category_faq_id';
    const CATEGORY_ID = 'category_id';

    const MODULE_NAME = 'FAQS';

    function __construct(FaqCategories $categories, AuthService $auth, ResponseService $response, Request $request, Faq $faq)
    {
        $this->model = $categories;
        $this->auth = $auth;
        $this->response = $response;
        $this->request = $request;
        $this->companyId = $this->auth->user()->company_id;
        $this->faq = $faq;
        $this->moduleName = $this->getModuleName();
    }

    /*
    |--------------------------------------------------------------------------
    | MODULE NAME
    |--------------------------------------------------------------------------
    | @params
    | @return module name. use for check permission.
    | @Author : haind
     */

    protected function getModuleName()
    {
        return self::MODULE_NAME;
    }

    protected function getSubTable()
    {
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT FIELD STORE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and store.
    | @Author : haind
     */
    protected function getInputFieldStore()
    {
        return $this->request->only(self::NAME);
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT FIELD UPDATE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and update.
    | @Author : haind
     */
    protected function getInputFieldUpdate()
    {
        return $this->request->only(self::NAME);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    | @params model
    | @return model
    | @Author : haind
     */
    protected function updateData($model)
    {
        return $model;
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK FIELD EXIST UPDATE.
    |--------------------------------------------------------------------------
    | @params
    | @return boolean
    | @Author : haind
     */
    protected function relationFieldUpdateExit()
    {
        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK FIELD EXIST DELETE.
    |--------------------------------------------------------------------------
    | @params
    | @return boolean
    | @Author : haind
     */
    protected function relationFieldDeleteExit($model)
    {
        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDATOR
    |--------------------------------------------------------------------------
    | @params array  $array [all input need validate]
    | @return
    | @Author : haind
     */
    protected function validator(array $array)
    {
        return Validator::make($array, $this->model::$rules, $this->model::$messages);
    }

    /*
    |--------------------------------------------------------------------------
    |  [DESTROY SET MODEL STATUS IS DELETED]
    |--------------------------------------------------------------------------
    | @params  [int] $id [id of model need set status is deleted]
    | @return boolean
    | @Author : haind
     */
    public function destroy($id)
    {
        $result = $this->model->where(self::ID, $id)->get();
        if (!$result) {
            return redirect()->action('Administrators\Faqs\FaqCategoriesController@index')->with('error', true)->with('message', 'Không tồn tại dữ liệu này!');
        }
        $check = $this->faq->where(self::CATEGORY_ID, $id)->count();
        if ($check > 0) {
            return redirect()->action('Administrators\Faqs\FaqCategoriesController@index')->with('error', true)->with('message', 'Vui lòng xóa tài liệu thuộc danh mục này trước!');
        }
        $destroyRelate = $this->model->where(self::ID, $id)->delete();
        return $this->redirectBackAction();
    }

    public function store()
    {
        $data = $this->getInputFieldStore();
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        $data[self::CREATED_BY] = $this->auth->user()->id;
        $obj = $this->model->create($data);
        return $this->redirectBackAction();
    }

    protected function viewOfActionIndex($data = null)
    {
        return view('administrator.faqs.categories.index', ['data' => $data]);
    }

    protected function viewOfActionCreate($data = null)
    {
        return view('administrator.faqs.categories.create', ['data' => $data]);
    }

    protected function viewOfActionShow($data = null)
    {
        return view('administrator.faqs.categories.edit', ['data' => $data]);
    }

    protected function viewOfActionEdit($data = null)
    {
        return view('administrator.faqs.categories.edit', ['data' => $data]);
    }

    protected function redirectBackAction()
    {
        return redirect()->action('Administrators\Faqs\FaqCategoriesController@index');
    }

}