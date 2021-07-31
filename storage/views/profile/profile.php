<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yii\Extension\User\Helper\TimeZone;
use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var Field $field
 * @var ModelInterface $model
 * @var ModuleSettings $moduleSettings
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Profile', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
$timezone = new TimeZone();
?>

<div>
    <h1 class="font-mono font-semibold text-center text-4xl pb-8">
        <?= $title ?>
    </h1>
</div>

<div class="w-full max-w-xs">
    <?= Form::widget()
        ->action($urlGenerator->generate('profile'))
        ->attributes(['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'])
        ->csrf($csrf)
        ->id('form-profile')
        ->begin() ?>

        <?= $field->config($model, 'name')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= $field->config($model, 'publicEmail')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= $field->config($model, 'website')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= $field->config($model, 'location')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= $field->config($model, 'timezone')
            ->dropDownList(
                ArrayHelper::map($timezone->getAll(), 'timezone', 'name'),
                ['tabindex' => ++$tab]
            ) ?>

        <?= $field->config($model, 'bio')
            ->textarea(['class' => '', 'rows' => 2,'tabindex' => ++$tab]) ?>

        <?= Button::tag()
            ->attributes(['tabindex' => ++$tab])
            ->class(
                'bg-blue-500 h-12 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:shadow-outline w-full'
            )
            ->content($translator->translate('Save', [], 'user-view'))
            ->id('save-profile')
            ->type('submit') ?>
    <?= Form::end() ?>
</div>
