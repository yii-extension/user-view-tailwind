<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\ViewInjection;

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\User\Settings\ModuleSettings;
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
        Field $field,
        Flash $flash,
        ModuleSettings $moduleSettings,
        TranslatorInterface $translator,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->currentUser = $currentUser;
        $this->field = $field;
        $this->flash = $flash;
        $this->moduleSettings = $moduleSettings;
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
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
}
