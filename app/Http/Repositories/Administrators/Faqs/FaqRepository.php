<?php namespace App\Http\Repositories\Administrators\Faqs;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Faqs\Faq;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class FaqRepository extends Repository {

    private $category;

    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;

    private $companyId;

    private $perpages;

    private $current;

    private $faq;

    const PIN     = 1;
    const UNPIN   = 0;
    const APPROVE = 1;
    const DRAFT   = 2;
    const WAIT    = 0;
    const ZERO    = 0;
    const ONE     = 1;

    function __construct(Faq $faq, ResponseService $response, Request $request, AuthService $auth, User $user, $companyId = 0, $perpages = 20, $current = 1) {
        $this->model    = $faq;
        $this->user     = $user;
        $this->response = $response;
        $this->request  = $request;
        $this->auth     = $auth;
        $this->perpages = $perpages;
        $this->current  = $current;
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATOR
    |--------------------------------------------------------------------------
    | @params array[requestAll]
    | @return boolean
    | @Author : haind
     */

    public function validator(array $array) {
        return Validator::make($array, $this->model::$rules, $this->model::$messages);
    }

    // field of user table.
    const ID         = 'id';
    const QUESTION   = 'question';
    const ANSWER     = 'answer';
    const COMPANY_ID = 'company_id';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';

    /*
    |--------------------------------------------------------------------------
    | INPUT FIELD STORE
    |--------------------------------------------------------------------------
    | @params
    | @return field before validator and store.
    | @Author : haind
     */
    protected function getInputFieldStore() {
        return $this->request->only(
            self::QUESTION,
            self::ANSWER
        );
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
        return $this->request->only(
            self::QUESTION,
            self::ANSWER
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return object news
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
            $obj = $this->model->create($data);
            if ($obj) {
                return redirect()->action('Administrators\Faqs\FaqController@index')->with('status', true)->with('message', 'Thêm mới thành công!');
            }
            return redirect()->back()->withInput($data)->with('error', true)->with('message', 'Thêm mới thất bại!');
        } catch (\Exception $e) {
            return $this->response->json(false, '', $this->getErrorMessages($e));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE NEWS
    |--------------------------------------------------------------------------
    | @params id news
    | @return object news
    | @Author : haind
     */

    public function update($id) {
        try {
            $data = $this->model->find($id);
            if ($data == NULL) {
                return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
            }
            $input = $this->getInputFieldUpdate();
            foreach ($input as $key => $value) {
                $data->$key = $value;
            }
            $data      = $data->toArray();
            $validator = $this->validator($data);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput($data);
            }
            $data['image_url'] = '';
            if ($this->request->hasFile('image_url')) {
                $file              = $this->request->image_url;
                $destinationPath   = public_path() . IMAGENEWS;
                $filename          = time() . '_' . $file->getClientOriginalName();
                $uploadSuccess     = $file->move($destinationPath, $filename);
                $data['image_url'] = IMAGENEWS . $filename;
            }
            $data[self::UPDATED_BY] = $this->auth->user()->id;
            $obj                    = $this->model->find($id)->update($data);
            if (!$obj) {
                return redirect()->action('Administrators\Faqs\FaqController@index')->with('error', true)->with('message', 'Cập nhật thất bại!');
            }
            return redirect()->action('Administrators\Faqs\FaqController@index')->with('status', true)->with('message', 'Cập nhật thành công!');
        } catch (Exception $e) {
            return $this->response->json(false, '', $this->getErrorMessage($e));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ALL NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return object news
    | @Author : haind
     */

    public function index() {
        $orderField = ($this->request->has('field')) ? $this->request->input('field') : self::ID;
        $orderType  = ($this->request->has('type')) ? $this->request->input('type') : self::ID;
        $query      = $this->model->orderBy($orderField, ($orderType) ? 'asc' : 'desc');
        if ($this->request->has('query')) {
            $query = $query
                ->search($this->request->input('search'))
                ->orderBy('created_at', 'DESC');
        }
        $listData = $query->paginate($this->perpages);
        return view('administrator.faqs.faqs.index', ['data' => $listData]);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE NEWS
    |--------------------------------------------------------------------------
    | @params id news
    | @return BOOLEAN
    | @Author : haind
     */

    public function destroy($id) {
        try {
            $obj = $this->model->find($id);
            $obj->delete();
            if (!$obj) {
                return redirect()->action('Administrators\Faqs\FaqController@index')->with('error', true)->with('message', 'Xóa thất bại!');
            }
            return redirect()->action('Administrators\Faqs\FaqController@index')->with('status', true)->with('message', 'Xóa thành công!');
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
    }

    public function create() {
        return view('administrator.faqs.faqs.create');
    }

    public function edit($id) {
        $data = $this->model->find($id)->toArray();
        return view('administrator.faqs.edit', ['data' => $data]);
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH PROJECT
    |--------------------------------------------------------------------------
    | @params
    | @return {array}
    | @Author : haind
     */

    public function getSearch() {
        if ($this->request->has('query')) {
            $objModel = $this->model
                ->search($this->request->input('search'))
                ->orderBy('created_at', 'DESC');
            $total = $objModel->count();
            $data  = $objModel->get()->toArray();
            if ($total > 0) {
                foreach ($data as $key => $value) {
                    $dataResponse[] = [
                        'id'          => $value[self::ID],
                        'name'        => $value[self::QUESTION],
                        'sub_name'    => '',
                        'description' => '',
                        'url'         => route('user.edit', ['id' => $value['id']]),
                    ];
                }
            }
            return view('administrator.theme.search-result', ['total' => $total, 'data' => $dataResponse]);
        }

    }

}
