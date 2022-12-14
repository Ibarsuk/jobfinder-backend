<?php

return [
    'keys' => [
        'access' => env('JWT_ACCESS_KEY', '9g#fa94hg'),
        'refresh' => env('JWT_REFRESH_KEY', 'nh295vkwh'),
    ],

    'algorithm' => 'HS256',

    'expires' => [
        //seconds
        'access' => 900,

        //days
        'refresh' => 30,
    ],
];
