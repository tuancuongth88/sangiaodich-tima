<?php namespace App\Http\Repositories\Administrators;

use App\Http\Repositories\Administrators\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use \App\models\Users\User;

abstract class BaseRepository extends Repository {

    protected $request;

    protected $model;

    protected $auth;

    protected $response;

    protected $company_id;

    protected $moduleName;

    const ZERO       = 0;
    const ONE        = 1;
    const NAME       = 'name';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED    = 'deleted';

    const PERMISSION_STORE   = 'create';
    const PERMISSION_READ    = 'read';
    const PERMISSION_DELETED = 'delete';
    const PERMISSION_UPDATE  = 'edit';
    // const MODULE_NAME         = 'SYSTEMS';

    function __construct(AuthService $auth, ResponseService $response, Request $request) {
        $this->auth       = $auth;
        $this->response   = $response;
        $this->request    = $request;
        $this->moduleName = $this->getModuleName();
    }

    /*
    |--------------------------------------------------------------------------
    |  RETURN MODULE NAME. USE FOR CHECK PERMISSION.
    |--------------------------------------------------------------------------
    | @params
    | @return array
    | @Author : haind
     */
    abstract protected function getModuleName();

    /*
    |--------------------------------------------------------------------------
    |  RETURN FIELD BEFORE VALIDATOR AND STORE.
    |--------------------------------------------------------------------------
    | @params
    | @return array
    | @Author : haind
     */
    abstract protected function getInputFieldStore();

    /*
    |--------------------------------------------------------------------------
    |  RETURN FIELD BEFORE VALIDATOR AND UPDATE.
    |--------------------------------------------------------------------------
    | @params
    | @return array
    | @Author : haind
     */
    abstract protected function getInputFieldUpdate();

    /*
    |--------------------------------------------------------------------------
    |  RETURN FIELD BEFORE UPDATE.
    |--------------------------------------------------------------------------
    | @params model
    | @return model
    | @Author : haind
     */
    abstract protected function updateData($model);

    /*
    |--------------------------------------------------------------------------
    |  CHECK FIELD EXIT UPDATE.
    |--------------------------------------------------------------------------
    | @params
    | @return boolean
    | @Author : haind
     */
    abstract protected function relationFieldUpdateExit();

    /*
    |--------------------------------------------------------------------------
    |  CHECK FIELD EXIT DELETE.
    |--------------------------------------------------------------------------
    | @params this collection $model.
    | @return boolean
    | @Author : haind
     */
    abstract protected function relationFieldDeleteExit($model);

    /*
    |--------------------------------------------------------------------------
    |  SUB TABLE RESULT.
    |--------------------------------------------------------------------------
    | @params collection
    | @return array
    | @Author : haind
     */
    abstract protected function getSubTable();

    /*
    |--------------------------------------------------------------------------
    |  VALIDATOR
    |--------------------------------------------------------------------------
    | @params array  $array [all input need validate]
    | @return
    | @Author : haind
     */
    abstract protected function validator(array $array);

    /*
    |--------------------------------------------------------------------------
    |  [INDEX LIST ALL MODEL]
    |--------------------------------------------------------------------------
    | @params
    | @return [array] [$models]
    | @Author : haind
     */

    abstract protected function viewOfActionIndex();
    abstract protected function viewOfActionCreate();
    abstract protected function viewOfActionEdit();
    abstract protected function viewOfActionShow();

    /**
     * return redirect back action
     */
    abstract protected function redirectBackAction();

    protected function returnError($e) {
        die($e->getMessage());
    }

    public function index() {
        $objModel = $this->model;
        if ($this->request->has('query')) {
            $objModel = $objModel
                ->search($this->request->input('query'));
        }
        $data = $objModel->orderBy('id', 'asc')->paginate(10);
        // sub table.
        // $data = $this->getSubTable($data);

        return $this->viewOfActionIndex($data);
    }

    /*
    |--------------------------------------------------------------------------
    |  [STORE NEW MODEL TO DB]
    |--------------------------------------------------------------------------
    | @params
    | @return [object] [$model]
    | @Author : haind
     */
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
            // $data[self::COMPANY_ID] = $this->companyId;
            $result = $this->model->create($data);
        } catch (\Exception $e) {
            return $this->response->json(false, '', $this->getErrorMessages($e));
        }
        return $this->redirectBackAction();
    }

    /*
    |--------------------------------------------------------------------------
    |  [UPDATE ONCE MODEL]
    |--------------------------------------------------------------------------
    | @params [int] $id [id of model need update]
    | @return [object] [$model]
    | @Author : haind
     */
    public function update($id) {
        try {
            $input     = $this->getInputFieldUpdate();
            $validator = $this->validator($input);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput($input);
            }
            // $input[self::UPDATED_BY] = Auth::admin()->get()->id;
            $result = $this->model->where(self::ID, $id)->update($input);
            if (!$result) {
                dd('Error');
            }
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
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
        try {
            $result = $this->model->where(self::ID, $id)->delete();
            if (!$result) {
                dd('Error');
            }
        } catch (Exception $e) {
            return $this->returnError($e);
        }

        return $this->redirectBackAction();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return $this->viewOfActionCreate();
    }

    public function edit($id) {
        $data['obj']       = $this->model->find($id);
        $data['sub_table'] = $this->getSubTable();
        return $this->viewOfActionEdit($data);
    }

}
