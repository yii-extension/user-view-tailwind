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
 * @var FormModelInterface $model
 * @var string $id
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */
$this->setTitle($translator->translate('views.recovery.reset.title'));
?>

<div class="flex flex-col h-full items-center justify-center bg-gray-100 w-screen">
    <div class="bg-white shadow-lg px-8 py-8 w-1/5 w-full lg:w-1/4">
        <div class="font-bold text-3xl text-center text-gray-600 w-full">
            <h1 class="font-mono font-semibold pb-4 text-4xl text-center">
                <?= Html::encode($this->getTitle()) ?>
            </h1>
        </div>
        <?= Form::widget()
            ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
            ->csrf($csrf)
            ->id('form-recovery-reset')
            ->begin()
        ?>

            <?= Field::widget()->autofocus()->password($model, 'password')->tabindex(1) ?>
            <?= Field::widget()
                ->id('reset-button')
                ->name('reset-button')
                ->submitButton()
                ->tabindex(2)
                ->value($translator->translate('views.recovery.reset.button.submit'))
            ?>

        <?= Form::end() ?>
    </div>
</div>
