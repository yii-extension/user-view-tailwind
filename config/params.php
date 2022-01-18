<?php

declare(strict_types=1);

$novalidate = getenv('YII_ENV') === 'tests' ? ['novalidate' => true] : [];

return [
    'yii-extension/user-view-tailwind' => [
        'form' => [
            'attributes' => [array_merge(['class' => 'flex flex-col gap-4 px-0 py-4'], $novalidate)],
        ],
        'field' => [
            'containerClass' => [''],
            'defaultValues' => [
                [
                    'submit' => [
                        'definitions' => [
                            'class()' => ['bg-blue-500 h-12 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:shadow-outline w-full'],
                        ],
                    ],
                    'textArea' => [
                        'inputClass' => '',
                    ]
                ],
            ],
            'errorClass' => ['text-red-600 italic'],
            'hintClass' => ['font-semibold'],
            'inputClass' => ['shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'],
            'invalidClass' => ['border-red-600'],
            'labelClass' => ['text-gray-700'],
            'template' => ["{label}\n{input}\n{hint}\n{error}"],
            'validClass' => ['border-green-600'],
        ],
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@user-view-views' => '@vendor/yii-extension/user-view-tailwind/views',
        ]
    ],

    'yiisoft/view' => [
        'parameters' => [
            'menuItemsIsGuest' => [
                [
                    'label' => 'Register',
                    'url' => '/register',
                    'urlAttributes' => ['class' => 'mr-5'],
                ],
                [
                    'label' => 'Login',
                    'url' => '/login',
                    'urlAttributes' => ['class' => 'mr-5'],
                ],
            ],
            'menuItemsIsNotGuest' => [
                [
                    'label' => 'Email change',
                    'url' => '/email/change',
                    'urlAttributes' => ['class' => 'flex flex-col my-auto items-center mr-5'],
                ],
                [
                    'label' => 'Profile',
                    'url' => '/profile',
                    'urlAttributes' => ['class' => 'flex flex-col my-auto items-center mr-5'],
                ],
            ],
        ],
    ],
];
