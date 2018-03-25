<?php namespace App\Http\Repositories\Administrators;

use App;
use App\Services\AuthService;
use File;
abstract class Repository {

    public $app;
    protected $auth;

    const ZERO       = 0;
    const DELETED    = 'deleted';
    const ID         = 'id';

    function __construct(App $app, AuthService $auth) {
        $this->app  = $app;
        $this->auth = $auth;
    }

    public function getErrorMessages($e) {
        $environment = env('ENVIRONMENT');
        if ($environment == 'production') {
            return 'MESSAGE.SOMETHING_WENT_WRONG';
        } else {
            return $e->getMessage();
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  GET ALL ROW OF SOME TABLE.
    |--------------------------------------------------------------------------
    | @params $model collection
    | @return mix
    | @Author : haind
     */
    protected function getDataBySomeModel($model, $isConvert = true) {
        return $model->get();
    }

    /*
    |--------------------------------------------------------------------------
    |  FIND ROW OF SOME TABLE.
    |--------------------------------------------------------------------------
    | @params $model collection
    | @return mix
    | @Author : haind
     */
    protected function findDataBySomeModel($model, $id) {
        return $model->where(self::ID, $id)->first();
    }

    /*
    |--------------------------------------------------------------------------
    |  DELETE FILE BY ATTRIBUTE.
    |--------------------------------------------------------------------------
    | @params $attr   string
    | @params $value  array
    | @params $file   \File
    | @return mix
    | @Author : haind
     */
    public static function destroyFileByAttr($attr, $value) {
        \DB::beginTransaction();
        try {
            $fileUrls = [];
            $files    = Files::whereIn($attr, $value)->get();
            if ($files) {
                foreach ($files as $file) {
                    array_push($fileUrls, $file[self::FILE_URL]);
                    $file->delete();
                }
                File::delete($fileUrls);
            }
        } catch (Exception $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
        }
        \DB::commit();
        return true;
    }

}
