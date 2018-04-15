<?php namespace Custom\Services;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Services\Service as ServiceModel;
use App\Models\Users\User as UserModel;
use App\Models\Relation as RelationModel;

class Common {

    private $currentUser;
    private $userModel;


    public function __construct(Auth $auth, UserModel $userModel){
        $this->currentUser = Auth::user();
        $this->userModel = $userModel;
    }

	const SERVICE_DAY_DETAIL = "10days, 20days, 30days, 40days, 50days, 60days, 70days, 80days, 90days";
	const SERVICE_AMOUNT_DETAIL = "5, 10, 15, 20, 25, 30, 35, 40, 45, 50";
	const DAY = 'days';
	const WEEK = 'weeks';
	const MONTH = 'months';
	const YEAR = 'years';
    
    public static function getUnitTimeName(string $str){
    	$str = trim($str);
    	$arr = [
    		self::DAY => 'Ngày',
    		self::WEEK => 'Tuần',
    		self::MONTH => 'Tháng',
    		self::YEAR => 'Năm'
    	];
    	return isset($arr[$str]) ? $arr[$str] : null;
    }

    /*
    |----------------------------------------------------------
    | Get day detail config of a service
    |----------------------------------------------------------
    | @params string
	| @return array
    | @author: tantan
    */
    public static function getServiceDayDetail(string $string = null) : array{
    	// if string is null it will be receive another value
    	$string = $string ?? self::SERVICE_DAY_DETAIL; // Only PHP 7
    	$_exp = explode(",", $string);
    	$_return = [];
    	foreach ($_exp as $value) {
    		$value = trim($value);

    		//// get number of string
    		preg_match( '/[0-9]{0,3}/' , $value, $matches);
    		if( empty($matches[0]) ){
    			continue;
    		}
    		$number = (int)$matches[0];

    		$unit = self::getUnitTimeName(str_replace($number, '', $value));
    		$_return[] = ['number' => $number, 'unit' => str_replace($number, '', $value), 'text' => $unit];
    	}
    	return $_return;
    }

    /*
    |----------------------------------------------------------
    | Get fullname of user
    |----------------------------------------------------------
    | @params
    | @return string
    | @author: tantan
    */
    public static function getDisplayNameUser($user = null){
        if ($user == null){
            $user = Auth::user();
        }
        return $user->fullname ?? $user->phone ?? $user->username;
    }

    /*
    |----------------------------------------------------------
    | GET ALL SERVICE LIST
    |----------------------------------------------------------
    | @params
    | @return array an be provice for select option
    | @author: tantan
    */
    public static function getListServices(){
        $services = ServiceModel::lists('service_name', 'id');
        return $services;
    }

    /*
    |----------------------------------------------------------
    | GET SERVICE LIST OF AN USER
    |----------------------------------------------------------
    | @params
    | @return array of service id
    | @author: tantan
    */
    public static function getServicesOfUser($uid){
        $services = RelationModel::where('source_table', 'users')
            ->where('source_id', $uid)
            ->where('target_table', 'services')->distinct()->lists('target_id');
        return $services;
    }

    /*
    |----------------------------------------------------------
    | GET DISTRICT LIST OF AN USER
    |----------------------------------------------------------
    | @params
    | @return array of location id
    | @author: tantan
    */
    public static function getDistrictsOfUser($uid){
        $services = RelationModel::where('source_table', 'users')
            ->where('source_id', $uid)
            ->where('target_table', 'locations')->distinct()->lists('target_id');
        return $services;
    }

