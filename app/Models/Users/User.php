<?php

namespace App\Models\Users;

use App\Models\Relation as RelationModel;

use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,
        SoftDeletes;

    const NAM = 1;
    const NU = 2;

    public $genderList =
    array(
        self::NAM   => 'Nam',
        self::NU    => 'Nữ',
    );
    
    /**
     * The event map for the model.
     *
     * @var array
     * @author tantan
     */
    protected $dispatchesEvents = [
        // 'retrieved' => Name_Of_Event::class, // fire when an existing model is retrieved from the database
        // 'creating' => Name_Of_Event::class, // a new model is saved for the first time
        // 'created' => Name_Of_Event::class, // a new model is saved for the first time
        // 'updating' => Name_Of_Event::class,
        // 'updated' => Name_Of_Event::class,
        // 'saving' => Name_Of_Event::class,
        // 'saved' => Name_Of_Event::class,
        // 'deleting' => Name_Of_Event::class,
        // 'deleted' => Name_Of_Event::class,
        // 'restoring' => Name_Of_Event::class,
        // 'restored' => Name_Of_Event::class,
    ];

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
        'card_number',
        'personal_records',
        'profile_residence',
        'income_records'
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

    /*
    |----------------------------------------------------------
    | List Job
    |----------------------------------------------------------
    | @params
    | @return array
    | @author: Phuonglv
    */
    public $listJob = array(
        1 => 'Nhân viên văn phòng',
        2 => 'Nhân viên nhà nước',
        3 => 'Kinh doanh tự do',
        4 => 'Công nhân nhà máy',
        5 => 'Doanh nghiệp tư nhân',
        6 => 'Hộ kinh doanh cá thể',
        7 => 'Ngành nghề khác'
    );

    /*
    |----------------------------------------------------------
    | GET SERVICE LIST OF AN USER
    |----------------------------------------------------------
    | @params
    | @return array of service id
    | @author: tantan
    */
    public function services(): array
    {
        $list = \Common::getServicesOfUser($this->id);
        return $list;
    }

    /*
    |----------------------------------------------------------
    | GET DISTRICT LIST OF AN USER
    |----------------------------------------------------------
    | @params
    | @return array of location id
    | @author: tantan
    */
    public function locations(): array
    {
        $list = \Common::getDistrictsOfUser($this->id);
        if (!empty($this->district_id) && !in_array($this->district_id, $list)) {
            $list[] = $this->district_id;
        }
        return $list;
    }

    /*
    |----------------------------------------------------------
    | SAVE SERVICE LIST TO AN USER
    |----------------------------------------------------------
    | @params
    | @return array of service id
    | @author: tantan
    */
    public function saveServices(array $services = [])
    {
        RelationModel::where('source_table', 'users')
            ->where('source_id', $this->id)
            ->where('target_table', 'services')
            ->forceDelete();
        $_return = [];
        foreach ($services as $value) {
            $_return[] = RelationModel::create([
                'source_table' => 'users',
                'source_id' => $this->id,
                'target_table' => 'services',
                'target_id' => $value,
            ])->target_id;
        }
        return $_return;
    }

    /*
    |----------------------------------------------------------
    | SAVE DISTRICT LIST TO AN USER
    |----------------------------------------------------------
    | @params
    | @return array of location id
    | @author: tantan
    */
    public function saveLocations(array $locations = [])
    {
        RelationModel::where('source_table', 'users')
            ->where('source_id', $this->id)
            ->where('target_table', 'locations')
            ->forceDelete();
        $_return = [];
        foreach ($locations as $value) {
            $_return[] = RelationModel::create([
                'source_table' => 'users',
                'source_id' => $this->id,
                'target_table' => 'locations',
                'target_id' => $value,
            ])->target_id;
        }
        return $_return;
    }

}
