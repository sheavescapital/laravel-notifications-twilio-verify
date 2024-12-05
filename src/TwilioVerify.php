<?php

namespace SheavesCapital\TwilioVerify;

use Illuminate\Support\Facades\Http;
use SheavesCapital\TwilioVerify\DTO\VerificationCheck;
use SheavesCapital\TwilioVerify\DTO\VerificationStart;
use SheavesCapital\TwilioVerify\Events\TwilioVerifyResponseLog;

class TwilioVerify
{
    public function start(string $to, string $channel = 'sms'): VerificationStart
    {
        // https://verify.twilio.com/v2/Services/VAXXXXXXXXXX/Verifications
        $url = sprintf(
            '%s/%s/Verifications',
            config('twilio_verify.url'),
            config('twilio_verify.service_sid'),
        );

        $response = Http::asForm()
            ->withBasicAuth(
                config('twilio_verify.account_sid'),
                config('twilio_verify.auth_token'),
            )
            ->post($url, ['To' => $to, 'Channel' => $channel]);

        event(new TwilioVerifyResponseLog($response));

        $data = $response->throw()->json();

        return VerificationStart::fromJson($data);
    }

    public function check(string $to, string $code): VerificationCheck
    {
        // https://verify.twilio.com/v2/Services/VAXXXXXXXXXX/VerificationCheck
        $url = sprintf(
            '%s/%s/VerificationCheck',
            config('twilio_verify.url'),
            config('twilio_verify.service_sid'),
        );

        $response = Http::asForm()
            ->withBasicAuth(
                config('twilio_verify.account_sid'),
                config('twilio_verify.auth_token'),
            )
            ->post($url, ['To' => $to, 'Code' => $code]);

        event(new TwilioVerifyResponseLog($response));

        $data = $response->throw()->json();

        return VerificationCheck::fromJson($data);
    }
}
