<?php

declare(strict_types=1);

use Yii\Extension\User\Helper\TimeZone;
use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Csrf\CsrfTokenInterface;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var CsrfTokenInterface $csrf
 * @var Field $field
 * @var FormModelInterface $model
 * @var ModuleSettings $moduleSettings
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$this->setTitle(Html::encode($translator->translate('Profile', [], 'user-view')));
$tab = 0;
$timezone = new TimeZone();
?>

<div>
    <h1 class="font-mono font-semibold text-center text-4xl pb-8">
        <?= $this->getTitle() ?>
    </h1>
</div>
<div class="w-full max-w-xs">
    <?= Form::widget()
        ->action($urlGenerator->generate('profile'))
        ->attributes(['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'])
        ->csrf($csrf)
        ->id('form-profile')
        ->begin() ?>

        <?= $field->config($model, 'name')->text(['autofocus' => true, 'tabindex' => ++$tab]) ?>
        <?= $field->config($model, 'publicEmail')->text(['autofocus' => true, 'tabindex' => ++$tab]) ?>
        <?= $field->config($model, 'website')->text(['autofocus' => true, 'tabindex' => ++$tab]) ?>
        <?= $field->config($model, 'location')->text(['autofocus' => true, 'tabindex' => ++$tab]) ?>
        <?= $field->config($model, 'timezone')
            ->select(
                ['tabindex' => ++$tab],
                ArrayHelper::map($timezone->getAll(), 'timezone', 'name'),
            ) ?>
        <?= $field->config($model, 'bio')
            ->textarea(['class' => '', 'rows' => 2,'tabindex' => ++$tab]) ?>
        <?= $field->submitButton(
            [
                'class' => 'bg-blue-500 h-12 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:shadow-outline w-full',
                'id' => 'save-profile',
                'tabindex' => ++$tab,
                'value' => $translator->translate('Save', [], 'user-view'),
            ],
        ) ?>

    <?= Form::end() ?>
</div>
