<?php

use App\Models\FeeDiscountConfig\FeeDiscountConfig;
use App\Models\FeeService\FeeService;

function safestrtotime($s)
{
    $basetime = 0;
    if (preg_match("/19(\d\d)/", $s, $m) && ($m[1] < 70)) {
        $s = preg_replace("/19\d\d/", 1900 + $m[1] + 68, $s);
        $basetime = 0x80000000 + 1570448;
    }
    return $basetime + strtotime($s);
}

function stringToDate($var)
{
    if (!empty($var)) {
        return implode("-", array_reverse(explode("/", $var)));
    } else {
        return $var;
    }

}

function dateToString($date = '')
{
    if ($date != '' AND $date != '0000-00-00') {
        return date("d/m/Y", safestrtotime($date));
    } else {
        return $date;
    }
}

function dateToStringY($date = '')
{
    if ($date != '' AND $date != '0000-00-00') {
        return date("d/m/y", safestrtotime($date));
    } else {
        return $date;
    }
}

function dateToTime($var)
{
    if (!empty($var)) {
        return safestrtotime(implode("-", array_reverse(explode("/", $var))));
    } else {
        return $var;
    }
}

function dateTimeToTime($var)
{
    if (!empty($var)) {
        $dateTime = explode('-', str_replace(' ', '', $var));
        return safestrtotime(implode("-", array_reverse(explode("/", $dateTime[0]))) . ' ' . $dateTime[1]);
    } else {
        return $var;
    }
}

function timeToDate($date = '')
{
    if ($date != '') {
        return date("d/m/Y", $date);
    } else {
        return $date;
    }
}

function timeToDateTime($date = '')
{
    if ($date != '') {
        return date("d/m/Y - H:i", $date);
    } else {
        return $date;
    }
}

function exportWord($text, $font, $size, $bold)
{
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
//
    //    $section->addText($text);
    //
    //    $section->addText('Hello world! I am formatted.',
    //        array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));

//    $phpWord->addFontStyle('myOwnStyle',
    //        array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
    //    $section->addText('Hello world! I am formatted by a user defined style',
    //        'myOwnStyle');

    $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    $fontStyle->setBold($bold);
    $fontStyle->setName($font);
    $fontStyle->setSize($size);
    $myTextElement = $section->addText($text);
    $myTextElement->setFontStyle($fontStyle);

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('helloWorld.docx');
}

function VndText($amount, string $unit = "đồng chẵn")
{
    if ($amount <= 0) {
        return $textnumber = "Tiền phải là số nguyên dương lớn hơn số 0";
    }
    $Text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
    $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
    $textnumber = "";
    $length = strlen($amount);

    for ($i = 0; $i < $length; $i++) {
        $unread[$i] = 0;
    }

    for ($i = 0; $i < $length; $i++) {
        $so = substr($amount, $length - $i - 1, 1);

        if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)) {
            for ($j = $i + 1; $j < $length; $j++) {
                $so1 = substr($amount, $length - $j - 1, 1);
                if ($so1 != 0) {
                    break;
                }

            }

            if (intval(($j - $i) / 3) > 0) {
                for ($k = $i; $k < intval(($j - $i) / 3) * 3 + $i; $k++) {
                    $unread[$k] = 1;
                }

            }
        }
    }

    for ($i = 0; $i < $length; $i++) {
        $so = substr($amount, $length - $i - 1, 1);
        if ($unread[$i] == 1) {
            continue;
        }

        if (($i % 3 == 0) && ($i > 0)) {
            $textnumber = $TextLuythua[$i / 3] . " " . $textnumber;
        }

        if ($i % 3 == 2) {
            $textnumber = 'trăm ' . $textnumber;
        }

        if ($i % 3 == 1) {
            $textnumber = 'mươi ' . $textnumber;
        }

        $textnumber = $Text[$so] . " " . $textnumber;
    }

    //Phai de cac ham replace theo dung thu tu nhu the nay
    $textnumber = str_replace("không mươi", "lẻ", $textnumber);
    $textnumber = str_replace("lẻ không", "", $textnumber);
    $textnumber = str_replace("mươi không", "mươi", $textnumber);
    $textnumber = str_replace("một mươi", "mười", $textnumber);
    $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
    $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
    $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

    return ucfirst($textnumber . $unit);
}

/*
|----------------------------------------------------------
| Read a number to text summary
|----------------------------------------------------------
| @params $amount integer >= 1000000
| @return string
| @author tantan
|*/
function VndTextSummary($amount): string
{
    if ($amount < 1000000) {
        return '';
    }
    $amount = $amount / 1000000;
    if ($amount < 1000) {
        return $amount . 'tr';
    } else {
        $amount = $amount / 1000;
        return $amount . 'tỷ';
    }
}


/*
|--------------------------------------------------------------------------
| GET LOCATION NESTED LIST.
|--------------------------------------------------------------------------
| @return list of location
| @Author : tantan
 */
function getLocationList()
{
    if ($exists = Storage::disk('local')->exists('locations.json')) {
        $locationTree = json_decode(Storage::disk('local')->get('locations.json'), true);
        if (is_array($locationTree)) {
            return $locationTree;
        }
    }
    return [];
}


/*
|--------------------------------------------------------------------------
| GET CHILD LIST OF A LOCATION.
|--------------------------------------------------------------------------
| @params $parent number, $max_depth number
| @return list of location
| @Author : tantan
 */
