<?php
namespace App\Http\Repositories\Administrators\Partner;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Partner\Partner;
use App\Models\Partner\PartnerCategory;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class PartnerRepository extends Repository {

    private $category;

    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;

    private $companyId;

    private $perpages;

    private $current;

    const PIN      = 1;
    const UNPIN    = 0;
    const ACCEPTED = 1;
    const DRAFT    = 2;
    const WAIT     = 0;
    function __construct(Partner $partner, PartnerCategory $category, ResponseService $response, Request $request, AuthService $auth, $companyId = 0, $perpages = 20, $current = 1) {
        $this->category = $category;
        $this->model    = $partner;
        $this->response = $response;
        $this->request  = $request;
        $this->auth     = $auth;
        $this->perpages = $perpages;
        $this->current  = $current;
    }

    /*
    |--------------------------------------------------------------------------
    | ONLOAD
    |--------------------------------------------------------------------------
    | @params
    | @return array[category,listUser]
    | @Author : cuongnt
     */
    public function onload() {
        return null;
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
    const ID          = 'id';
    const NAME        = 'name';
    const EMAIL       = 'email';
    const PHONE       = 'phone';
    const DETAIL      = 'detail';
    const IMAGE_URL   = 'image_url';
    const CATEGORY_ID = 'category_id';
    const CREATED_BY  = 'created_by';
    const UPDATED_BY  = 'updated_by';

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
            self::NAME,
            self::EMAIL,
            self::PHONE,
            self::DETAIL,
            self::CATEGORY_ID,
            self::IMAGE_URL
        );
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
        return $this->request->only(
            self::NAME,
            self::EMAIL,
            self::PHONE,
            self::DETAIL,
            self::CATEGORY_ID,
            self::IMAGE_URL
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return object news
    | @Author : cuongnt
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
            $data['image_url'] = '';
            if ($this->request->hasFile('image_url')) {
                $file              = $this->request->image_url;
                $destinationPath   = public_path() . IMAGEPARTNER;
                $filename          = time() . '_' . $file->getClientOriginalName();
                $uploadSuccess     = $file->move($destinationPath, $filename);
                $data['image_url'] = IMAGEPARTNER . $filename;
            }
            $data['created_by'] = $this->auth->user()->id;
            $partner            = $this->model->create($data);
            return redirect()->route('partner.index')->with('status', 'Thêm mới thành công!');
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
    | @Author : cuongnt
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
                return redirect()->route('partner.index')->with('status', false)->with('message', 'Cập nhật thất bại!');
            }
            return redirect()->route('partner.index')->with('status', true)->with('message', 'Cập nhật thành công!');
        } catch (Exception $e) {
            return $this->response->json(false, '', $this->getErrorMessage($e));
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ALL NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return object partner
    | @Author : cuongnt
     */

    public function index() {
        try {
            $orderField = ($this->request->has('field')) ? $this->request->input('field') : self::ID;
            $orderType  = ($this->request->has('type')) ? $this->request->input('type') : self::ID;
            $query      = $this->model;
            if ($this->request->has('query')) {
                $query = $this->model->search($this->request->input('query'));
            }
            $query       = $query->orderBy($orderField, ($orderType) ? 'asc' : 'desc');
            $listPartner = $query->paginate($this->perpages);
            return view('administrator.partner.index', ['data' => $listPartner]);
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL NEWS
    |--------------------------------------------------------------------------
    | @params id news
    | @return object news
    | @Author : haind
     */

    public function show($id) {
        try {
            $news = $this->model->company($this->companyId)->find($id);
            if (!empty($news)) {
                return $this->response->json(true, $news, '');
            }
            return $this->response->json(false, '', 'MESSAGE.DATA_IS_EMPTY');
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
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
                return redirect()->route('partner.index')->with('status', false)->with('message', 'Xóa thất bại!');
            }
            return redirect()->route('partner.index')->with('status', true)->with('message', 'Xóa thành công!');
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
    }

    public function create() {
        $category = $this->category->get()->toArray();
        return view('administrator.partner.create', ['category' => $category]);
    }

    public function edit($id) {
        $category = $this->category->get()->toArray();
        $data     = $this->model->find($id)->toArray();
        return view('administrator.partner.edit', ['category' => $category, 'data' => $data]);
    }

    public function getSearch() {
        $data = $this->model->search($this->request->input('query'))->get();
        if ($data->count() > 0) {
            foreach ($data as $key => $value) {
                $dataResponse[] = [
                    'id'          => $value->id,
                    'name'        => $value->name,
                    'sub_name'    => $value->phone,
                    'description' => $value->email,
                    'url'         => route('partner.edit', ['id' => $value['id']]),
                ];
            }
        }
        return view('administrator.theme.search-result', ['total' => $data->count(), 'data' => $dataResponse]);
    }
}
