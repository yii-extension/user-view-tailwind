<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
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

$this->setTitle(Html::encode($translator->translate('Log in', [], 'user-view')));

$csrf = $csrf ?? '';
$items = [];
$tab = 0;
?>

<div>
    <h1 class="font-mono font-semibold text-center text-4xl pb-8">
        <?= $this->getTitle() ?>
    </h1>
</div>

<div class="w-full max-w-xs">
    <?= Form::widget()
        ->action($urlGenerator->generate('login'))
        ->attributes(['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'])
        ->csrf($csrf)
        ->id('form-auth-login')
        ->begin() ?>

        <?= $field->config($model, 'login')->text(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= $field->config($model, 'password')->password(['tabindex' => ++$tab]) ?>

        <hr class="mt-1"/>

        <?= $field->submitButton(
            [
                'class' => 'bg-blue-500 h-12 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:shadow-outline w-full',
                'id' => 'login-button',
                'tabindex' => ++$tab,
                'value' => $translator->translate('Log in', [], 'user-view'),
            ],
        ) ?>
    <?= Form::end() ?>

    <div>
        <hr class="mt-1"/>

        <?php if ($moduleSettings->isPasswordRecovery()) : ?>
            <?php $items[] = Li::tag()
                ->class('text-blue-600 text-center')
                ->content(
                    A::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->content($translator->translate('Forgot password', [], 'user-view'))
                        ->url($urlGenerator->generate('request'))
                        ->render()
                )
                ->encode(false)
            ?>
        <?php endif ?>

        <?php if ($moduleSettings->isRegister()) : ?>
            <?php $items[] = Li::tag()
                ->class('text-blue-600 text-center')
                ->content(
                    A::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->content($translator->translate('Don\'t have an account - Sign up!', [], 'user-view'))
                        ->url($urlGenerator->generate('register'))
                        ->render()
                )
                ->encode(false)
            ?>
        <?php endif ?>

        <?php if ($moduleSettings->isConfirmation() === true) : ?>
            <?php $items[] = Li::tag()
                ->class('text-blue-600 text-center')
                ->content(
                    A::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->content($translator->translate('Didn\'t receive confirmation message', [], 'user-view'))
                        ->url($urlGenerator->generate('resend'))
                        ->render()
                )
                ->encode(false)
            ?>
        <?php endif ?>

        <?= Ul::tag()->class('list-none')->items(...$items) ?>

        <hr class="py-3"/>
    </div>
</div>
