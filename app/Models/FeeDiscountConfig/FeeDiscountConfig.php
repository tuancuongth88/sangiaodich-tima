<?php

namespace App\Models\FeeDiscountConfig;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeDiscountConfig extends Model
{
    //
    use SoftDeletes;
    protected $table ='fee_discount_config';
protected $fillable = ['service_id','discount_percent','validate_time','expried_time','created_by','created_time','status'];
protected $dates = ['deleted_at'];

}
