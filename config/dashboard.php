<?php

return [
    'modules' => [
        'overview' => [
            'label' => 'Overview',
            'icon' => 'layout-dashboard',
            'route' => 'admin.dashboard',
            'items' => [
                ['label' => 'Dashboard', 'icon' => 'layout-dashboard', 'route' => 'admin.dashboard'],
                ['label' => 'Visit website', 'icon' => 'external-link', 'route' => 'home'],
            ],
        ],
        'content' => [
            'label' => 'Content',
            'icon' => 'files',
            'route' => 'admin.pages.index',
            'items' => [
                ['label' => 'All pages', 'icon' => 'files', 'route' => 'admin.pages.index'],
                ['label' => 'Home page', 'icon' => 'home', 'route' => 'admin.pages.edit', 'params' => ['page' => 'home']],
                ['label' => 'Contact page', 'icon' => 'mail', 'route' => 'admin.pages.edit', 'params' => ['page' => 'contact']],
                ['label' => 'Privacy policy', 'icon' => 'shield', 'route' => 'admin.pages.edit', 'params' => ['page' => 'privacy-policy']],
                ['label' => 'Terms of service', 'icon' => 'file-check', 'route' => 'admin.pages.edit', 'params' => ['page' => 'terms-of-service']],
            ],
        ],
        'services' => [
            'label' => 'Services',
            'icon' => 'briefcase',
            'route' => 'admin.services.index',
            'items' => [
                ['label' => 'All services', 'icon' => 'briefcase', 'route' => 'admin.services.index'],
                ['label' => 'Add service', 'icon' => 'plus', 'route' => 'admin.services.create'],
                ['label' => 'Services page', 'icon' => 'external-link', 'route' => 'services'],
            ],
        ],
        'work' => [
            'label' => 'Work',
            'icon' => 'layers',
            'route' => 'admin.projects.index',
            'items' => [
                ['label' => 'All projects', 'icon' => 'layers', 'route' => 'admin.projects.index'],
                ['label' => 'Add project', 'icon' => 'plus', 'route' => 'admin.projects.create'],
            ],
        ],
        'messages' => [
            'label' => 'Messages',
            'icon' => 'inbox',
            'route' => 'admin.messages.index',
            'items' => [
                ['label' => 'Inbox', 'icon' => 'inbox', 'route' => 'admin.messages.index'],
                ['label' => 'Contact page', 'icon' => 'external-link', 'route' => 'contact'],
            ],
        ],
        'appearance' => [
            'label' => 'Appearance',
            'icon' => 'palette',
            'route' => 'admin.settings.edit',
            'items' => [
                ['label' => 'Site identity', 'icon' => 'badge', 'route' => 'admin.settings.edit'],
                ['label' => 'Social links', 'icon' => 'share', 'route' => 'admin.settings.edit', 'params' => ['section' => 'social']],
                ['label' => 'Contact details', 'icon' => 'contact', 'route' => 'admin.settings.edit', 'params' => ['section' => 'contact']],
            ],
        ],
        'system' => [
            'label' => 'System',
            'icon' => 'shield',
            'route' => 'admin.account.edit',
            'items' => [
                ['label' => 'Account security', 'icon' => 'user', 'route' => 'admin.account.edit'],
                ['label' => 'Site settings', 'icon' => 'badge', 'route' => 'admin.settings.edit'],
                ['label' => 'Website status', 'icon' => 'external-link', 'route' => 'home'],
            ],
        ],
    ],
];
