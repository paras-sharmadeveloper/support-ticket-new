<?php

return [

    'super_admin' => [

        [
            'title' => 'Dashboard',
            'route' => 'dashboard'
        ],

        [
            'title' => 'Add Company',
            'route' => 'companies.create'
        ],

        [
            'title' => 'Companies',
            'route' => 'companies.index'
        ],

        [
            'title' => 'Email Settings',
            'route' => 'email.settings'
        ]

    ],

    'admin' => [

        [
            'title' => 'Dashboard',
            'route' => 'dashboard'
        ],

        [
            'title' => 'Departments',
            'route' => 'departments.index'
        ],

        [
            'title' => 'Employees',
            'route' => 'employees.index'
        ],

        [
            'title' => 'Email Settings',
            'route' => 'email.settings'
        ]

    ],
    'employee' => [

        [
            'title' => 'Dashboard',
            'route' => 'dashboard'
        ],

        [
            'title' => 'Create Ticket',
            'route' => 'tickets.create'
        ],

        [
            'title' => 'My Tickets',
            'route' => 'tickets.index'
        ]

    ],

];
