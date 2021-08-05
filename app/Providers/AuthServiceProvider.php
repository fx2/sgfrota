<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isMasterOrAdmin', function($user){
            if ($user->type == 'master' OR $user->type == 'admin')
                return true;
        });

        Gate::define('isMaster', function($user){
            if ($user->type == 'master')
                return true;
        });

        Gate::define('checksetor', 'App\Policies\CheckSetorPolicy@checksetor');

    }
}
