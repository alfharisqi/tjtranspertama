<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User; 

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
     */
    public function boot(): void
    {
        $this->registerPolicies();
    
        Gate::define('isAdmin', function (User $user) {
            return $user->isAdmin(); // Misalnya, method isAdmin() ada di model User
        });
    
        Gate::define('isCustomer', function (User $user) {
            return $user->isCustomer(); // Misalnya, method isCustomer() ada di model User
        });
    }
}
