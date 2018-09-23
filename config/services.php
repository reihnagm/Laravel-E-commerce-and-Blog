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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'bca' => [
        'client_id' => env('BCA_CLIENT_ID'), // Your BCA Client ID
        'client_secret' => env('BCA_CLIENT_SECRET'), // Your BCA Client Secret
        'redirect' =>   env('BCA_CLIENT_URL'), // Your BCA Client Url
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'), // Your Google Client ID
        'client_secret' => env('GOOGLE_CLIENT_SECRET'), // Your Google Client Secret
        'redirect' =>   env('GOOGLE_CLIENT_URL'), // Your Google Client Url
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_CLIENT_ID'), // Your Facebook Client ID
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'), // Your Facebook Client Secret
        'redirect'      => env('FACEBOOK_CLIENT_URL'), // Your Facebook Client Url
    ],

];
