<?php namespace App\Http\Repositories\Frontends\Users;

use App\Http\Repositories\Administrators\Repository;
use App\Models\Users\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Validator;

class UsersRepository extends Repository {

    function __construct() {
        
    }

}