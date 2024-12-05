<?php

namespace SheavesCapital\TwilioVerify;

use Illuminate\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TwilioVerifyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-notifications-twilio-verify')
            ->hasConfigFile('twilio_verify');
    }

    public function packageRegistered()
    {
        $this->app->singleton(TwilioVerifyChannel::class, fn (Application $app) => new TwilioVerifyChannel($app->make(TwilioVerify::class)));
    }
}
