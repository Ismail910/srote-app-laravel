<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard.*'
    ],
    [
        'icon' =>'nav-icon fas fa-tachometer-alt',
        'route' => 'categories.index',
        'title' => 'Catalories',
        'badge' => 'New',
        'active' => 'categories.*'
    ],
    [
        'icon' =>'nav-icon fas fa-tachometer-alt',
        'route' => 'projects.index',
        'title' => 'Products',
        'active' => 'projects.*'
    ],
];