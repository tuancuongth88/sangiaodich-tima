<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class AccountLog extends Model
{

    protected $table = 'account_logs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'amount',
        'user_id',
        'type'
    ];

    public static $account_log_type =
        array(
            FEES_RECEIVED => 'Phí nhận đơn vay',
            SEARCH_FEE_LOAN_HISTORY => 'Phí tra cứu lịch sử vay',
            SEARCH_FEE_LIMITS => 'Phí tra cứu xếp hạng hạn mức',
            RECHARGE => 'Nạp tiền',
            DATA_TAX    => 'Phí tra cứu xếp hạng tín dụng'
        );

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User', 'user_id', 'id');
    }
}
