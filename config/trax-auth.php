<?php

return [

    'services' => [
        'users' => true,
    ],

    'user' => [
        'reset' => true,
        'redirect' => [
            'after_authentication' => '/lrs/home',
            'after_registration' => '/lrs/home',
        ]
    ],
    
    'owners' => [
        'default' => [
            'user' => 'Default Store',
            'role' => 'Default Store',
            'entity' => 'Default Store',
            'client' => 'Default Store',
        ]
    ]
];
