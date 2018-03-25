<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Partner extends Model {
    use Searchable;
    use SoftDeletes;

    protected $table      = 'partners';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'phone', 'detail', 'image_url', 'category_id', 'created_by', 'updated_by'];

    public static $rules = [
        'name'   => 'required|max:250',
        'email'  => 'required|max:50',
        'phone'  => 'required|max:20',
        'detail' => 'required',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá :max ký tự.',
    ];
    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo('App\Models\Partner\PartnerCategory');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs() {
        return 'partner_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        $array = $this->toArray();
        $array['partner'] = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'detail' => $this->detail,
        ];
        return $array;
    }
}
