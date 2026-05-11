<?php

namespace SheavesCapital\TwilioVerify;

use Exception;
use Illuminate\Notifications\Notification;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;

class TwilioVerifyChannel
{
    public function __construct(
        protected TwilioVerify $twilioVerify,
    ) {}

    /**
     * Send the given notification.
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function send(mixed $notifiable, Notification $notification)
    {
        $to = $this->getTo($notifiable, $notification);

        $code = $this->getTwoFactorCode($notifiable);

        return $this->twilioVerify->start(to: $to, code: $code);
    }

    /**
     * Get the address to send a notification to.
     *
     * @param  mixed  $notifiable
     * @param  Notification|null  $notification
     * @return mixed
     */
    protected function getTo($notifiable, $notification = null)
    {

        if ($notifiable->routeNotificationFor('twilio_verify', $notification)) {
            return $notifiable->routeNotificationFor('twilio_verify', $notification);
        }
        if (isset($notifiable->phone_number)) {
            return $notifiable->phone_number;
        }
    }

    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws SecretKeyTooShortException
     * @throws InvalidCharactersException
     */
    public function getTwoFactorCode($notifiable): ?string
    {
        if (! $notifiable->two_factor_secret) {
            return null;
        }

        return app(Google2FA::class)->getCurrentOtp(decrypt($notifiable->two_factor_secret));
    }
}
