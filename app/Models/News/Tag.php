<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
    use SoftDeletes;

    protected $fillable = [
        'news_id',
        'tag',
    ];

    public function news() {
        return $this->belongsTo('App\Models\News\News');
    }
}
