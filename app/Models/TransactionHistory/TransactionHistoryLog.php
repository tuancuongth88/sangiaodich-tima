<?php

namespace App\Models\TransactionHistory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistoryLog extends Model {
    use SoftDeletes;

    protected $table      = 'transaction_history_log';
    protected $primaryKey = 'id';

    public $fillable = [
        'transaction_id',
        'service_code',
        'created_by',
        'receiver',
        'fee',
        'amount',
        'customer_name',
        'customer_mobile',
        'user_id',
        'city_id',
        'ward_id',
        'district_id,amount',
        'amount_day',
        'payment_day',
        'status',
        'created_time',
        'telesales_id',
        'telesales_time',
        'sales_id',
        'sales_time',
        'fee',
        'fee_type',
        'percent_discount',
    ];

    protected $dates = ['deleted_at'];

}
