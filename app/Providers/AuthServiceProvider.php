<?php

namespace App\Providers;

use App\Model\News\News;
use App\Policies\NewsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        News::class => NewsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
        // Gate::define('update-news', 'App\Policies\NewsPolicy@update');
        Gate::resource('news', 'App\Policies\NewsPolicy');
    }
}
