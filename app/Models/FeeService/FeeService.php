<?php

namespace App\Models\FeeService;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeService extends Model
{
    use SoftDeletes;

    protected $table = 'fee_service';
    protected $primaryKey = 'id';

    public $fillable = [
        'service_id', 'service_code', 'fee', 'created_by', 'validate_time', 'expire_time', 'status'
    ];

    protected $dates = ['deleted_at'];

}