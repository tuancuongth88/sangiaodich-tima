<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model {
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public static $rules = [
        'name' => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá 255 ký tự.',
    ];

    protected $dates = ['deleted_at'];

    public static function getTableName() {
        return with(new static )->getTable();
    }
}
