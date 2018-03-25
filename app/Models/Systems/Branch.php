<?php namespace App\Models\Systems;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Branch extends Model {
    use SoftDeletes,
        Searchable;

    protected $table = 'branches';

    public $fillable = [
        'name', 'created_by', 'updated_by', 'company_id',
    ];

    protected $dates = ['deleted_at'];

    public function scopeCompany($query, $company_id) {
        return $query->where('company_id', $company_id);
    }

    public static function getTableName() {
        return with(new static )->getTable();
    }

    public static $rules = [
        'name' => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá 255 ký tự.',
    ];

    public function searchableAs() {
        return 'branchs_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

}