function getLocationTree(string $parent, $max_depth = 1)
{
    $_return = [];
    $locationTree = getLocationList();
    foreach ($locationTree as $value) {
        if ($max_depth == 1) {
            if ($parent != null && (string)$value['parent1'] == (string)$parent) {
                $_return[] = $value;
            }
        } else {
            if ($parent != null && (string)$value['parent1'] == $parent | (string)$value['parent2'] == $parent) {
                $_return[] = $value;
            }
        }
    }
    return $_return;
}

/*
|--------------------------------------------------------------------------
| GET LOCATION BY TID.
|--------------------------------------------------------------------------
| @params $tid number, $parent number
| @return list of location
| @Author : tantan
 */
function getLocation(string $tid, string $parent = null)
{
    $locationTree = getLocationList();
    foreach ($locationTree as $value) {
        if ((string)$value['tid'] == $tid && !empty($parent) && ((string)$value['parent1'] == $parent | (string)$value['parent2'] == $parent)) {
            return $value;
        } else if ((string)$value['tid'] == $tid && empty($parent)) {
            return $value;
        }
    }
    return null;
}

/*
|--------------------------------------------------------------------------
| GET LIST OF CITY.
|--------------------------------------------------------------------------
| @return list of location
| @Author : tantan
 */
function getCityList()
{
    $_return = [];
    $locationTree = getLocationTree(0);
    foreach ($locationTree as $value) {
        $_return[$value['tid']] = $value['name'];
    }
    return $_return;
}

/*
|--------------------------------------------------------------------------
| GET LIST OF DISTRICT.
|--------------------------------------------------------------------------
| @return list of location
| @Author : tantan
 */
function getDistrictList(string $city = null)
{
    $_return = [];
    $locationTree = getLocationList();
    foreach ($locationTree as $value) {
        if ($value['depth'] == 1) {
            if ($city == null) {
                $_return[$value['tid']] = $value['name'];
            } else if ($value['parent1'] == $city) {
                $_return[$value['tid']] = $value['name'];
            }
        }
    }
    return $_return;
}

/*
|--------------------------------------------------------------------------
| GET LIST OF WARD.
|--------------------------------------------------------------------------
| @return list of location
| @Author : phuonglv
 */
function getWardList(string $district = null)
{
    $_return = [];
    $locationTree = getLocationList();
    foreach ($locationTree as $value) {
        if ($value['depth'] == 2) {
            if ($district == null) {
                $_return[$value['tid']] = $value['name'];
            } else if ($value['parent1'] == $district) {
                $_return[$value['tid']] = $value['name'];
            }
        }
    }
    return $_return;
}


function substrPhone($phone)
{
    return substr($phone, 0, 3) . "*****" . substr($phone, -3);
}


function minusDay($endDay, $startDay)
{
    $ngay_ket_thuc = strtotime($endDay);
    $ngay_bat_dau = strtotime($startDay);
    $kq = abs($ngay_ket_thuc - $ngay_bat_dau);
    return (floor($kq / (60 * 60 * 24)));

}

function minusDaycount($payment_day, $create_time)
{

    $payment_day = strtotime($payment_day);
    $create_time = strtotime($create_time);
    $kq = abs($payment_day - $create_time);
    return (floor($kq / (60 * 60 * 24)));
}

// to timestam
function convertDate($format, $date)
{
    $date = strtotime($date);
    return date($format, $date);
}

/*
|--------------------------------------------------------------------------
| convert amount
|--------------------------------------------------------------------------
| @return list of location
| @Author : cuongnt
 */
function convertAmount($amount)
{
    if (strlen($amount) < 7) {
        $result = $amount / 100000;
        return $result . ' Trăm nghìn';
    }
    if (strlen($amount) < 10) {
        $result = $amount / 1000000;
        return $result . ' Triệu';
    }
    if (strlen($amount) > 9) {
        $result = $amount / 1000000000;
        return $result . ' Tỷ';
    }
}

/*
|--------------------------------------------------------------------------
| convert amount
|--------------------------------------------------------------------------
| @return list of location
| @Author : cuongnt
 */
function convertFeeDiscount($service_id)
{

    $obj_feeService = null;
    $obj_feeDiscount = null;
    $feeService = FeeService::where('service_id', '=', $service_id)->get()->toArray();
    if (isset($feeService[0]) && !empty($feeService[0])) {
        $obj_feeService = $feeService[0];
    }

    $feeDiscount = FeeDiscountConfig::where('service_id', '=', $service_id)->get()->toArray();
    if (isset($feeDiscount[0]) && !empty($feeDiscount[0])) {
        $obj_feeDiscount = $feeDiscount[0];
    }
    if (!$obj_feeService || !$obj_feeDiscount) {
        return ['fee' => 0, 'fee_service' => 0, 'discount_percent' => 0];
    }

    $fee_service = $obj_feeService['fee'];
    $validate_time = $obj_feeDiscount['validate_time'];
    $expire_time = $obj_feeDiscount['expire_time'];
    $discount_percent = $obj_feeDiscount['discount_percent'];

    $today = date("Y-m-d H:i:s");
    if (($validate_time <= $today) && ($today <= $expire_time)) {
        $fee = ($discount_percent * $fee_service) / 100;
    } else {
        $fee = $fee_service;
    }
    return ['fee' => number_format($fee), 'fee_service' => number_format($fee_service), 'discount_percent' => $discount_percent];

}
