<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Service extends Model
{
    //
    use Notifiable;
    use Sluggable;
    use SoftDeletes;
    use SluggableScopeHelpers;

    const UNACCEPT = 0;
    const ACCEPTED = 1;
    const DRAFT = 2;
    const ONE = 1;
    const ZERO = 0;

    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = ['service_name', 'status', 'image_url', 'icon_url', 'day_detail', 'amount_detail'];

    public static $rules = [
        'service_name' => 'required',
    ];

    public static $messages = [
        'service_name' => ':attribute không được để trống.',
    ];

    protected $dates = ['deleted_at'];


    public function scopePagination($query, $itemPerPages, $currentPage)
    {
        return $query->take($itemPerPages)->skip($itemPerPages * ($currentPage - 1));
    }

    public function feeservice()
    {
        return $this->hasOne('App\Models\FeeService', 'service_id','id');
    }

    public function feediscountconfig()
    {
        return $this->belongsTo('App\Models\FeeDiscountConfig', 'service_id','id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     * @author tantan
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'service_name'
            ]
        ];
    }

    /*
    |----------------------------------------------------------
    | Get day detail config of a service
    |----------------------------------------------------------
    | @params string
    | @return array
    | @author: tantan
    */
    public function day_config(){
        return \Common::getServiceDayDetail($this->day_detail);
    }

    /*
    |----------------------------------------------------------
    | Get amount detail config of a service
    |----------------------------------------------------------
    | @params string
    | @return array
    | @author: tantan
    */
    public function amount_config(){
        $_return = [];
        $amountDetail = $this->amount_detail ?? \Common::SERVICE_AMOUNT_DETAIL;
        $_exp = explode(',', $amountDetail);
        foreach ($_exp as $value) {
            $value = ((int)$value)*1000000;
            $_return[] = ['number' => $value, 'text' => VndTextSummary($value)];
        }
        return $_return;
    }
}
