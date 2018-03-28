<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Services extends Model
{
    //
    use Notifiable,
        SoftDeletes;

    const UNACCEPT = 0;
    const ACCEPTED = 1;
    const DRAFT = 2;
    const ONE = 1;
    const ZERO = 0;

    protected $table = 'services';
    protected $primaryKey = 'id';

    protected $fillable = ['service_name', 'status', 'image_url'];

    public static $rules = [
        'service_name' => 'required',
    ];

    public static $messages = [
        'service_name' => ':attribute không được để trống.',
    ];

    protected $dates = ['deleted_at'];


    public function scopePagination($query, $itemPerPages, $currentPage)
    {
        return $query->take($itemPerPages)->skip($itemPerPages * ($currentPage - 1));
    }
}
