<?php
namespace App\Http\Repositories\Administrators\ImportData;

use App\Http\Repositories\Administrators\Repository;
use App\Models\DataTax\DataTax;
use App\Models\DataTax\PersonalInfor;
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
            $query       = $this->model->where('type', $this->model::TYPE_DOANHNGHIEP)->orderBy($orderField, ($orderType) ? 'asc' : 'desc');
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
//        ini_set('memory_limit','1024M');
        ini_set('max_execution_time', '1000');
        ini_set('memory_limit', '-1');
        if($this->request->hasFile('file_data')){
            Excel::load($this->request->file('file_data')->getRealPath(), function ($reader) {
                $i = 0;
                $insert = array();
                foreach ($reader->toArray() as $key => $row) {
                    $i++;
                    $charges = [
                        'masothue' => $row['tin'],
                        'tenchinhthuc' => $row['ten_dtnt'],
                        'noidangkyquanly' => $row['ten_cq_thue'],
                        'noidangkynopthue' => $row['ten_cq_thue'],
                        'diachitruso' => $row['tran_addr'],
                        'email' => isset($row['post_mail']) ? $row['post_mail'] : $row['tin_emal'],
                        'ketoantruong' => $row['ten_ketoan'],
                        'sodienthoaiketoantruong' => $row['dienthoai_ketoan'],
                        'tengiamdoc' => $row['ten_giamdoc'],
                        'sodienthoaigiamdoc' => $row['dienthoai_giamdoc'],
                        'phone_company' => $row['tran_tel'],
                        'phone_company' => $row['tran_tel'],
                        'x1' => isset($row['x1']) ? $row['x1'] : 0,
                        'x2' => isset($row['x2']) ? $row['x1'] : 0,
                        'x3' => isset($row['x3']) ? $row['x3'] : 0,
                        'x4' => isset($row['x4']) ? $row['x4'] : 0,
                        'x5' => isset($row['x5']) ? $row['x5'] : 0,
                        'type' => 1,
                    ];
                    // check ma so thue
                    $checkData = $this->model->where('masothue', $row['tin']);
                    if($checkData->count() > 0){
                        $checkData->update($charges);
                        continue;
                    }
                    $insert[$i] = $charges;
                    if($i % 500 == 0){
                        $this->model->insert($insert);
                        $insert = array();
                    }
                }
            });
        }
        return redirect()->route('import-tax.index');
    }

    public function personalUpload(){
        $data = PersonalInfor::paginate($this->perpages);
        return view('administrator.data_tax.persone', ['data' => $data]);
    }

    public function doUploadPersenal(){
        ini_set('max_execution_time', '1000');
        ini_set('memory_limit', '-1');
        if($this->request->hasFile('file_data')){
            $row = 0;
            if (($handle = fopen($this->request->file('file_data')->getRealPath(), "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                    $row++;
                    if($row == 1)
                        continue;
                    $num = count($data);
                    $item = array();
                    for ($c=0; $c < $num; $c++) {
                        $item[] = $data[$c];
                    }
                    $personalInfor['phone'] = $item[0];
                    $personalInfor['name'] = $item[1];
                    $personalInfor['gender'] = $item[2];
                    $personalInfor['birth'] = $item[3];
                    $personalInfor['home_address'] = $item[4];
                    PersonalInfor::insert($personalInfor);
                }
                fclose($handle);
            }
        }
        return redirect()->route('import-tax.index');
    }

}
