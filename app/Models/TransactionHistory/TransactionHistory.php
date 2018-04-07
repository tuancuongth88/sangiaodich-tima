<?php

namespace App\Models\TransactionHistory;

use App\Models\FeeDiscountConfig\FeeDiscountConfig;
use App\Models\FeeService\FeeService;
use App\Models\Services\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TransactionHistory extends Model
{
    use SoftDeletes;

    const STATUS_APPROVE = 4;
    const STATUS_WAIT = 1;
    const STATUS_RECEIVED = 2;
    const STATUS_BORROWING = 3;
    const STATUS_CANCEL = 5;

    protected $table = 'transaction_history';
    protected $primaryKey = 'id';

    public $fillable = [
        'trans_id', 'service_id', 'customer_name', 'customer_mobile', 'user_id', 'city_id', 'ward_id', 'district_id,amount', 'amount_day', 'payment_day', 'status', 'created_time', 'telesales_id', 'telesales_time', 'sales_id',
        'sales_time', 'fee', 'fee_type', 'percent_discount'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User', 'user_id', 'id');
    }

    public function userVay(){
        return $this->belongsTo('App\Models\Users\User', 'user_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Services\Service', 'service_id');
    }


    public function city()
    {
        $city = ['name' => null, 'depth' => null, 'tid' => null, 'parent1' => null, 'parent2' => null];
        if ($this->city_id) {
            $data = getLocation($this->city_id);
            return $data ? (object)$data : $city;
        }
        return (object)$city;
    }

    public function district()
    {
        $district = ['name' => null, 'depth' => null, 'tid' => null, 'parent1' => null, 'parent2' => null];
        if ($this->district_id) {
            $data = !empty($this->city_id) ? getLocation($this->district_id, $this->city_id) : getLocation($this->district_id);
            return $data ? (object)$data : $district;
        }
        return (object)$district;
    }

    public function ward()
    {
        $ward = ['name' => null, 'depth' => null, 'tid' => null, 'parent1' => null, 'parent2' => null];
        if ($this->ward_id) {
            $data = ($this->city_id) ? getLocation($this->ward_id, $this->city_id) : getLocation($this->ward_id);
            return $data ? (object)$data : $ward;
        }
        return (object)$ward;
    }

    //1 ch
    public $status_transactionhistory =
        array(
            1 => 'Chờ nhận',
            2 => 'Đã nhận',
            3 => 'Đang vay',
            4 => 'Đã tất toán',
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
