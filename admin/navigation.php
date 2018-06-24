<?php

use SleepingOwl\Admin\Navigation\Page;

$navigation->setFromArray([

    (new Page(\App\Models\Page::class))->addBadge(function (){return \App\Models\Page::count();}),
    (new Page(\App\Models\User::class))->addBadge(function (){return \App\Models\User::count();}),
    (new Page(\App\Models\Contact::class))->addBadge(function (){return \App\Models\Contact::count();}),


    (new Page(\App\Models\Config::class)),
    [
        'title' => "Администрирование",
        'icon' => 'fa fa-cogs',
        'pages' => [
            (new Page())->setTitle('Robots')->setIcon('fa fa-android')->setUrl('/admin/robots'),
            (new Page())->setTitle('Сервер')->setIcon('fa fa-server')->setUrl('/admin/server'),
            (new Page())->setTitle('Логи')->setIcon('fa fa-magic')->setUrl('/admin/logs'),
        ]
    ],
    [
        'title' => "Супер Админ",
        'icon' => 'fa fa-exclamation-triangle',
        'pages' => [
            (new Page())->setTitle('Env Editor')->setUrl('/admin/env/editor')->setAccessLogic(function () { return auth()->check() && auth()->user()->is_super_admin; }),
            (new Page())->setTitle('Artisan Commands')->setUrl('/admin/art')->setAccessLogic(function () { return auth()->check() && auth()->user()->is_super_admin; }),
        ]
    ]
]);