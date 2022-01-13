<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\ModuleSettings;
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
 * @var ModuleSettings $moduleSettings
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */
$this->setTitle($translator->translate('Register', [], 'user-view'));
$tab = 0;
?>

<div class="flex flex-col h-full items-center justify-center bg-gray-100 w-screen">
    <div class="bg-white shadow-lg px-8 py-8 w-1/5 w-full lg:w-1/4">
        <div class="font-bold text-3xl text-center text-gray-600 w-full">
            <h1 class="font-mono font-semibold pb-4 text-4xl text-center">
                <?= Html::encode($this->getTitle()) ?>
            </h1>
        </div>
        <?= Form::widget()
            ->action($urlGenerator->generate('register'))
            ->csrf($csrf)
            ->id('form-registration-register')
            ->begin() ?>

            <?= Field::widget()->autofocus()->text($model, 'email')->tabindex(++$tab) ?>
            <?= Field::widget()->text($model, 'username')->tabindex(++$tab) ?>
            <?php if ($moduleSettings->isGeneratingPassword() === false) : ?>
                <?= Field::widget()->password($model, 'password')->tabindex(++$tab) ?>
                <?= Field::widget()->password($model, 'passwordVerify')->tabindex(++$tab) ?>
            <?php endif ?>
            <?= Field::widget()
                ->id('register-button')
                ->name('register-button')
                ->submitButton()
                ->tabindex(++$tab)
                ->value($translator->translate('Register', [], 'user-view'))
            ?>

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
</div>
