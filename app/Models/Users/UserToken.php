<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model {
    protected $table = 'user_tokens';

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\Users\User', 'user_id');
    }
}
