<?php

namespace SheavesCapital\TwilioVerify;

use Illuminate\Support\Facades\Http;
use SheavesCapital\TwilioVerify\DTO\Verification;
use SheavesCapital\TwilioVerify\DTO\VerificationCheck;
use SheavesCapital\TwilioVerify\Events\TwilioVerifyResponseLog;

class TwilioVerify
{
    public function start(string $to, string $channel = 'sms', ?string $code = null): Verification
    {
        // https://verify.twilio.com/v2/Services/VAXXXXXXXXXX/Verifications
        $url = sprintf(
            '%s/%s/Verifications',
            config('twilio_verify.url'),
            config('twilio_verify.service_sid'),
        );

        $data = ['To' => $to, 'Channel' => $channel];
        if ($code) {
            $data['CustomCode'] = $code;
        }

        $response = Http::asForm()
            ->withBasicAuth(
                config('twilio_verify.account_sid'),
                config('twilio_verify.auth_token'),
            )
            ->post($url, $data);

        event(new TwilioVerifyResponseLog($response));

        $data = $response->throw()->json();

        return Verification::fromJson($data);
    }

    public function update(string $to, string $status = 'approved'): Verification
    {
        // https://verify.twilio.com/v2/Services/VAXXXXXXXXXX/Verifications
        $url = sprintf(
            '%s/%s/Verifications/%s',
            config('twilio_verify.url'),
            config('twilio_verify.service_sid'),
            $to,
        );

        $response = Http::asForm()
            ->withBasicAuth(
                config('twilio_verify.account_sid'),
                config('twilio_verify.auth_token'),
            )
            ->post($url, ['Status' => $status]);

        event(new TwilioVerifyResponseLog($response));

        $data = $response->throw()->json();

        return Verification::fromJson($data);
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
