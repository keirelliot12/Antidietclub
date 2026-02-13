<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HTTP Drivers
    |--------------------------------------------------------------------------
    |
    | Laravel supports an array of HTTP drivers for different use cases.
    | Each driver has its own configuration options.
    |
    | Supported: "file", "cookie", "session", "apc"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Repository
    |--------------------------------------------------------------------------
    |
    | The session repository to use. If not specified, the default
    | repository will be used.
    |
    */

    'repository' => null,

    /*
    |--------------------------------------------------------------------------
    | Session Key
    |--------------------------------------------------------------------------
    |
    | The session key is used to encrypt sessions. You should set this to a
    | random, 32 character string. Otherwise, encrypted sessions will not be secure.
    |
    */

    'key' => env('APP_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Session Serialization
    |--------------------------------------------------------------------------
    |
    | Laravel supports "serialize", "json", and "php" serialization
    | for session data. You can choose whichever format you prefer.
    |
    */

    'serialization' => 'php',

    /*
    |--------------------------------------------------------------------------
    | Session Expiration
    |--------------------------------------------------------------------------
    |
    | By default, Laravel will keep a session alive for two hours. You can
    | override this value if you would like to manually specify expiration.
    |
    */

    'expiration' => env('SESSION_LIFETIME', 120),

];