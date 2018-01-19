<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '785966318125-pvdthv6nh0pdsm2rburnkmffk52mo7ap.apps.googleusercontent.com',
        'client_secret' => 'lpfyZy4L5t849yg_uePFUiY7',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '288528308341588',
        'client_secret' => '28e1db2631a897cbc0e78ef720e19e87',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'wttkY02jQvvwxQS1XQG2PpBzv',
        'client_secret' => 'e0dpDDvTOg8khHCCFAclKAWNNiFTsNGdyi7Rf7EitdNN3wzQ7M',
        'redirect' => 'http://localhost:8000/auth/twitter/callback',
    ],
];
