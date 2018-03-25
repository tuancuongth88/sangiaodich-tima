<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
     */

    // 'supportsCredentials' => false,
    // 'allowedOrigins' => ['*'],
    // 'allowedOriginsPatterns' => [],
    // 'allowedHeaders' => ['*'],
    // 'allowedMethods' => ['*'],
    // 'exposedHeaders' => [],
    // 'maxAge' => 0,
    //
    'supportsCredentials' => false,
    'allowedOrigins'      => ['*'],
    'allowedHeaders'      => ['Origin', 'Content-Type', 'X-Requested-With', 'X-Auth-Token', 'Authorization'],
    'allowedMethods'      => ['*'],
    'exposedHeaders'      => [],
    'maxAge'              => 0,
    'hosts'               => [],
];
