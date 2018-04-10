<?php

namespace App\Models\Users;

use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'fullname',
        'email',
        'password',
        'address',
        'birthday',
        'gender',
        'phone',
        'avatar',
        'identity',
        'city_id',
        'district_id',
        'ward_id',
        'type',
        'sex',
        'amount',
        'job',
        'company_name',
        'company_phone',
        'company_address',
        'card_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPassWordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = \Carbon\Carbon::parse($value);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function token()
    {
        return $this->hasMany('App\Models\Users\UserToken', 'user_id');
    }

    public function getBirthdayAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function scopeSearch($query, $search = '', $field = '')
    {
        if (empty($field)) {
            $fields = array('fullname', 'email', 'phone');
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

    //list job default
    public $listJob = array(
        1 => 'Nhân viên văn phòng',
        2 => 'Nhân viên nhà nước',
        3 => 'Kinh doanh tự do',
        4 => 'Công nhân nhà máy',
        5 => 'Doanh nghiệp tư nhân',
        6 => 'Hộ kinh doanh cá thể',
        7 => 'Ngành nghề khác'
    );

}
