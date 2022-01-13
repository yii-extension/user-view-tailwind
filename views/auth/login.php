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
$this->setTitle($translator->translate('Log in', [], 'user-view'));
$items = [];
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
            ->action($urlGenerator->generate('login'))
            ->csrf($csrf)
            ->id('form-auth-login')
            ->begin()
        ?>

            <?= Field::widget()->autofocus()->text($model, 'login')->tabindex(++$tab) ?>
            <?= Field::widget()->password($model, 'password')->tabindex(++$tab) ?>
            <?= Field::widget()
                ->id('login-button')
                ->name('login-button')
                ->submitButton()
                ->tabindex(++$tab)
                ->value($translator->translate('Log in', [], 'user-view'))
            ?>

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
</div>
