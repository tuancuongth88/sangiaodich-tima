<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class AccountLog extends Model {

    protected $fillable = [
        'id',
        'amount',
        'user_id',
    ];
}
