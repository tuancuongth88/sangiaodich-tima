<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchNameScope implements Scope {
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model) {
        $fields = array('name');
        $search = '';
        $search = str_replace('%', '\%', $search);
        return $builder->where(function ($q) use ($search, $fields) {
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
}