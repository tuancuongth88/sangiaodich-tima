<?php

namespace App\Models\TransactionHistory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Model
{
    use SoftDeletes;


    protected $table = 'transaction_history';
    protected $primaryKey = 'id';

    public $fillable = [
        'trans_id,service_id,customer_name,customer_mobile,user_id,province_id,district_id,amount,
        amount_day,payment_day,status,created_time,telesales_id,telesales_time,sales_id,
        sales_time,fee,fee_type,percent_discount'
    ];

    protected $dates = ['deleted_at'];

    //1 ch
    public $status_transactionhistory =
        array(
            1 => 'Chờ nhận',
            2 => 'Đã nhận',
            3 => 'Đang vay',
            4 => 'Đã hoàn tất',
            5 => 'Đã hủy'
        );


    public function scopeSearch($query, $search = '', $field = '')
    {
        if (empty($field)) {
            $fields = array('question');
        } else {
            $fields = explode(',', $field);
        }
        $search = str_replace('%', '\%', $search);
        return $query->where(function ($q) use ($search, $fields) {
            if (!empty($fields)) {
                foreach ($fields as $value) {
                    $array_search = explode('"', $search);
                    foreach ($array_search as $k => $str) {
                        if (!empty($str)) {
                            if ($k % 2 == 1) {
                                $q->orWhere($value, $str);
                            } else {
                                $q->orWhere($value, 'like', '%' . $str . '%');
                            }
                        }
                    }
                }
            }
        });
    }

    public function scopePagination($query, $itemPerPages, $currentPage)
    {
        return $query->take($itemPerPages)->skip($itemPerPages * ($currentPage - 1));
    }

}
