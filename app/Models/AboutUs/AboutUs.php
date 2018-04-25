<?php

namespace App\Models\AboutUs;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table      = 'about_us';
    public $fillable = ['title', 'description'];

    protected $dates = ['deleted_at'];
}
