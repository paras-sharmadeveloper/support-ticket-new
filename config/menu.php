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
        ],

        [
            'title' => 'Mail',
            'icon' => 'mail',
            'children' => [

                [
                    'title' => 'Inbox',
                    'route' => 'mail.inbox',
                ],

                [
                    'title' => 'Sent',
                    'route' => 'mail.sent',
                ],

                [
                    'title' => 'Compose',
                    'route' => 'mail.compose',
                ],

            ]

        ],

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
        ],
        [
            'title' => 'Assets',
            'route' => 'assets.index'
        ],

        // [
        //     'title' => 'Mail',
        //     'icon' => 'mail',
        //     'children' => [

        //         [
        //             'title' => 'Inbox',
        //             'route' => 'mail.inbox',
        //         ],

        //         [
        //             'title' => 'Sent',
        //             'route' => 'mail.sent',
        //         ],

        //         [
        //             'title' => 'Compose',
        //             'route' => 'mail.compose',
        //         ],

        //     ]

        // ],

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
        ],

        // [
        //     'title' => 'Mail',
        //     'icon' => 'mail',
        //     'children' => [

        //         [
        //             'title' => 'Inbox',
        //             'route' => 'mail.inbox',
        //         ],

        //         [
        //             'title' => 'Sent',
        //             'route' => 'mail.sent',
        //         ],

        //         [
        //             'title' => 'Compose',
        //             'route' => 'mail.compose',
        //         ],

        //     ]

        // ],

    ],

];
