<?php

namespace SheavesCapital\TwilioVerify;

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
}
