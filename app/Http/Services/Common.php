<?php namespace Custom\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Services\Service as ServiceModel;

class Common {

    private $currentUser;

    public function __construct(Auth $auth){
        $this->currentUser = Auth::user();
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
    public static function getDisplayNameUser(){
        $user = Auth::user();
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
    | @return array of service Models
    | @author: tantan
    */
    public static function getServicesOfUser($uid){
        $services = ServiceModel::lists('service_name', 'id');
        return $services;
    }

}