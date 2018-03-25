<?php
namespace App\Http\Repositories\Administrators\Comments;
use App\Http\Repositories\Administrators\Repository;
use App\Models\News\NewsComment;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Cuongnt
 * Date: 23/03/2018
 * Time: 2:50 CH
 */

class CommentRepository extends Repository {
    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;

    private $perpages;

    private $current;

    function __construct(NewsComment $comment, ResponseService $response, Request $request, AuthService $auth, User $user, $companyId = 0, $perpages = 20, $current = 1) {
        $this->model  = $comment;
        $this->user      = $user;
        $this->response  = $response;
        $this->request   = $request;
        $this->auth      = $auth;
        $this->perpages  = $perpages;
        $this->current   = $current;
    }
    public function index() {
        try {
            $orderField = ($this->request->has('field')) ? $this->request->input('field') : self::ID;
            $orderType  = ($this->request->has('type')) ? $this->request->input('type') : self::ID;
            $query      = $this->model->orderBy($orderField, ($orderType) ? 'asc' : 'desc');
            if ($this->request->has('query')) {
                $query = $query->search($this->request->input('query'));
            }
            $listComment = $query->paginate($this->perpages);
            return view('administrator.comments.index', ['data' => $listComment]);
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
    }
}