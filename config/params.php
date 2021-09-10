<?php

declare(strict_types=1);

use Yii\Extension\User\View\ViewInjection\UserViewInjection;
use Yiisoft\Definitions\Reference;
use Yiisoft\Yii\View\CsrfViewInjection;

return [
    'yiisoft/aliases' => [
        'aliases' => [
            '@user-view-views' => '@vendor/yii-extension/user-view-tailwind/storage/views',
        ]
    ],

    'yiisoft/yii-view' => [
        'injections' => [
            Reference::to(CsrfViewInjection::class),
            Reference::to(UserViewInjection::class),
        ],
    ],
];
