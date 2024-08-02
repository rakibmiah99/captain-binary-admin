<?php
    $actions = [
        'create' => 'Create',
        'update' => 'Update',
        'delete' => 'Delete',
        'view' => 'view',
        // 'export' => 'Export',
        // 'change_status' => 'Change Status'
    ];

return [
    'testimonial' => [
        'name' => 'Testimonial',
        'actions' => $actions
    ],
    'contact' => [
        'name' => 'Contact',
        'actions' => collect($actions)->only(['view', 'delete'])->toArray()
    ],
    'category' => [
        'name' => 'Category Management',
        'actions' => $actions
    ],

    'problem' => [
        'name' => 'Problem Management',
        'actions' => $actions
    ],

    'settings' => [
        'name' => 'Settings',
        'actions' => collect($actions)->only(['update'])->toArray()   
    ],

    'role' => [
        'name' => 'Roles',
        'actions' => $actions
    ],

    'user' => [
        'name' => 'Users',
        'actions' => collect($actions)->toArray()
    ],
];
