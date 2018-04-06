<?php namespace Custom\Services;

class Common {
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

}