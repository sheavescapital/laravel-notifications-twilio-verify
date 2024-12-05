
This package is a opinionated fork of [codebar-ag/laravel-twilio-verify](https://github.com/codebar-ag/laravel-twilio-verify), mixed with some code from [laravel-notification-channels/twilio](https://github.com/laravel-notification-channels/twilio).


## 💡 What is Twilio Verify?
An elegant third-party integration to validate users with SMS, Voice, Email and
Push. Add verification to any step of your user‘s journey with a single API.

## 🛠 Requirements

- PHP: `^8.2`
- Laravel: `^11`
- Twilio Account

## ⚙️ Installation

You can install the package via composer:

```bash
composer require sheavescapital/laravel-notifications-twilio-verify
```

Add the following environment variables to your `.env` file:

```bash
TWILIO_ACCOUNT_SID=ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
TWILIO_AUTH_TOKEN=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
TWILIO_SERVICE_SID=VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

## 🏗 Usage

```php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use SheavesCapital\TwilioVerify\TwilioVerifyChannel;

class SendOTP extends Notification {
    public function via(object $notifiable): string {
        return TwilioVerifyChannel::class;
    }
}
```

### 🔢 Verification Code Limits

- The generated code is valid for (10 minutes)[ https://www.twilio.com/docs/verify/api/rate-limits-and-timeouts].
- You have attempted to send the verification code more than 5 times and have
  (reached the limit)[https://www.twilio.com/docs/api/errors/60203].
  
## 🏋️ DTO showcase

```php
SheavesCapital\TwilioVerify\DTO\SendCodeAttempt {
  +time: Illuminate\Support\Carbon                      // Carbon
  +channel: "sms"                                       // string
  +attempt_sid: "VLMn1NOnmIVWMITO4FbVGxNmEMJ72KKaB2"    // string
}
```

```php 
SheavesCapital\TwilioVerify\DTO\Lookup {
  +carrier: SheavesCapital\TwilioVerify\DTO\Carrier {
    +error_code: null           // ?string
    +name: "Carrier Name"       // string
    +mobile_country_code: "310" // string
    +mobile_network_code: "150" // string
    +type: "150"                // string
  }
}
```

```php
SheavesCapital\TwilioVerify\DTO\Verification
  +sid: "VEkEJNNkLugY4hietPDbcqUUZz3G5NoTTZ"            // string
  +service_sid: "VAssMsB84NdN0aJJceYsExX1223qAmrubx"    // string
  +account_sid: "ACizUsoInA3dbKR5LA9tOqqA0O3NFSHSNc"    // string
  +to: "+41795555825"                                   // string
  +channel: "sms"                                       // string
  +status: "pending"                                    // string
  +valid: false                                         // bool
  +created_at: Illuminate\Support\Carbon                // Carbon
  +updated_at: Illuminate\Support\Carbon                // Carbon
  +lookup: SheavesCapital\TwilioVerify\DTO\Lookup {...}      // Lookup
  +send_code_attempts: Illuminate\Support\Collection {  // Collection
      0 => SheavesCapital\TwilioVerify\DTO\SendCodeAttempt {
        +time: Illuminate\Support\Carbon                    // Carbon
        +channel: "sms"                                     // string
        +attempt_sid: "VLTvj9jhh76cI78Hc1x0c3UORWJwwqVeTN"  // string
      }
    ]
  }
  +url: "https://verify.twilio.com/v2/Services/VAssMsB84NdN0aJJceYsExX1223qAmrubx/Verifications" // string
}
```

```php
SheavesCapital\TwilioVerify\DTO\VerificationCheck {
  +sid: "VEvRzh4hPUqmAjeC6li092VNT0yfd23lag"            // string
  +service_sid: "VAxSR0Wq91djjG9PAYtrtjt11f0I4lqdwa"    // string
  +account_sid: "ACcI5zbEYvLr0vPIUTQzWkTpP5DPqTCYDK"    // string
  +to: "+41795555825"                                   // string
  +channel: "sms"                                       // string
  +status: "approved"                                   // string
  +valid: true                                          // bool
  +created_at: Illuminate\Support\Carbon                // Carbon
  +updated_at: Illuminate\Support\Carbon                // Carbon
}
```

## 🔧 Configuration file

You can publish the config file with:

```bash
php artisan vendor:publish --provider="SheavesCapital\TwilioVerify\TwilioVerifyServiceProvider" --tag="laravel-notifications-twilio-verify-config"
```

This is the contents of the published config file:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Twilio Verify Configuration
    |--------------------------------------------------------------------------
    |
    | You can find your Account SID and Auth Token in the Console Dashboard.
    | Additionally you should create a new Verify service and paste it in
    | here. Afterwards you are ready to communicate with Twilio Verify.
    |
    */

    'url' => env('TWILIO_URL', 'https://verify.twilio.com/v2/Services'),
    'account_sid' => env('TWILIO_ACCOUNT_SID', 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'),
    'auth_token' => env('TWILIO_AUTH_TOKEN', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'),
    'service_sid' => env('TWILIO_SERVICE_SID', 'VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'),

];
```

## ✨ Events

Following events are fired:

```php 
use SheavesCapital\TwilioVerify\Events\TwilioVerifyResponseLog;

// Log each response from the Twilio REST API.
TwilioVerifyResponseLog::class => [
    //
],
```

## 🚧 Testing

Copy your own phpunit.xml-file.
```bash
cp phpunit.xml.dist phpunit.xml
```

Modify environment variables in the phpunit.xml-file:
```xml
<env name="TWILIO_ACCOUNT_SID" value="ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"/>
<env name="TWILIO_AUTH_TOKEN" value="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"/>
<env name="TWILIO_SERVICE_SID" value="VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"/>
```

Run the tests:
```bash
composer test
```


## 🙏 Credits

- [codebar Solutions AG](https://github.com/codebar-ag)
- [Ruslan Steiger](https://github.com/SuddenlyRust)
- [All Contributors](../../contributors)
- [Skeleton Repository from Spatie](https://github.com/spatie/package-skeleton-laravel)
- [Laravel Package Training from Spatie](https://spatie.be/videos/laravel-package-training)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
