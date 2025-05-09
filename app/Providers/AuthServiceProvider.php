<?php

namespace App\Providers;
use Laravel\Passport\Passport;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
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
        //
        Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');

        passport::personalAccessTokensExpireIn(now()->addMonths());
    }
}
