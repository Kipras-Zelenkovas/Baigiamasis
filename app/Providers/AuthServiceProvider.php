<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Products;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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


        ResetPassword::createUrlUsing(function ($user, string $token) {
            return 'http://127.0.0.1:8000/reset-password/token='.$token.'?email='. $user->email;
        });

        $this->registerPolicies();

        Gate::define('isAdmin', function(User $user){
            return $user->roles_id === 1;
        });

        Gate::define('modify', function(User $user, Products $product){
            return $user->roles_id === 1 || $user->id === $product->user_id;
        });
    }
}
