<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCategory extends Model {
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'company_id', 'created_by'];

    public static $rules = [
        'name' => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá 255 ký tự.',
    ];

    protected $dates = ['deleted_at'];

    public static function getTableName() {
        return with(new static )->getTable();
    }

    public function scopeSearch($query, $search = '', $field = '') {
        if (empty($field)) {
            $fields = array('name');
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
}
