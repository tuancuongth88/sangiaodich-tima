<?php

namespace App\Models\Faqs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    public $fillable = [
        'category_id', 'question', 'answer', 'created_by', 'updated_by',
    ];

    protected $dates = ['deleted_at'];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static $rules = [
        'question' => 'required|max:250',
        'category_id' => 'required',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max' => ':attribute không quá 255 ký tự.',
    ];

    public function scopeSearch($query, $search = '', $field = '')
    {
        if (empty($field)) {
            $fields = array('question');
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

    public function scopePagination($query, $itemPerPages, $currentPage)
    {
        return $query->take($itemPerPages)->skip($itemPerPages * ($currentPage - 1));
    }

    public function scopeCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
