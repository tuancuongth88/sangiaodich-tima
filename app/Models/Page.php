<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Page extends Model
{
    use Sluggable;
    use SoftDeletes;
    use SluggableScopeHelpers;

    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'body', 'author', 'slug', 'created_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     * @author tantan
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Admins\Admin', 'author','id');
    }
}
