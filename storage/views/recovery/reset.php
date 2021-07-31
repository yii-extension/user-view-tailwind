<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var string $code
 * @var string|null $csrf
 * @var Field $field
 * @var ModelInterface $model
 * @var string $id
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Reset your password', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
?>

<div>
    <h1 class="font-mono font-semibold text-center text-4xl pb-8">
        <?= $title ?>
    </h1>
</div>

<div class="w-full max-w-xs">
    <?= Form::widget()
        ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
        ->attributes(['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'])
        ->csrf($csrf)
        ->id('form-recovery-reset')
        ->begin() ?>

        <?= $field->config($model, 'password')->passwordInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= Button::tag()
            ->attributes(['tabindex' => ++$tab])
            ->class(
                'bg-blue-500 h-12 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:shadow-outline w-full'
            )
            ->content($translator->translate('Continue', [], 'user-view'))
            ->id('reset-button')
            ->type('submit') ?>
    <?= Form::end() ?>
</div>
