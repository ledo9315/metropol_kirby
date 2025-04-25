<?php

return [
    'debug' => false,
    'panel' => [
        'install' => false
    ],
    'users' => [
        'create' => true,
        'changeName' => true,
        'changeEmail' => true,
        'changeLanguage' => true,
        'changePassword' => true,
        'changeRole' => true,
        'delete' => true,
        'update' => true
    ],
    'permissions' => [
        '*' => [
            'access' => [
                'panel' => true,
                'site' => true,
                'pages' => true
            ],
            'pages' => [
                'create' => true,
                'changeSlug' => true,
                'changeStatus' => true,
                'changeTemplate' => true,
                'changeTitle' => true,
                'delete' => true,
                'duplicate' => true,
                'update' => true,
                'sort' => true,
                'preview' => true
            ],
            'files' => [
                'create' => true,
                'changeName' => true,
                'delete' => true,
                'replace' => true,
                'update' => true
            ]
        ]
    ]
];