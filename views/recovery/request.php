<?php

declare(strict_types=1);

use Yiisoft\Csrf\CsrfTokenInterface;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Li;
use Yiisoft\Html\Tag\Ul;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var CsrfTokenInterface $csrf
 * @var FormModelInterface $model
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */
$this->setTitle($translator->translate('views.recovery.request.title'));
?>

<div class="flex flex-col h-full items-center justify-center bg-gray-100 w-screen">
    <div class="bg-white shadow-lg px-8 py-8 w-1/5 w-full lg:w-1/4">
        <div class="font-bold text-3xl text-center text-gray-600 w-full">
            <h1 class="font-mono font-semibold pb-4 text-4xl text-center">
                <?= Html::encode($this->getTitle()) ?>
            </h1>
        </div>
        <?= Form::widget()
            ->action($urlGenerator->generate('request'))
            ->csrf($csrf)
            ->id('form-recovery-request')
            ->begin()
        ?>

            <?= Field::widget()->autofocus()->text($model, 'email')->tabindex(1) ?>
            <?= Field::widget()
                ->id('request-button')
                ->name('request-button')
                ->submitButton()
                ->tabindex(2)
                ->value($translator->translate('views.recovery.request.button.submit'))
            ?>

        <?= Form::end() ?>
        <div>
            <hr class="mt-1"/>
            <?php $items = Li::tag()
                ->class('text-blue-600 text-center')
                ->content(
                    A::tag()
                        ->attributes(['tabindex' => 3])
                        ->content($translator->translate('views.recovery.request.signup.link'))
                        ->url($urlGenerator->generate('login'))
                        ->render()
                )
                ->encode(false)
            ?>
            <?= Ul::tag()->class('list-none')->items($items) ?>
            <hr class="py-3"/>
        </div>
    </div>
</div>
