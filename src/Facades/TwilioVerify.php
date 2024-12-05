<?php

namespace SheavesCapital\TwilioVerify\Facades;

use Illuminate\Support\Facades\Facade;
use SheavesCapital\TwilioVerify\DTO\Verification;
use SheavesCapital\TwilioVerify\DTO\VerificationCheck;

/**
 * @method static Verification start(string $to, string $channel = 'sms', ?string $code = null)
 * @method static Verification update(string $to, string $status = 'approved')
 * @method static VerificationCheck check(string $to, string $code)
 *
 * @see \SheavesCapital\TwilioVerify\TwilioVerify
 */
class TwilioVerify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SheavesCapital\TwilioVerify\TwilioVerify::class;
    }
}
