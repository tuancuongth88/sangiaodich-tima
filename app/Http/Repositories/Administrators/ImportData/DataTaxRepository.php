<?php
namespace App\Http\Repositories\Administrators\ImportData;

use App\Http\Repositories\Administrators\Repository;
use App\Models\DataTax\DataTax;
use App\Models\Partner\Partner;
use App\Models\Partner\PartnerCategory;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class DataTaxRepository extends Repository {

    private $category;

    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;

    private $companyId;

    private $perpages;

    private $current;

    function __construct(DataTax $model, ResponseService $response, Request $request, AuthService $auth, $perpages = 20, $current = 1) {
        $this->model    = $model;
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
            $query       = $this->model->orderBy($orderField, ($orderType) ? 'asc' : 'desc');
            $data = $query->paginate($this->perpages);
            return view('administrator.data_tax.index', ['data' => $data]);
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

    public function importFile(){
        if($this->request->hasFile('file_data')){
            $insert = array();
            Excel::load($this->request->file('file_data')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $row) {
                    $insert['masothue'] = $row['tin'];
                    $insert['tenchinhthuc'] = $row['ten_dtnt'];
                    $insert['noidangkyquanly'] = $row['ten_cq_thue'];
                    $insert['noidangkynopthue'] = $row['ten_cq_thue'];
                    $insert['diachitruso'] = $row['tran_addr'];
                    $insert['email'] = isset($row['post_mail']) ? $row['post_mail'] : $row['tin_emal'];
                    $insert['ketoantruong'] = $row['ten_ketoan'];
                    $insert['sodienthoaiketoantruong'] = $row['dienthoai_ketoan'];
                    $insert['tengiamdoc'] = $row['ten_giamdoc'];
                    $insert['sodienthoaigiamdoc'] = $row['dienthoai_giamdoc'];
                    $insert['phone_company'] = $row['tran_tel'];
                    $insert['x1'] = $row['x1'];
                    $insert['x2'] = $row['x2'];
                    $insert['x3'] = $row['x3'];
                    $insert['x4'] = $row['x4'];
                    $insert['x5'] = $row['x5'];
                    // check ma so thue
                    $checkData = $this->model->where('masothue', $row['tin']);
                    if($checkData->count() > 0){
                        $checkData->update($insert);
                    }else{
                        $this->model->create($insert);
                    }
                }
            });
        }
        return redirect()->route('import-tax.index');
    }
}
