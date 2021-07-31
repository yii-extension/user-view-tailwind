<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Li;
use Yiisoft\Html\Tag\Ul;
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

$title = Html::encode($translator->translate('Register', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$items = [];
$tab = 0;
?>

<div>
    <h1 class="font-mono font-semibold text-center text-4xl pb-8">
        <?= $title ?>
    </h1>
</div>

<div class="w-full max-w-xs">
    <?= Form::widget()
        ->action($urlGenerator->generate('register'))
        ->attributes(['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'])
        ->csrf($csrf)
        ->id('form-registration-register')
        ->begin() ?>

        <?= $field->config($model, 'email')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= $field->config($model, 'username')->input(['tabindex' => ++$tab]) ?>

        <?php if ($moduleSettings->isGeneratingPassword() === false) : ?>
            <?= $field->config($model, 'password')->passwordInput(['tabindex' => ++$tab]) ?>
        <?php endif ?>

        <?= Button::tag()
            ->attributes(['tabindex' => ++$tab])
            ->class(
                'bg-blue-500 h-12 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:shadow-outline w-full'
            )
            ->content($translator->translate('Register', [], 'user-view'))
            ->id('register-button')
            ->type('submit') ?>
    <?= Form::end() ?>

    <div>
        <hr class="mt-1"/>

        <?php $items = Li::tag()
            ->class('text-blue-600 text-center')
            ->content(
                A::tag()
                    ->attributes(['tabindex' => ++$tab])
                    ->content($translator->translate('Already registered - Sign in!', [], 'user-view'))
                    ->url($urlGenerator->generate('login'))
                    ->render()
            )
            ->encode(false)
        ?>

        <?= Ul::tag()->class('list-none')->items($items) ?>

        <hr class="py-3"/>
    </div>
</div>
