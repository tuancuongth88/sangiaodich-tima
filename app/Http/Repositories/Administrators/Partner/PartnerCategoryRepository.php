<?php
namespace App\Http\Repositories\Administrators\Partner;

use App\Http\Repositories\Administrators\BaseRepository;
use App\Http\Requests\Partner\PartnerCategoryRequest;
use App\Models\Partner\Partner;
use App\Models\Partner\PartnerCategory;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class PartnerCategoryRepository extends BaseRepository {

    protected $partner;
    protected $request;

    protected $model;

    protected $auth;

    protected $response;

    protected $moduleName;

    protected $categoryUser;

    const ZERO = 0;
    const ONE  = 1;
    // field of branch table.
    const ID         = 'id';
    const NAME       = 'name';
    const CRETED_BY  = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED    = 'deleted';

    function __construct(PartnerCategory $category, Partner $partner, AuthService $auth, ResponseService $response, Request $partnerCategory) {
        $this->partner  = $partner;
        $this->model    = $category;
        $this->auth     = $auth;
        $this->response = $response;
        $this->request  = $partnerCategory;
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT FIELD STORE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and store.
    | @Author : cuongnt
     */
    protected function getInputFieldStore() {
        return $this->request->only(self::NAME);
    }

    /*
    |--------------------------------------------------------------------------
    | MODULE NAME
    |--------------------------------------------------------------------------
    | @params
    | @return module name. use for check permission.
    | @Author : cuongnt
     */
    protected function getModuleName() {
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT FIELD UPDATE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and update.
    | @Author : cuongnt
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
    | @Author : cuongnt
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
    | @Author : cuongnt
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
    | @Author : cuongnt
     */
    protected function relationFieldDeleteExit($model) {
        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | FIELD BEFORE UPDATE.
    |--------------------------------------------------------------------------
    | @params collection
    | @return boolean
    | @Author : cuongnt
     */
    protected function getSubTable() {
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATOR
    |--------------------------------------------------------------------------
    | @params array  $array [all input need validate]
    | @return
    | @Author : cuongnt
     */
    protected function validator(array $array) {
        return Validator::make($array, $this->model::$rules, $this->model::$messages);
    }

    public function index() {
        $query = $this->model;
        if ($this->request->has('query')) {
            $query = $query->search($this->request->input('query'));
        }
        $data = $query->orderBy('id', 'asc')->paginate(10);
        // sub table.
        // $data = $this->getSubTable($data);

        return $this->viewOfActionIndex($data);
    }

    /*
    |--------------------------------------------------------------------------
    |  [DESTROY SET MODEL STATUS IS DELETED]
    |--------------------------------------------------------------------------
    | @params  [int] $id [id of model need set status is deleted]
    | @return boolean
    | @Author : cuongnt
     */
    public function destroy($id) {
        try {
            // check model exit.
            $model = $this->model->where('id', $id)->first();
            if (!$model) {
                return $this->response->json(false, '', 'MESSAGE.RECORD_NOT_FOUND');
            }
            $model->delete();
            $model->partner()->delete();
        } catch (Exception $e) {
            return redirect()->action('Administrators\Partner\PartnerCategoryController@index', $this->getErrorMessages($e));
        }
        return redirect()->route('partner-category.index');
    }

    public function store() {
        try {
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
        } catch (\Exception $e) {
            return redirect()->action('Administrators\Partner\PartnerCategoryController@add', $this->getErrorMessages($e));
        }
        return $this->redirectBackAction();
    }

    public function update($id) {
        try {
            $data      = $this->getInputFieldUpdate();
            $validator = $this->validator($data);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($data);
            }
            $data[self::UPDATED_BY] = $this->auth->user()->id;
            $result                 = $this->model->where(self::ID, $id)->update($data);
        } catch (\Exception $e) {
            return redirect()->action('Administrators\Partner\PartnerCategoryController@edit', $this->getErrorMessages($e));
        }
        return $this->redirectBackAction();
    }

    protected function viewOfActionIndex($data = null) {
        return view('administrator.partner.category.index', ['data' => $data]);
    }
    protected function viewOfActionCreate($data = null) {
        return view('administrator.partner.category.create', ['data' => $data]);
    }
    protected function viewOfActionShow($data = null) {
        return view('administrator.partner.category.detail', ['data' => $data]);
    }
    protected function viewOfActionEdit($data = null) {
        return view('administrator.partner.category.edit', ['data' => $data['obj']]);
    }

    protected function redirectBackAction() {
        return redirect()->action('Administrators\Partner\PartnerCategoryController@index');
    }

    public function getSearch() {
        $data = $this->model->search($this->request->input('query'))->get();
        if ($data->count() > 0) {
            foreach ($data as $key => $value) {
                $dataResponse[] = [
                    'id'          => $value->id,
                    'name'        => $value->name,
                    'sub_name'    => '',
                    'description' => '',
                    'url'         => route('partner-category.edit', ['id' => $value['id']]),
                ];
            }
        }
        return view('administrator.theme.search-result', ['total' => $data->count(), 'data' => $dataResponse]);
    }

}