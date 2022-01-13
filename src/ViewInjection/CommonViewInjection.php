<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\ViewInjection;

use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Session\Flash\Flash;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\User\CurrentUser;
use Yiisoft\Yii\View\CommonParametersInjectionInterface;

final class CommonViewInjection implements CommonParametersInjectionInterface
{
    public function __construct(
        private CurrentUser $currentUser,
        private Flash $flash,
        private ModuleSettings $moduleSettings,
        private TranslatorInterface $translator,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    public function getCommonParameters(): array
    {
        return [
            'flash' => $this->flash,
            'identity' => $this->currentUser->isGuest() ? null : $this->currentUser->getIdentity(),
            'moduleSettings' => $this->moduleSettings,
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
        ];
    }
}
