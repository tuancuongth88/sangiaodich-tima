<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class PartnerCategory extends Model {
    use Searchable;
    use SoftDeletes;

    protected $table      = 'partner_categories';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'created_by', 'updated_by'];

    protected $dates = ['deleted_at'];

    public static $rules = [
        'name' => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá 255 ký tự.',
    ];

    public function partner() {
        return $this->hasMany('App\Models\Partner\Partner', 'category_id');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs() {
        return 'partner_category_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        $array = $this->toArray();
        // $array['partner-category'] = [
        //     'name' => $this->name,
        // ];
        return $array;
    }
}
