<?php namespace App\Http\Repositories\Administrators\News;

use App\Http\Repositories\Administrators\Repository;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\News\Tag;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Validator;

class NewsRepository extends Repository {

    private $category;

    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;

    private $perpages;

    private $current;

    private $tag;

    const PIN     = 1;
    const UNPIN   = 0;
    const APPROVE = 1;
    const DRAFT   = 2;
    const WAIT    = 0;
    const ZERO    = 0;
    const ONE     = 1;

    function __construct(NewsCategory $category, News $news, ResponseService $response, Request $request, AuthService $auth, User $user, $perpages = 20, $current = 1, Tag $tag) {
        $this->category  = $category;
        $this->model     = $news;
        $this->user      = $user;
        $this->response  = $response;
        $this->request   = $request;
        $this->auth      = $auth;
        $this->perpages  = $perpages;
        $this->current   = $current;
        $this->tag       = $tag;
    }

    /*
    |--------------------------------------------------------------------------
    | ONLOAD
    |--------------------------------------------------------------------------
    | @params
    | @return array[category,listUser]
    | @Author : haind
     */

    public function onload() {
        $category = $this->category->company($this->companyId)->get();
        $user     = $this->user->where('companyId', $this->companyId)->get();
        if (count($category) > 0 || count($user) > 0) {
            return $this->response->json(true,
                [
                    'category' => $category,
                    'user'     => $user,
                ],
                '');
        } else {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
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
    const ID               = 'id';
    const TITLE            = 'title';
    const URL              = 'url';
    const DESCRIPTION      = 'description';
    const CONTENT          = 'content';
    const IS_COMMENT       = 'is_comment';
    const CATEGORY_ID      = 'category_id';
    const IMAGE_URL        = 'image_url';
    const TITLE_META       = 'title_meta';
    const DESCRIPTION_META = 'description_meta';
    const KEYWORD_META     = 'keyword_meta';
    const SEND_AT          = 'send_at';
    const AUTHOR           = 'author';
    const CREATED_BY       = 'created_by';
    const UPDATED_BY       = 'updated_by';

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
            self::TITLE,
            self::URL,
            self::DESCRIPTION,
            self::CONTENT,
            self::IS_COMMENT,
            self::CATEGORY_ID,
            self::IMAGE_URL,
            self::TITLE_META,
            self::DESCRIPTION_META,
            self::KEYWORD_META,
            self::SEND_AT,
            self::AUTHOR
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
            self::TITLE,
            self::URL,
            self::DESCRIPTION,
            self::CONTENT,
            self::IS_COMMENT,
            self::CATEGORY_ID,
            self::IMAGE_URL,
            self::TITLE_META,
            self::DESCRIPTION_META,
            self::KEYWORD_META,
            self::SEND_AT,
            self::AUTHOR
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
        $listTag            = explode(',', $this->request->input('tags'));
        $data               = $this->getInputFieldStore();
        $data['is_comment'] = ($this->request->has('is_comment')) ? $this->request->input('is_comment') : self::ZERO;
        $validator          = $this->validator($data);
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
        $data['created_by'] = $this->auth->user()->id;
        $obj                = $this->model->create($data);
        if ($obj) {
            foreach ($listTag as $value) {
                $dataRelated[] = new Tag(['tag' => $value]);
            }
            $obj->tags()->saveMany($dataRelated);
            return redirect()->action('Administrators\News\NewsController@index')->with('status', true)->with('message', 'Thêm mới thành công!');
        }
        return redirect()->back()->withInput($data)->with('error', true)->with('message', 'Thêm mới thất bại!');
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
        $data = $this->model->find($id);
        if (!$data) {
            return redirect()->action('Administrators\News\NewsController@index')->with('error', true)->with('message', 'Cập nhật không thành công!');
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
            $listTag = explode(',', $this->request->input('tags'));

            $this->tag->where('news_id', $id)->delete();
            foreach ($listTag as $value) {
                $dataRelated[] = new Tag(['tag' => $value]);
            }
            $data->tags()->saveMany($dataRelated);
            return redirect()->action('Administrators\News\NewsController@index')->with('error', true)->with('message', 'Cập nhật thất bại!');
        }
        return redirect()->action('Administrators\News\NewsController@index')->with('status', true)->with('message', 'Cập nhật thành công!');
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
        // $orderField = ($this->request->has('field')) ? $this->request->input('field') : self::ID;
        // $orderType  = ($this->request->has('type')) ? $this->request->input('type') : self::ID;
        $newsModel = $this->model->orderBy(self::ID, 'DESC');
        if ($this->request->has('query')) {
            $newsModel = $newsModel
                ->search($this->request->input('query'));
        }
        $listNews = $newsModel->paginate($this->perpages);
        return view('administrator.news.news.index', ['data' => $listNews]);
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
        $news = $this->model->find($id);
        if (!empty($news)) {
            return $this->response->json(true, $news, '');
        }
        return $this->response->json(false, '', 'MESSAGE.DATA_IS_EMPTY');
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
        $news = $this->model->find($id);
        $news->delete();
        $this->tag->where('news_id', $id)->delete();
        if (!$news) {
            return redirect()->action('Administrators\News\NewsController@index')->with('error', true)->with('message', 'Xóa thất bại!');
        }
        return redirect()->action('Administrators\News\NewsController@index')->with('status', true)->with('message', 'Xóa thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCEPT NEWS
    |--------------------------------------------------------------------------
    | @params id news
    | @return object news
    | @Author : haind
     */

    public function putApprove($id) {
        $obj               = $this->model->find($id);
        $obj->is_approve   = ($obj->is_approve == self::APPROVE) ? self::ZERO : self::APPROVE;
        $obj->approve_time = Carbon::now();
        $obj->save();
        if (!$obj->image_url) {
            $obj->image_url = '/upload/no-image.png';
        }
        if (!$obj) {
            return redirect()->action('Administrators\News\NewsController@index')->with('error', true)->with('message', 'Duyệt tin thất bại!');
        }
        return redirect()->action('Administrators\News\NewsController@index')->with('status', true)->with('message', 'Duyệt tin thành công!');
    }

    public function create() {
        $category = $this->category->get()->toArray();
        return view('administrator.news.news.create', ['category' => $category]);
    }

    public function edit($id) {
        $category = $this->category->get();
        $data     = $this->model->find($id);
        $tags     = $this->tag->where('news_id', $id)->pluck('tag')->toArray();
        if (count($tags) > 0) {
            $data->tags = implode(',', $tags);
        }
        $author = [];
        if ($data['author']) {
            $author = $this->user->find($data['author']);
        }
        return view('administrator.news.news.edit', ['category' => $category, 'data' => $data, 'author' => $author]);
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH NEWS
    |--------------------------------------------------------------------------
    | @params
    | @return {array} list news
    | @Author : haind
     */

    public function getSearch() {
        if ($this->request->has('query')) {
            $newsModel = $this->model
                ->search($this->request->input('search'))
                ->orderBy('created_at', 'DESC');
            $total = $newsModel->count();
            $data  = $newsModel->get()->toArray();
            if ($total > 0) {
                foreach ($data as $key => $value) {
                    $dataResponse[] = [
                        'id'          => $value[self::ID],
                        'name'        => $value[self::TITLE],
                        'sub_name'    => '',
                        'description' => $value[self::DESCRIPTION],
                        'url'         => route('user.edit', ['id' => $value['id']]),
                    ];
                }
            }
            return view('administrator.theme.search-result', ['total' => $total, 'data' => $dataResponse]);
        }
    }

}
