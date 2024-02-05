<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id'     => '1050813244262-inn7o3mmq2vpi8fgo6o79cnid67o4pt5.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'http://demo-tak.mjqe.com.kh/login/google/callback'
    ],

    /*'google' => [
        'client_id'     => '976784291958-ci61ctjofh2h73v1di383spmvl1ral5n.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'http://127.0.0.1:8000/callback'
    ],*/

];
