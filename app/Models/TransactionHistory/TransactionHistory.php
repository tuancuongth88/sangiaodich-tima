<?php

namespace App\Models\TransactionHistory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Model {
    use SoftDeletes;

    protected $table      = 'transaction_history';
    protected $primaryKey = 'id';

    public $fillable = [
        'trans_id', 'service_code', 'customer_name', 'customer_mobile', 'user_id', 'city_id', 'ward_id', 'district_id,amount', 'amount_day', 'payment_day', 'status', 'created_time', 'telesales_id', 'telesales_time', 'sales_id',
        'sales_time', 'fee', 'fee_type', 'percent_discount',
    ];

    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\Models\Users\User', 'user_id', 'id');
    }

    public function userVay() {
        return $this->belongsTo('App\Models\Users\User', 'user_id', 'id');
    }

    public function service() {
        return $this->belongsTo('App\Models\Services\Service', 'service_code');
    }

    public function city() {
        $city = ['name' => null, 'depth' => null, 'tid' => null, 'parent1' => null, 'parent2' => null];
        if ($this->city_id) {
            $data = getLocation($this->city_id);
            return $data ? (object) $data : $city;
        }
        return (object) $city;
    }

    public function district() {
        $district = ['name' => null, 'depth' => null, 'tid' => null, 'parent1' => null, 'parent2' => null];
        if ($this->district_id) {
            $data = !empty($this->city_id) ? getLocation($this->district_id, $this->city_id) : getLocation($this->district_id);
            return $data ? (object) $data : $district;
        }
        return (object) $district;
    }

    public function ward() {
        $ward = ['name' => null, 'depth' => null, 'tid' => null, 'parent1' => null, 'parent2' => null];
        if ($this->ward_id) {
            $data = ($this->city_id) ? getLocation($this->ward_id, $this->city_id) : getLocation($this->ward_id);
            return $data ? (object) $data : $ward;
        }
        return (object) $ward;
    }

    //1 ch
    public $status_transactionhistory =
    array(
        TRAN_STATUS_WAIT      => 'Chờ nhận',
        TRAN_STATUS_RECEIVED  => 'Đã nhận',
        TRAN_STATUS_BORROWING => 'Đang vay',
        TRAN_STATUS_APPROVE   => 'Đã tất toán',
        TRAN_STATUS_CANCEL    => 'Đã hủy',
    );

    public function scopeSearch($query, $search = '', $field = '') {
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

    public function scopePagination($query, $itemPerPages, $currentPage) {
        return $query->take($itemPerPages)->skip($itemPerPages * ($currentPage - 1));
    }

}
