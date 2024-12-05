<?php

namespace SheavesCapital\TwilioVerify\Tests\Feature;

use SheavesCapital\TwilioVerify\DTO\Carrier;
use SheavesCapital\TwilioVerify\DTO\Lookup;
use SheavesCapital\TwilioVerify\DTO\SendCodeAttempt;
use SheavesCapital\TwilioVerify\DTO\Verification;
use SheavesCapital\TwilioVerify\DTO\VerificationCheck;
use SheavesCapital\TwilioVerify\Tests\TestCase;

class DTOTest extends TestCase
{
    /** @test */
    public function it_does_create_a_fake_send_code_attempt()
    {
        $attempt = SendCodeAttempt::fake();

        $this->assertInstanceOf(SendCodeAttempt::class, $attempt);
    }

    /** @test */
    public function it_does_create_a_fake_lookup()
    {
        $lookup = Lookup::fake();

        $this->assertInstanceOf(Lookup::class, $lookup);
        $this->assertInstanceOf(Carrier::class, $lookup->carrier);
    }

    /** @test */
    public function it_does_create_a_fake_verification_start()
    {
        $verification = Verification::fake();

        $this->assertInstanceOf(Verification::class, $verification);
    }

    /** @test */
    public function it_does_create_a_fake_verification_check()
    {
        $verification = VerificationCheck::fake();

        $this->assertInstanceOf(VerificationCheck::class, $verification);
    }
}
