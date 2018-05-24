<?php
namespace App\Http\Repositories\Frontends\ImportData;

use App\Http\Repositories\Administrators\Repository;
use App\Models\DataTax\DataTax;
use App\Models\DataTax\PersonalInfor;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class DataTaxRepository extends Repository
{
    protected $response;
    protected $request;
    protected $perpage;
    protected $curent;

    public function __construct(ResponseService $response, Request $request, $perpages = 200, $current = 1) {
        $this->response = $response;
        $this->request = $request;
        $this->perpage = $perpages;
        $this->curent = $current;
    }

    public function index(){
        $data = null;
        $masothue = $this->request->masothue;
        if($masothue){
            $data = DataTax::where('masothue', $masothue)->where('type', 1)->first();
            if($data){
                return view('frontend.data_tax.index' , ['data' => $data]);
            }else{
                return view('frontend.data_tax.index')->with('message', 'Không tìm thấy kết quả');
            }

        }
        return view('frontend.data_tax.index' , ['data' => $data]);
    }

    public function canhan(){
        $data = null;
        $masothue = $this->request->masothue;
        if($masothue){
            $data = PersonalInfor::where('phone', $masothue)->orWhere('card_id', $masothue)->first();
            if($data){
                return view('frontend.data_tax.canhan' , ['data_canhan' => $data]);
            }else{
                return view('frontend.data_tax.canhan')->with('message', 'Không tìm thấy kết quả');
            }
        }
        return view('frontend.data_tax.canhan' , ['data_canhan' => $data]);
    }


}