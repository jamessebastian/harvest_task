<?php

namespace App\Providers;

use App\User;
use App\Policies\roles;

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
         //'App\Model' => 'App\Policies\ModelPolicy',
//        User::class=>roles::class,
//        'App\Clients'=>'App\Policies\ClientPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();



        Gate::define('is_admin','App\Policies\roles@is_admin');
        Gate::define('edit-users','App\Policies\roles@edit_users');
        Gate::define('manage-users','App\Policies\roles@manage_users');
        Gate::define('delete-users','App\Policies\roles@delete_users');

        Gate::resource('client','App\Policies\ClientPolicy');

    }
}

