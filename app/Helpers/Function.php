<?php
function safestrtotime($s) {
    $basetime = 0;
    if (preg_match("/19(\d\d)/", $s, $m) && ($m[1] < 70)) {
        $s        = preg_replace("/19\d\d/", 1900 + $m[1] + 68, $s);
        $basetime = 0x80000000 + 1570448;
    }
    return $basetime + strtotime($s);
}

function stringToDate($var) {
    if (!empty($var)) {
        return implode("-", array_reverse(explode("/", $var)));
    } else {
        return $var;
    }

}

function dateToString($date = '') {
    if ($date != '' AND $date != '0000-00-00') {
        return date("d/m/Y", safestrtotime($date));
    } else {
        return $date;
    }
}

function dateToStringY($date = '') {
    if ($date != '' AND $date != '0000-00-00') {
        return date("d/m/y", safestrtotime($date));
    } else {
        return $date;
    }
}

function dateToTime($var) {
    if (!empty($var)) {
        return safestrtotime(implode("-", array_reverse(explode("/", $var))));
    } else {
        return $var;
    }
}

function dateTimeToTime($var) {
    if (!empty($var)) {
        $dateTime = explode('-', str_replace(' ', '', $var));
        return safestrtotime(implode("-", array_reverse(explode("/", $dateTime[0]))) . ' ' . $dateTime[1]);
    } else {
        return $var;
    }
}

function timeToDate($date = '') {
    if ($date != '') {
        return date("d/m/Y", $date);
    } else {
        return $date;
    }
}

function timeToDateTime($date = '') {
    if ($date != '') {
        return date("d/m/Y - H:i", $date);
    } else {
        return $date;
    }
}
function exportWord($text, $font, $size, $bold) {
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

function VndText($amount) {
    if ($amount <= 0) {
        return $textnumber = "Tiền phải là số nguyên dương lớn hơn số 0";
    }
    $Text        = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
    $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
    $textnumber  = "";
    $length      = strlen($amount);

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

    return ucfirst($textnumber . "đồng chẵn");
}


/*
|--------------------------------------------------------------------------
| GET LOCATION NESTED LIST.
|--------------------------------------------------------------------------
| @return list of location
| @Author : tantan
 */
function getLocationList(){
    if( $exists = Storage::disk('local')->exists('locations.json') ){
        $locationTree = json_decode(Storage::disk('local')->get('locations.json'), true);
        if( is_array($locationTree) ){
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
function getLocationTree(string $parent, $max_depth = 1){
    $_return = [];
    $locationTree = getLocationList();
    foreach ($locationTree as $value) {
        if( $max_depth == 1 ){
            if( $parent != null && (string)$value['parent1'] == (string)$parent ){
                $_return[] = $value;
            }
        }
        else {
            if( $parent != null && (string)$value['parent1'] == $parent | (string)$value['parent2'] == $parent ){
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
function getLocation(string $tid, string $parent = null){
    $locationTree = getLocationList();
    foreach ($locationTree as $value) {
        if( (string)$value['tid'] == $tid && !empty($parent) && ((string)$value['parent1'] == $parent | (string)$value['parent2'] == $parent) ){
            return $value;
        } else if( (string)$value['tid'] == $tid && empty($parent) ){
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
function getCityList(){
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
function getDistrictList(string $city = null){
    $_return = [];
    $locationTree = getLocationList();
    foreach ($locationTree as $value) {
        if( $value['depth'] == 1 ){
            if( $city == null ){
                $_return[$value['tid']] = $value['name'];
            } else if( $value['parent1'] == $city ){
                $_return[$value['tid']] = $value['name'];
            }
        }
    }
    return $_return;
}