<?php

declare(strict_types=1);

use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Field;

/** @var array $params */

return [
    Form::class => [
        'attributes()' => $params['yii-extension/user-view-tailwind']['form']['attributes'],
    ],
    Field::class => [
        'containerClass()' => $params['yii-extension/user-view-tailwind']['field']['containerClass'],
        'defaultValues()' => $params['yii-extension/user-view-tailwind']['field']['defaultValues'],
        'errorClass()' => $params['yii-extension/user-view-tailwind']['field']['errorClass'],
        'hintClass()' => $params['yii-extension/user-view-tailwind']['field']['hintClass'],
        'inputClass()' => $params['yii-extension/user-view-tailwind']['field']['inputClass'],
        'invalidClass()' => $params['yii-extension/user-view-tailwind']['field']['invalidClass'],
        'labelClass()' => $params['yii-extension/user-view-tailwind']['field']['labelClass'],
        'template()' => $params['yii-extension/user-view-tailwind']['field']['template'],
        'validClass()' => $params['yii-extension/user-view-tailwind']['field']['validClass'],
    ],
];
