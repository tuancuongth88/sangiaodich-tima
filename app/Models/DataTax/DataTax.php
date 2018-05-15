<?php

namespace App\Models\DataTax;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataTax extends Model
{
    use SoftDeletes;

    protected $table      = 'data_tax';
    protected $primaryKey = 'id';

    protected $fillable = [ 'masothue','ngaycap','tenchinhthuc','tengiaodich','noidangkyquanly','diachitruso',
                            'noidangkynopthue','diachinhanthongbaothe','qdtlngaycap','coquanraquyetdinh','gpkdngaycap',
                            'coquancap','ngaynhantokha','ngaybatdautaichinh','ngayketthuctaichinh','masohientai','chuong',
                            'hinhthuchtoan','pptinhthuegtgt','chuohu_nguoidaidien','diachi_chuohu_nguoidaidien','tengiamdoc',
                            'diachigiamdoc','ketoantruong','diachiketoantruong', 'phone_company', 'email', 'type', 'x1', 'x2', 'x3', 'x4', 'x5', ];

    public static $rules = [
        'masothue' => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá :max ký tự.',
    ];

    const JOINT_STOCK_COMPANIES = 1;
    const NON_STOCK_ENTERPRISES = 2;
    const ENTERPRISES_OTHER = 3;

    public static $listType = [
        self::JOINT_STOCK_COMPANIES => 'Doanh nghiệp đã cổ phần',
        self::NON_STOCK_ENTERPRISES => 'Doanh nghiệp chưa cổ phần',
        self::ENTERPRISES_OTHER     => 'Doanh nghiệp khác',
    ];

    /*
     * 2.99 an toan
     * 1.6 - 2.99 canh cao
     * < 1.8 nguy co pha san cao
     * */
    public static $joint_stock_companies = [
        'x1' => 1.2,
        'x2' => 1.4,
        'x3' => 3.3,
        'x4' => 0.64,
        'x5' => 0.999,
    ];

    /*
     * > 2.6 an toan
     * 1.23 - 2.9 Nguy cơ phá sản cấp đỏ cảnh báo
     * < 1.23  Nguy cơ phá sản cấp đỏ cao
     * */
    public static $non_stock_enterprises = [
        'x1' => 0.717,
        'x2' => 0.847,
        'x3' => 3.107,
        'x4' => 0.42,
        'x5' => 0.998,
    ];

    /*
     * > 2.6 => An toan
     * 1.2 - 2.6 Nguy cơ phá sản cấp đỏ cảnh báo
     * < 1.1 nguy cơ phá sản cao
     * */
    public static $enterprises_other = [
        'x1' => 6.56,
        'x2' => 3.26,
        'x3' => 6.72,
        'x4' => 1.05,
    ];

    protected $dates = ['deleted_at'];


    public function checkEnterpriseLevel($type){
        if($type == self::JOINT_STOCK_COMPANIES){
            $result = (self::$joint_stock_companies['x1'] * $this->x1) + (self::$joint_stock_companies['x2'] * $this->x2)+ (self::$joint_stock_companies['x3'] * $this->x3) + (self::$joint_stock_companies['x4'] * $this->x4) + (self::$joint_stock_companies['x5'] * $this->x5);
            if($result > 2.99){
                return 'An Toàn';
            }
            if($result >= 1.8){
                return 'Cảnh báo';
            }
            if($result < 1.8){
                return 'Nguy hiểm';
            }
        }
        if($type == self::NON_STOCK_ENTERPRISES){
            $result = (self::$non_stock_enterprises['x1'] * $this->x1) + (self::$non_stock_enterprises['x2'] * $this->x2)+ (self::$non_stock_enterprises['x3'] * $this->x3) + (self::$non_stock_enterprises['x4'] * $this->x4) + (self::$non_stock_enterprises['x5'] * $this->x5);
            if($result > 2.9){
                return 'An Toàn';
            }
            if($result >= 1.23){
                return 'Cảnh báo';
            }
            if($result < 1.23){
                return 'Nguy hiểm';
            }
        }
        if ($type == self::ENTERPRISES_OTHER){
            $result = (self::$enterprises_other['x1'] * $this->x1) + (self::$enterprises_other['x2'] * $this->x2)+ (self::$enterprises_other['x3'] * $this->x3) + (self::$enterprises_other['x4'] * $this->x4);
            if($result > 2.6){
                return 'An Toàn';
            }
            if($result >= 1.2){
                return 'Cảnh báo';
            }
            if($result < 1.11){
                return 'Nguy hiểm';
            }
        }
    }
}
