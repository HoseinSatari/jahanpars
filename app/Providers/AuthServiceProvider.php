<?php

namespace App\Providers;


use App\permission;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function ($user){
            if ($user->issuperuser()) return true;
        });
        $this->registerPolicies();

        foreach (permission::all() as $permission){
            Gate::define($permission->name , function ($user) use ($permission){
                return $user->haspermission($permission);
            });
        }
    }
}
