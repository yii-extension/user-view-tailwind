<?php

declare(strict_types=1);

use Yii\Extension\Helpers\TimeZone;
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
 * @var FormModelInterface $model
 * @var ModuleSettings $moduleSettings
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */
$this->setTitle($translator->translate('views.profile.profile.title'));
/** @psalm-var iterable<mixed, array<array-key, mixed>|object> */
$timezone = (new TimeZone())->getAll();
?>

<div class="flex flex-col h-full items-center justify-center bg-gray-100 w-screen">
    <div class="bg-white shadow-lg px-8 py-8 w-1/5 w-full lg:w-1/4">
        <div class="font-bold text-3xl text-center text-gray-600 w-full">
            <h1 class="font-mono font-semibold pb-4 text-4xl text-center">
                <?= Html::encode($this->getTitle()) ?>
            </h1>
        </div>
        <?= Form::widget()
            ->action($urlGenerator->generate('profile'))
            ->csrf($csrf)
            ->id('form-profile')
            ->begin()
        ?>

            <?= Field::widget()->autofocus()->text($model, 'name')->tabindex(1) ?>
            <?= Field::widget()->text($model, 'publicEmail')->tabindex(2) ?>
            <?= Field::widget()->text($model, 'website')->tabindex(3) ?>
            <?= Field::widget()->text($model, 'location')->tabindex(4) ?>
            <?= Field::widget()
                ->select(
                    $model,
                    'timezone',
                    ['items()' => [ArrayHelper::map($timezone, 'timezone', 'name')]],
                )
                ->tabindex(5)
            ?>
            <?= Field::widget()->textarea($model, 'bio', ['rows()' => [2]])->tabindex(6) ?>
            <?= Field::widget()
                ->id('save-profile')
                ->name('save-profile')
                ->submitButton()
                ->tabindex(7)
                ->value($translator->translate('views.profile.profile.button.submit'))
            ?>

        <?= Form::end() ?>
    </div>
</div>
