<?php

namespace SheavesCapital\TwilioVerify\Facades;

use Illuminate\Support\Facades\Facade;
use SheavesCapital\TwilioVerify\DTO\VerificationCheck;
use SheavesCapital\TwilioVerify\DTO\VerificationStart;

/**
 * @method static VerificationStart start(string $to)
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
