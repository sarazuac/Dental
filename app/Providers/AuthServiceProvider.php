<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        // the gate checks if the user is an admin or a superadmin
        Gate::define('accessAdmin', function($user) {

            echo Auth::user()->hasRole('Admin');

            if(Auth::user()->hasRole('Admin')){
                return $user;
            }
         

          //  return $user->hasRole('Admin');
        });

        // // the gate checks if the user is a member
        // Gate::define('accessProfile', function($user) {
        //     return $user->role('member');
        // });
    }
}
