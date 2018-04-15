<?php

namespace App\Models\News;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model {
    use SoftDeletes,
        Sluggable;

    const UNACCEPT = 0;
    const ACCEPTED = 1;
    const DRAFT    = 2;
    const ONE      = 1;
    const ZERO     = 0;

    const TYPE_NEWS = 1;
    const TYPE_ABOUT = 2;
    const TYPE_NOTIFICATION = 3;

    protected $table      = 'news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'url',
        'content',
        'type',
        'category_id',
        'status',
        'created_by',
        'company_id',
        'is_comment',
        'title_meta',
        'description_meta',
        'keyword_meta',
        'send_at',
        'author',
        'is_hot',
        'position',
    ];

    public static $rules = [
        'title'       => 'required',
        'author'      => 'required',
        'category_id' => 'required',
    ];

    public static $messages = [
        'title' => ':attribute không được để trống.',
    ];

    protected $dates = ['deleted_at'];

    public function setSendAtAttribute($value) {
        $this->attributes['send_at'] = \Carbon\Carbon::parse($value);
    }

    public function getSendAtAttribute($value) {
        return date('d-m-Y H:i', strtotime($value));
    }

    public function scopeSearch($query, $search = '', $field = '') {
        if (empty($field)) {
            $fields = array('title', 'description', 'content');
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

    public function scopePagination($query, $itemPerPages, $currentPage) {
        return $query->take($itemPerPages)->skip($itemPerPages * ($currentPage - 1));
    }

    public function scopeCategory($query, $categoryId) {
        return $query->where('category_id', $categoryId);
    }

    // public function getSendAtAttribute($value) {
    //     return date('d-m-Y H:i', strtotime($value));
    //     // return App\Models\Users\User::find($)
    // }

    public function getAuthor() {
        return $this->hasOne('App\Models\Users\User', 'id', 'author')->where('active', self::ONE);

    }

    public function user() {
        return $this->belongsTo('App\Models\Users\User', 'author', 'id');
    }

    public function scopeApprove($query) {
        return $query->where('is_approve', self::ONE);
    }

    public function scopeSlug($query, $slug) {
        return $query->where('slug', $slug);
    }

    public function tags() {
        return $this->hasMany('App\Models\News\Tag');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
