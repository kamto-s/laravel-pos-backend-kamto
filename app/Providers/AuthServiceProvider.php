<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public static $permission = [
        'dashboard' => ['ADMIN', 'STAFF'],
        'user-index' => ['STAFF'],
    ];
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        foreach(self::$permission as $feature => $roless) {
            Gate::define($feature, function(User $user) use ($roless){
                if (in_array($user->roles, $roless)) {
                    return true;
                }
            });
        }


    }
}
