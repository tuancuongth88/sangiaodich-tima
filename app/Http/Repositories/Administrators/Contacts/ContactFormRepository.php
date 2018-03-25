<?php
/**
 * Created by PhpStorm.
 * User: Cuongnt
 * Date: 13/03/2018
 * Time: 5:34 CH
 */

namespace App\Http\Repositories\Administrators\Contacts;
use App\Http\Repositories\Administrators\Repository;
use App\Models\Contacts\Contact;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class ContactFormRepository extends Repository {
    private $model;

    private $request;

    private $response;

    private $user;

    protected $auth;

    private $perpages;

    private $current;

    function __construct(Contact $contact, ResponseService $response, Request $request, AuthService $auth, User $user, $perpages = 20, $current = 1) {
        $this->model    = $contact;
        $this->user     = $user;
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

    // field of user table.
    const ID           = 'id';
    const EMAIL_SENDER = 'name';
    const FULLNAME     = 'email';
    const EMAIL_TO     = 'phone';
    const HOST         = 'address';
    const PORT         = 'description';

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
            self::EMAIL_SENDER,
            self::FULLNAME,
            self::EMAIL_TO,
            self::HOST,
            self::PORT,
            self::SMPTSECURE
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
            self::EMAIL_SENDER,
            self::FULLNAME,
            self::EMAIL_TO,
            self::HOST,
            self::PORT,
            self::SMPTSECURE
        );
    }

    public function index() {
        try {
            $orderField = ($this->request->has('field')) ? $this->request->input('field') : self::ID;
            $orderType  = ($this->request->has('type')) ? $this->request->input('type') : self::ID;
            $query      = $this->model->orderBy($orderField, ($orderType) ? 'asc' : 'desc');
            if ($this->request->has('query')) {
                $query = $query->search($this->request->input('query'));
            }
            $listContact = $query->paginate($this->perpages);
            return view('administrator.contact.index', ['data' => $listContact]);
        } catch (Exception $e) {
            return $this->response->json(false, '', 'MESSAGE.SOMETHING_WENT_WRONG');
        }
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
            $obj = $this->model->create($data);
            if ($obj) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return $this->response->json(false, '', $this->getErrorMessages($e));
        }
    }

    public function show($id) {
        $data = $this->model->find($id)->toArray();
        return view('administrator.contact.view', ['data' => $data]);
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
                    'url'         => route('contact.show', ['id' => $value['id']]),
                ];
            }
        }
        return view('administrator.theme.search-result', ['total' => $data->count(), 'data' => $dataResponse]);

    }
}