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
                            'diachigiamdoc','ketoantruong','diachiketoantruong'];

    public static $rules = [
        'masothue' => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá :max ký tự.',
    ];

    protected $dates = ['deleted_at'];
}
