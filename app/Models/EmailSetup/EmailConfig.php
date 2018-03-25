<?php

namespace App\Models\EmailSetup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailConfig extends Model {
    use SoftDeletes;

    protected $table      = 'email_config';
    protected $primaryKey = 'id';

    protected $fillable = ['email_sender', 'fullname', 'password', 'email_to', 'host', 'port', 'smtpsecure', 'updated_by', 'created_by'];

    public static $rules = [
        'email_sender' => 'required|email|max:250',
        'fullname'     => 'required|max:250',
        'password'     => 'required|max:250',
        'email_to'     => 'required',
        'host'         => 'required|max:250',
        'smtpsecure'   => 'required|max:250',
        'port'         => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá :max ký tự.',
    ];

    protected $dates = ['deleted_at'];
}
