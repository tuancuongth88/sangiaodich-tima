<?php

namespace App\Models\Contacts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
class Contact extends Model {
    use Searchable;
    use SoftDeletes;

    protected $table      = 'contact_form';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'phone', 'address', 'description'];

    public static $rules = [
        'name' => 'required|max:250',
        'email'     => 'required|max:250',
        'phone'     => 'required|max:250',
        'address'     => 'required|max:250',
        'description'         => 'required',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá :max ký tự.',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'contact_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
