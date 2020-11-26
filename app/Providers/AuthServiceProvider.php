<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;
use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_customer', function ($user) {
            return Auth::check() && $user->role === 'customer';
        });

        Gate::define('is_admin', function ($user) {
            return Auth::check() && $user->role === 'admin';
        });

        Gate::define('customer_can', function ($user, $user_id) {
            return $user->id === $user_id;
        });
    }
}
