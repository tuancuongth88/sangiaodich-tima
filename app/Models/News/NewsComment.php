<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsComment extends Model {
    use SoftDeletes;
    protected $table      = 'news_comments';
    protected $primaryKey = 'id';

    protected $fillable = ['comment', 'news_id', '', 'created_by'];
}
