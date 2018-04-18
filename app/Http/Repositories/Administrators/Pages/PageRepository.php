<?php namespace App\Http\Repositories\Administrators\Pages;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Admins\Admin;
use App\Models\Page;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Validation\Rule;
use Validator;

class PageRepository extends Repository
{
    private $model;
    private $request;
    private $response;
    protected $auth;
    private $perpages;
    private $current;

    function __construct(ResponseService $response, Request $request, Page $page, $perpages = 20, $current = 1)
    {
        $this->model = $page;
        $this->request = $request;
        $this->response = $response;
        $this->auth = \Auth::guard('admin')->user();
        $this->perpages = $perpages;
        $this->current = $current;
    }

    /*
    |-----------------------------------------------------
    | VIEW ALL LIST OF PAGE
    |-----------------------------------------------------
    | @params 
    | @methos GET
    | @author tantan
     */
    public function list(){
        $data = $this->model->orderBy('created_at', 'desc')->paginate($this->perpages);
        return view('administrator.pages.list')->with(compact('data'));
    }

    /*
    |-----------------------------------------------------
    | GET EDIT PAGE FORM
    |-----------------------------------------------------
    | @params 
    | @methos GET
    | @author tantan
     */
    public function getEditForm($id){
        $data = $this->model->findOrFail($id);
        return view('administrator.pages.update_form')->with(compact('data'));
    }

    /*
    |-----------------------------------------------------
    | STORE AN PAGE, IF ID IS NULL IT WILLBE CREATE
    |-----------------------------------------------------
    | @params Request, Id
    | @methos POST, PUT
    | @author tantan
     */
    public function storePage($request, $id = null){
        $input = $request->except(['created_at']);

        if( empty($input['slug']) ){
            $input['slug'] = SlugService::createSlug(\App\Models\Page::class, 'slug', $input['title']);
        }
        else{
            $input['slug'] = str_slug($input['slug'], '-');
        }

        if( !empty($input['machine_name']) ){
            $input['machine_name'] = str_slug($input['machine_name'], '_');
        }
        else{
            $input['machine_name'] = SlugService::createSlug(\App\Models\Page::class, 'machine_name', $input['title'], ['separator' => '_']);
        }

        $messages = [
            'required'                   => 'Vui lòng nhập :attribute',
            'slug.unique' => 'Đường dẫn bị trùng.',
            'machine_name.unique' => 'Machine name bị trùng.',
        ];
        $validator = Validator::make($input, [
            'title'    => 'required',
            'body' => 'required',
            'slug' => ($id == null) ? 'unique:pages,slug' : Rule::unique('pages')->ignore($id, 'id'),
            'machine_name' => ($id == null) ? 'unique:pages,machine_name' : Rule::unique('pages')->ignore($id, 'id'),
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $input['author'] = \Auth::guard('admin')->user()->id;


        if( $id == null ){
            $this->model->create($input);
        } else{
            $page = $this->model->findOrFail($id);
            $page->update($input);
            return redirect()->route('pages.index')->with('status', true)->with('message', str_replace_array('@text', [$page->title], 'Lưu "@text" thành công!'));
        }
        return redirect()->route('pages.index')->with('status', true)->with('message', 'Lưu thành công!');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE NEWS
    |--------------------------------------------------------------------------
    | @params id pages
    | @return BOOLEAN
    | @Author : tantan
     */
    public function destroy($id)
    {
        $pages = $this->model->find($id);
        if (!$pages) {
            return redirect()->route('pages.index')->with('error', true)->with('message', 'Xóa thất bại!');
        }
        $pages->delete();
        return redirect()->route('pages.index')->with('status', true)->with('message', 'Xóa thành công!');
    }
}
