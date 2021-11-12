<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\ViewInjection;

use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Session\Flash\Flash;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\User\CurrentUser;
use Yiisoft\Yii\View\CommonParametersInjectionInterface;

final class UserViewInjection implements CommonParametersInjectionInterface
{
    private CurrentUser $currentUser;
    private Field $field;
    private Flash $flash;
    private ModuleSettings $moduleSettings;
    private TranslatorInterface $translator;
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(
        CurrentUser $currentUser,
        Flash $flash,
        ModuleSettings $moduleSettings,
        TranslatorInterface $translator,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->currentUser = $currentUser;
        $this->flash = $flash;
        $this->moduleSettings = $moduleSettings;
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
        $this->field = $this->createField();
    }

    /**
     * @psalm-suppress UndefinedInterfaceMethod
     */
    public function getCommonParameters(): array
    {
        return [
            'field' => $this->field,
            'flash' => $this->flash,
            'isGuest' => $this->currentUser->isGuest(),
            'moduleSettings' => $this->moduleSettings,
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
            'userName' => $this->currentUser->getId() !== null ? $this->currentUser->getIdentity()->getUsername() : '',
        ];
    }

    private function createField(): Field
    {
        return Field::widget()
            ->containerClass('mb-6')
            ->errorClass('text-red-600 italic')
            ->hintClass('font-semibold')
            ->inputClass(
                'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'
            )
            ->invalidClass('border-red-600')
            ->labelClass('block text-gray-700 text-sm font-bold mb-2')
            ->template("{label}\n{input}\n{hint}\n{error}")
            ->validClass('border-green-600');
    }
}
