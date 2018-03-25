<?php namespace App\Http\Repositories\Administrators\News;

use App\Http\Repositories\Administrators\BaseRepository;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\News\NewsCategoryUser;
use App\Models\Users\UserType;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class NewsCategoryRepository extends BaseRepository {

    protected $request;

    protected $model;

    protected $auth;

    protected $response;

    protected $moduleName;

    protected $categoryUser;

    protected $news;

    const ZERO = 0;
    const ONE  = 1;
    // field of branch table.
    const ID               = 'id';
    const NAME             = 'name';
    const CRETED_BY        = 'created_by';
    const UPDATED_BY       = 'updated_by';
    const DELETED          = 'deleted';
    const CATEGORY_NEWS_ID = 'category_news_id';
    const CATEGORY_ID      = 'category_id';

    const MODULE_NAME = 'NEWS';

    function __construct(NewsCategory $category, AuthService $auth, ResponseService $response, Request $request, NewsCategoryUser $categoryUser, News $news) {
        $this->model        = $category;
        $this->categoryUser = $categoryUser;
        $this->auth         = $auth;
        $this->response     = $response;
        $this->request      = $request;
        $this->companyId    = $this->auth->user()->company_id;
        $this->news         = $news;
        $this->moduleName   = $this->getModuleName();
    }

    /*
    |--------------------------------------------------------------------------
    | MODULE NAME
    |--------------------------------------------------------------------------
    | @params
    | @return module name. use for check permission.
    | @Author : haind
     */

    protected function getModuleName() {
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
    protected function getInputFieldStore() {
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
    protected function getInputFieldUpdate() {
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
    protected function updateData($model) {
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
    protected function relationFieldUpdateExit() {
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
    protected function relationFieldDeleteExit($model) {
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
    protected function validator(array $array) {
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
    public function destroy($id) {
        $result = $this->model->where(self::ID, $id)->get();
        if (!$result) {
            return redirect()->action('Administrators\News\NewsCategoryController@index')->with('error', true)->with('message', 'Không tồn tại dữ liệu này!');
        }
        $check = $this->news->where(self::CATEGORY_ID, $id)->count();
        if ($check > 0) {
            return redirect()->action('Administrators\News\NewsCategoryController@index')->with('error', true)->with('message', 'Vui lòng xóa tài liệu thuộc danh mục này trước!');
        }
        $destroyRelate = $this->categoryUser->where(self::CATEGORY_NEWS_ID, $id)->delete();
        return $this->redirectBackAction();
    }

    public function store() {
        $data      = $this->getInputFieldStore();
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        $data[self::CREATED_BY] = $this->auth->user()->id;
        $obj                    = $this->model->create($data);
        return $this->redirectBackAction();
    }

    protected function viewOfActionIndex($data = null) {
        return view('administrator.news.category.index', ['data' => $data]);
    }
    protected function viewOfActionCreate($data = null) {
        return view('administrator.news.category.create', ['data' => $data]);
    }
    protected function viewOfActionShow($data = null) {
        return view('administrator.news.category.detail', ['data' => $data]);
    }
    protected function viewOfActionEdit($data = null) {
        return view('administrator.news.category.edit', ['data' => $data]);
    }

    protected function redirectBackAction() {
        return redirect()->action('Administrators\News\NewsCategoryController@index');
    }

}