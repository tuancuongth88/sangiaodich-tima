<?php namespace App\Models\Systems;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Department extends Model {
    use SoftDeletes,
        Searchable;

    protected $table = 'departments';

    public $fillable = [
        'name',
        'created_by',
        'branch_id',
        'updated_by',
        'company_id',
    ];

    protected $dates = ['deleted_at'];

    public function scopeCompany($query, $company_id) {
        return $query->where('company_id', $company_id);
    }

    public static function getTableName() {
        return with(new static )->getTable();
    }

    public static $rules = [
        'name'      => 'required|max:250',
        'branch_id' => 'required',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá 250 ký tự.',
    ];

}
