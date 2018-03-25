<?php

namespace App\Models\News;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model {
    use SoftDeletes,
        Sluggable;

    protected $table      = 'news_categories';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'type', 'created_by'];

    public static $rules = [
        'name' => 'required|max:250',
    ];

    public static $messages = [
        'required' => ':attribute không được để trống.',
        'max'      => ':attribute không quá 255 ký tự.',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function news() {
        return $this->hasMany('App\Models\News\News', 'category_id');
    }

    public static function getTableName() {
        return with(new static )->getTable();
    }

    public function scopeSlug($query, $slug) {
        return $query->where('slug', $slug);
    }
}
