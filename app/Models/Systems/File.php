<?php

namespace App\Models\Systems;

use Illuminate\Database\Eloquent\Model;

class File extends Model {
    protected $table      = 'files';
    protected $primaryKey = 'id';

    public $fillable = [
        'real_name',
        'file_url',
        'filename_in_folder',
        'file_type',
        'created_by',
        'file_size',
        'company_id',
    ];

    public function scopeCompany($query, $company_id) {
        return $query->where('company_id', $company_id);
    }
}
