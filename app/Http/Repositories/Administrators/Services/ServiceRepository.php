<?php
namespace App\Http\Repositories\Administrators\Services;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class ServiceRepository extends Repository {

    private $model;

    private $request;

    private $response;

    private $perpages;

    private $current;

    function __construct(Service $service, Request $request, ResponseService $response,  $perpages = 20, $current = 1) {
        $this->model    = $service;
        $this->request  = $request;
        $this->response = $response;
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
    const ID          = 'id';
    const NAME        = 'service_name';
    const ICON_URL    = 'icon_url';
    const IMAGE_URL   = 'image_url';
    const DAY_DETAIL   = 'day_detail';
    const AMOUNT_DETAIL   = 'amount_detail';

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
            self::ICON_URL,
            self::DAY_DETAIL,
            self::AMOUNT_DETAIL,
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
            self::ICON_URL,
            self::IMAGE_URL,
            self::DAY_DETAIL,
            self::AMOUNT_DETAIL
        );
    }

    public function index() {
        try {
            $orderField = ($this->request->has('field')) ? $this->request->input('field') : self::ID;
            $orderType  = ($this->request->has('type')) ? $this->request->input('type') : self::ID;
            $query      = $this->model;
            $query       = $query->orderBy($orderField, ($orderType) ? 'desc' : 'asc');
            $listService = $query->paginate($this->perpages);
            return view('administrator.services.index', ['data' => $listService]);
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
    }

    public function create() {
        return view('administrator.services.create');
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
            if ($this->request->hasFile('image_url')) {
                $file              = $this->request->image_url;
                $destinationPath   = public_path() . IMAGESERVICE;
                $filename          = time() . '_' . $file->getClientOriginalName();
                $uploadSuccess     = $file->move($destinationPath, $filename);
                $data['image_url'] = IMAGESERVICE . $filename;
            }
            if ($this->request->hasFile('icon_url')) {
                $file              = $this->request->icon_url;
                $destinationPath   = public_path() . IMAGESERVICE;
                $filename          = time() . '_' . $file->getClientOriginalName();
                $uploadSuccess     = $file->move($destinationPath, $filename);
                $data['icon_url'] = IMAGESERVICE . $filename;
            }
            $data['status'] = 1;
            $service               = $this->model->create($data);
            return redirect()->route('service.index')->with('status', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return $this->response->json(false, '', $this->getErrorMessages($e));
        }
    }

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

    public function edit($id) {
        $data     = $this->model->find($id);
        return view('administrator.services.edit', ['data' => $data]);
    }

    public function update($id) {
        try {
            $model = $this->model->find($id);
            if ($model == NULL) {
                abort(404);
            }
            $input = $this->getInputFieldUpdate();
            foreach ($input as $key => $value) {
                $model->$key = $value;
            }
            $data      = $model->toArray();
            $validator = $this->validator($data);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput($data);
            }
            if ($this->request->hasFile('image_url')) {
                $file              = $this->request->image_url;
                $destinationPath   = public_path() . IMAGENEWS;
                $filename          = time() . '_' . $file->getClientOriginalName();
                $uploadSuccess     = $file->move($destinationPath, $filename);
                $data['image_url'] = IMAGENEWS . $filename;
            }
            if ($this->request->hasFile('icon_url')) {
                $file              = $this->request->icon_url;
                $destinationPath   = public_path() . IMAGESERVICE;
                $filename          = time() . '_' . $file->getClientOriginalName();
                $uploadSuccess     = $file->move($destinationPath, $filename);
                $data['icon_url'] = IMAGESERVICE . $filename;
            }
            $obj = $model->update($data);
            if (!$obj) {
                return redirect()->route('service.index')->with('status', false)->with('message', 'Cập nhật thất bại!');
            }
            return redirect()->route('service.index')->with('status', true)->with('message', 'Cập nhật thành công!');
        } catch (Exception $e) {
            return $this->response->json(false, '', $this->getErrorMessage($e));
        }
    }

    public function destroy($id) {
        try {
            $obj = $this->model->find($id);
            if (!$obj) {
                return redirect()->route('service.index')->with('status', true)->with('message', 'Xóa thất bại!');
            }
            $obj->delete();
            return redirect()->route('service.index')->with('status', true)->with('message', 'Xóa thành công!');
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
    }

}
