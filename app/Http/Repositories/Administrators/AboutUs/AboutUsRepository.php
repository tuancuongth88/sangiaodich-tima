<?php namespace App\Http\Repositories\Administrators\AboutUs;

use App\Http\Repositories\Administrators\Repository;

use App\Models\AboutUs\AboutUs;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Validator;

class AboutUsRepository extends Repository
{

    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;


    function __construct(
        AboutUs $aboutus,
        ResponseService $response,
        Request $request,
        AuthService $auth,
        User $user
    )
    {
        $this->model = $aboutus;
        $this->user = $user;
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
    }


    /*
    |--------------------------------------------------------------------------
    | STORE NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return object news
    | @Author : haind
     */

    public function store()
    {
        try {
            $data = $this->request->all();
            unset($data['_token']);
            $data_about = $this->model::all()->toArray();
            if (isset($data_about[0])) {
                return redirect()->action(
                    'Administrators\AboutUs\AboutUsController@index'
                )->with('status', true)->with('message', 'Thêm mới thành công!');
            }
            $obj = $this->model->create($data);
            if ($obj) {
                return redirect()->action(
                    'Administrators\AboutUs\AboutUsController@index'
                )->with('status', true)->with('message', 'Thêm mới thành công!');
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

    public function update($id)
    {
        //try {
            $data = $this->request->all();
            unset($data['_token']);
            $obj = $this->model->find($id)->update($data);
            if (!$obj) {
                return redirect()->action(
                    'Administrators\AboutUs\AboutUsController@index'
                )->with('error', true)->with('message', 'Cập nhật thất bại!');
            }
            return redirect()->action(
                'Administrators\AboutUs\AboutUsController@index'
            )->with('status', true)->with('message', 'Cập nhật thành công!');
//        } catch (\Exception $e) {
//            return $this->response->json(false, '', $this->getErrorMessages($e));
//        }
    }

    public function edit()
    {
        $data = $this->model::all()->toArray();
        if (isset($data[0])) {
            $data = $data[0];
        }
        return view('administrator.aboutus.index', ['data' => $data]);
    }

}
