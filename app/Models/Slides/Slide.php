<?php

namespace App\Models\Slides;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use SoftDeletes;

    protected $table = 'slides';

    public $fillable = [
        'name', 'description', 'type', 'image_url'
    ];

    protected $dates = ['deleted_at'];
    //
}
