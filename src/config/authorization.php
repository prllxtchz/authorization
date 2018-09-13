<?php

return [

    /**
     * NOTE: Add permissions under screens as "*" to create all actions under
     * given screen.
     *
     * If you no need create all permission just separate with a "|".
     * Ex: view|create|edit|delete
     *
     */

    'default_modules' => [
        [
            'name' => 'User Management',
            'order' => 100,
            'screens' => [
                ['name' => 'users', 'order' => 100, 'permissions' => '*'],
                ['name' => 'roles', 'order' => 200, 'permissions' => '*'],
            ]
        ]
    ],

    'default_actions' => [
        'view',
        'create',
        'modify',
        'delete',
    ]
];