<?php

declare(strict_types=1);

use Yiisoft\Csrf\CsrfTokenInterface;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var string $code
 * @var CsrfTokenInterface $csrf
 * @var Field $field
 * @var FormModelInterface $model
 * @var string $id
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$this->setTitle(Html::encode($translator->translate('Reset your password', [], 'user-view')));
$tab = 0;
?>

<div>
    <h1 class="font-mono font-semibold text-center text-4xl pb-8">
        <?= $this->getTitle() ?>
    </h1>
</div>
<div class="w-full max-w-xs">
    <?= Form::widget()
        ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
        ->attributes(['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4'])
        ->csrf($csrf)
        ->id('form-recovery-reset')
        ->begin() ?>

        <?= $field->config($model, 'password')->password(['autofocus' => true, 'tabindex' => ++$tab]) ?>
        <?= $field->submitButton(
            [
                'class' => 'bg-blue-500 h-12 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:shadow-outline w-full',
                'id' => 'reset-button',
                'tabindex' => ++$tab,
                'value' => $translator->translate('Continue', [], 'user-view'),
            ],
        ) ?>

    <?= Form::end() ?>
</div>
