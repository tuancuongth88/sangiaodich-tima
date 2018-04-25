<?php namespace App\Http\Repositories\Administrators\TransactionHistory;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Services\Service;
use App\Models\TransactionHistory\TransactionHistory;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class TransactionHistoryRepository extends Repository
{

    private $model;

    private $request;

    private $response;

    protected $auth;

    private $perpages;

    private $current;

    private $services;

    private $user;


    function __construct(
        TransactionHistory $transactionHistory,
        ResponseService $response,
        Service $services,
        Request $request,
        AuthService $auth,
        User $user,
        $perpages = 20,
        $current = 1
    )
    {
        $this->model = $transactionHistory;
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->perpages = $perpages;
        $this->user = $user;
        $this->current = $current;
        $this->services = $services;
    }

    /*
    |--------------------------------------------------------------------------
    | ALL NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return object news
    | @Author : cuongnt
     */

    public function index()
    {
        $list_services = Service::all();
        $input = $this->request->all();
        if (isset($input['fee_type']) && $input['fee_type'] == '0') {
            unset($input['fee_type']);
        }
        if (isset($input['service_code']) && ($input['service_code'] == '0' || !$input['service_code'])) {
            unset($input['service_code']);
        }
        if (!isset($input['city_id'])) {
            unset($input['city_id']);
        }
        if (!isset($input['district_id'])) {
            unset($input['district_id']);
        }

        $query = $this->model->where('status', TransactionHistory::STATUS_WAIT_APPROVE)->where($input)->orderBy('id', 'desc');
        $listData = $query->paginate($this->perpages);
        return view('administrator.transactionhistory.index',
            ['data' => $listData, 'list_service' => $list_services, 'input' => $input]
        );
    }

    public function approve($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return redirect()->route('admin.transaction.list')->with('status', false)->with('message', 'Hợp đồng này không tồn tại!');
        }
        $data->update(['status' => TransactionHistory::STATUS_WAIT]);
        return redirect()->route('admin.transaction.list')->with('status', true)->with('message', 'Giao dịch đã được xác nhận!');
    }

    public function reject($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return redirect()->route('admin.transaction.list')->with('status', false)->with('message', 'Hợp đồng này không tồn tại!');
        }
        $data->update(['status' => TransactionHistory::STATUS_CANCEL]);
        return redirect()->route('admin.transaction.list')->with('status', true)->with('message', 'Giao dịch đã được hủy!');
    }

    public function search()
    {

    }

    /*
  |--------------------------------------------------------------------------
  | Report transaction
  |--------------------------------------------------------------------------
  | @params
  | @return object news
  | @Author : phuonglv
   */

    public function report()
    {
        $list_services = Service::all();
        $status_transactionhistory = $this->model->status_transactionhistory;
        $input = $this->request->all();
        $from = isset($input['from']) ? ($input['from']) : 0;
        $to = isset($input['to']) ? ($input['to']) : 0;
        $isDownload = isset($input['download']) ? $input['download'] : 0;

        $where = array();

        if (isset($input['fee_type']) && !$input['fee_type'] == 0) {
            $where[] = ['fee_type', '=', $input['fee_type']];
        }
        if (isset($input['service_code']) && !$input['service_code'] == 0) {
            $where[] = ['service_code', '=', $input['service_code']];
        }
        if (isset($input['city_id'])) {
            $where[] = ['city_id', '=', $input['city_id']];
        }
        if (isset($input['district_id'])) {
            $where[] = ['district_id', '=', $input['district_id']];
        }
        if (isset($input['phone'])) {
            $user_search = $this->user::where('phone', 'like', '%' . $input['phone'] . '%')->get()->toArray();
        }

        $users_id = array();
        if (isset($user_search[0]) && !empty($user_search[0])) {
            foreach ($user_search as $key => $user) {
                $users_id[] = $user['id'];
            }
        }

        if ($from) {
            $where[] = [DB::raw('date(created_at)'), '>=',  convertDate('Y-m-d',$from)];
        }
        if ($to){
            $where[] = [DB::raw('date(created_at)'), '<=',  convertDate('Y-m-d',$to)];
        }


        if (!empty($users_id)) {
            $query = $this->model->where($where)->whereIn('user_id', $users_id)->orderBy('id', 'desc');
        } else {
            $query = $this->model->where($where)->orderBy('id', 'desc');
        }
        $listData = $query->paginate($this->perpages);
        if ($isDownload) {
            $this->booksListPhpExcel($listData);
        }
        return view('administrator.transactionhistory.report',
            ['data' => $listData, 'list_service' => $list_services, 'input' => $input, 'status_transaction' => $status_transactionhistory]
        );
    }


    public function booksListPhpExcel($bookData)
    {
        $fileType = \PHPExcel_IOFactory::identify(storage_path('excels/report_tran_template.xlsx')); // đọc loại file template
        $objReader = \PHPExcel_IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load(storage_path('excels/report_tran_template.xlsx')); //load dữ liệu từ file excel luu vao bien $objPHPExcel


        $this->addDataToExcelFile($objPHPExcel->setActiveSheetIndex(0), $bookData); //chay ham them du lieu vao excel

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //Ham tao moi file excel

        //Kiem tra thu muc co ton tai khong, neu khong co thi tao moi

//        if (!is_dir(public_path('excel'))) {
//            mkdir(public_path('excel'));
//        }
//
//        if (!is_dir(public_path('excel/import'))) {
//            mkdir(public_path('excel/import'));
//        }
        //-----------------------------------------------------------

        //$path = 'excel/import/' . time() . 'import.xlsx'; //dat ten cho file excel


        $namedownload = 'report_trans' . time() . '.xlsx';

        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="' . $namedownload . '"');

        // Write file to the browser
        $objWriter->save('php://output');

        //$objWriter->download('xlsx'); //luu file excel vao thu muc

        //return redirect($path); //tra file excel ve cho nguoi dung
    }

    private function addDataToExcelFile($setCell, $bookData) //HAM THEM DU LIEU VAO FILE EXCEL
    {
        //$setCell->setCellValue('D7', 'Đào Hải Long');   //them doan text Dao Hai Long vao o D7

        $index = 1;

        $row = 8;  //danh dau dong bat dau them data, su dung trong vong lap foreach

        foreach ($bookData as $key => $item) {

            $district_name = isset($item->district_id) ? getLocation($item->district_id)['name'] : "";
            $city_name = isset($item->city_id) ? getLocation($item->city_id)['name'] : "";
            $setCell
                ->setCellValue('B' . $row, $index)//them du lieu vao cot B
                ->setCellValue('C' . $row, $item->user->fullname)
                ->setCellValue('E' . $row, $item->user->phone)
                ->setCellValue('F' . $row, $item->service->service_name)
                ->setCellValue('G' . $row, $district_name . ', ' . $city_name)
                ->setCellValue('H' . $row, $item->amount)
                ->setCellValue('I' . $row, $item->created_at);
            //->setCellValue('H' . $row, '=F' . $row . '*G' . $row); //them dong text vao cot H, su dung ham tinh toan mac dinh trong excel de tinh gia tri

            $index++;

            $row++;
        }

        //them duong vien cho du lieu trong file excel

        $setCell->getStyle("B8:I" . ($index + 10))->applyFromArray(array(
            'borders' => array(
                'outline' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                    'size' => 1,
                ),
                'inside' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                    'size' => 1,
                ),
            ),
        ));
        //------------------------------------------------------------------

        return $this;
    }
}