    /*
    |----------------------------------------------------------
    | GET FORM BY SERVICE CODE
    |----------------------------------------------------------
    | @params
    | @return array of form infomation
    | @author: tantan
    */
    public static function getFormOfService($service_slug, $user = null){
        if( $user == null ){
            $user = Auth::user();
        }
        $defaultFields = [
            'user[card_number]' => [
                'type' => 'text',
                'label' => 'CMT',
                'value' => self::getObject($user, 'card_number'),
            ],
            'user[birthday]' => [
                'type' => 'date',
                'label' => 'Ngày sinh',
                'value' => self::getObject($user, 'birthday'),
            ],
            'user[sex]' => [
                'type' => 'radio',
                'data' => [userModel::NAM => 'Nam', userModel::NU => 'Nữ'],
                'label' => 'Giới tính',
                'value' => self::getObject($user, 'sex'),
            ]
        ];
        $defaultFields2 = [
            'user[company_name]' => [
                'type' => 'text',
                'label' => 'Tên công ty',
                'value' => self::getObject($user, 'company_name'),
            ],
            'user[income]' => [
                'type' => 'text',
                'label' => 'Thu nhập',
                'value' => self::getObject($user, 'income'),
            ],
            'user[job]' => [
                'type' => 'select',
                'data' => [
                    1 => 'Nhân viên văn phòng',
                    2 => 'Nhân viên nhà nước',
                    3 => 'Kinh doanh tự do',
                    4 => 'Công nhân nhà máy',
                    5 => 'Doanh nghiệp tư nhân',
                    6 => 'Hộ kinh doanh cá thể',
                    7 => 'Ngành nghề khác'
                ],
                'label' => 'Nghề nghiệp',
                'value' => self::getObject($user, 'job'),
            ],
        ];

        $forms = [

            'vay-tra-gop-theo-ngay' => $defaultFields + $defaultFields2,

            'vay-tin-chap-theo-luong' => $defaultFields + $defaultFields2,

            'vay-theo-so-ho-khau' => $defaultFields + $defaultFields2,

            'vay-theo-hoa-don-dien-nuoc' => $defaultFields + [
                'transaction[electric_bill]' => [
                    'type' => 'text',
                    'label' => 'Tiền điện tháng gần nhất',
                ],
            ],

            'vay-theo-dang-ky-xe-o-to' => $defaultFields + [
                'transaction[car_name]' => [
                    'type' => 'text',
                    'label' => 'Tên xe',
                ],
                'transaction[car_brand]' => [
                    'type' => 'select',
                    'data' => [],
                    'label' => 'Đời xe',
                ],
                'transaction[car_country]' => [
                    'type' => 'select',
                    'data' => [],
                    'label' => 'Xuất xứ',
                ],
            ],

            'vay-theo-dang-ky-xe-may' => $defaultFields + $defaultFields2,

            'vay-mua-oto-tra-gop' => $defaultFields + $defaultFields2,

            'vay-mua-nha-tra-gop' => $defaultFields + [
                'transaction[estate_name]' => [
                    'type' => 'select',
                    'data' => [],
                    'label' => 'Sản phẩm bất động sản cần vay',
                ],
                'user[income]' => [
                    'type' => 'text',
                    'label' => 'Thu nhập',
                    'value' => self::getObject($user, 'income'),
                ],
                'user[income_source]' => [
                    'type' => 'select',
                    'data' => [],
                    'label' => 'Nguồn thu nhập',
                    'value' => self::getObject($user, 'income_source'),
                ],
            ], 

            'vay-cam-co-tai-san' => $defaultFields + [
                'transaction[mortgage]' => [
                    'type' => 'select',
                    'data' => [],
                    'label' => 'Loại tài sản thế chấp',
                ],
                'transaction[mortgage_brand]' => [
                    'type' => 'text',
                    'label' => 'Thương hiệu',
                ],
                'transaction[mortgage_year]' => [
                    'type' => 'text',
                    'data' => [],
                    'label' => 'Năm sản xuất',
                ],
                'transaction[mortgage_note]' => [
                    'type' => 'text',
                    'label' => 'Mô tả',
                ],
            ], 

        ];
        if( isset($forms[$service_slug]) ){
            return $forms[$service_slug];
        }
        return $defaultFields + $defaultFields2;
    }

    /*
    |--------------------------------------------
    | CHECK NULL AND GET OBJECT
    |--------------------------------------------
    | @params object, method, default value return if null
    | @author tantan
    |*/
    public static function getObject($obj, $method, $default = null){
        if( $obj == null ){
            return $default;
        }
        if( $obj->$method == null ){
            return $default;
        }
        return $obj->$method;
    }

}