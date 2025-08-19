<?php

use NITSAN\NsCourses\Controller\Backend\MyModuleController;
return [
    'courses_module' => [
        'parent' => 'web',
        'access' => 'user,group',
        'workspaces' => 'live',
        'path' => '/module/web/nscourses',
        'labels' => [
            'title' => 'Courses',
            'description' => 'Manage courses in the backend',
        ],
        'icon' => 'EXT:ns_courses/Resources/Public/Icons/module-courses.svg',
        'routes' => [
            '_default' => [
                'target' => MyModuleController::class . '::indexAction',
            ],
        ],
    ],
];
