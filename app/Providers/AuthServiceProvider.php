<?php

namespace App\Providers;

use App\Models\Transplantation;
use App\Policies\TransplantationPolicy;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Transplantation::class => TransplantationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

        Gate::before(function ($user) {
            return $user->isSuperAdmin() ? true : null;
        });

        Passport::routes();
        Passport::personalAccessTokensExpireIn(Carbon::now()->addHours(12));
    }
}
