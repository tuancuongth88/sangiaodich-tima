<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ListsEloquent extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Builder::macro("lists", function ($column, $key = null) {
            return $this->pluck($column, $key)->all();
        });

        QueryBuilder::macro("lists", function ($column, $key = null) {
            return $this->pluck($column, $key)->all();
        });
    }
}
