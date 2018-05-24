<?php

namespace App\Models\DataTax;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalInfor extends Model
{
    use SoftDeletes;

    protected $table      = 'personal_info';
    protected $primaryKey = 'id';

    protected $fillable = [ 'phone', 'name', 'gender', 'birth', 'home_address'];


}
