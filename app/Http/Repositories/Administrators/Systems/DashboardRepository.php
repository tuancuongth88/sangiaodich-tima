<?php namespace App\Http\Repositories\Administrators\Systems;

use App\Http\Repositories\Administrators\Repository;
use App\Http\Requests;
use App\Services\AuthService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class DashboardRepository extends Repository {

    protected $request;

    protected $model;

    protected $response;

    const ZERO = 0;
    // field of branch table.
    const ID         = 'id';
    const NAME       = 'name';
    const CRETED_BY  = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED    = 'deleted';
    const COMPANY_ID = 'company_id';

    function __construct(AuthService $auth, ResponseService $response, Request $request) {
        $this->auth     = $auth;
        $this->response = $response;
        $this->request  = $request;
    }

    public function index() {
        return view('administrator.dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | GET LOCATION NESTED LIST.
    |--------------------------------------------------------------------------
    | @params
    | @method GET
    | @return Response
    | @Author : tantan
     */
    public function getLocation() {
        $locationTree = getLocationList();
        $data = $this->exportLocationTree($locationTree);
        return view('administrator.locations.index')->with(compact('data'));
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE LOCATION NESTED LIST.
    |--------------------------------------------------------------------------
    | @params
    | @method GET
    | @return Response
    | @Author : tantan
     */
    public function postLocation() {
        $locationInput = $this->request->get('location');

        $new_terms = [];
        $last_parents = [];
        $terms = explode("\n", str_replace("\r", '', $locationInput));
        foreach ($terms as $name) {
            if (empty($name)) {
                continue;
            }
            $matches = array();

            // Child term prefixed with one or more dashes (-)
            if (preg_match('/^(-){1,}/', $name, $matches)) {
                $depth = strlen($matches[0]);
                $name = substr($name, $depth);
                $current_parents = isset($last_parents[$depth-1]) ? $last_parents[$depth-1]['tid'] : 0;
            }
            // Parent term containing dashes at the beginning and is therefore wrapped
            // in double quotes
            elseif (preg_match('/^\"(-){1,}.*\"/', $name, $matches)) {
                $name = substr($name, 1, -1);
                $depth = 0;
                $current_parents = 0;
            }
            else {
                $depth = 0;
                $current_parents = 0;
            }

            // Truncate long string names that will cause database exceptions.
            if (strlen($name) > 255) {
                $name = substr($name, 0, 255);
            }

            $term = [];
            $term['name'] = trim($name);
            $term['depth'] = $depth;
            $term['tid'] = str_slug($name);
            $term['parent1'] = isset($last_parents[$depth-1]) ? $last_parents[$depth-1]['tid'] : 0;
            $term['parent2'] = isset($last_parents[$depth-2]) ? $last_parents[$depth-2]['tid'] : 0;
            $new_terms[] = $term;
            $last_parents[$depth] = $term;
        }

        Storage::disk('local')->put('locations.json', json_encode($new_terms));
        return redirect()->back()->with('status', true)->withMessage('Lưu thông tin thành công!');
    }


    /*
    |--------------------------------------------------------------------------
    | CONVERT JSON TO STRING LOCATION TREE.
    |--------------------------------------------------------------------------
    | @params $tree aray
    | @return String
    | @Author : tantan
     */
    function exportLocationTree($tree) {
        $output = "";
        foreach ($tree as $term) {
            // If a term already starts with dashes, we have to escape the name.
            if (substr($term['name'], 0, 1) == '-') {
                $name = '"' . $term['name'] . '"';
            }
            else {
                $name = $term['name'];
            }
            $output .= str_repeat('-', $term['depth']) . $name . "\n";
        }
        return $output;
    }

}
