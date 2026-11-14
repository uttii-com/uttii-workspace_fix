<?php
/**
 * SPDX-FileCopyrightText: 2026 uttii-com <https://uttii.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
declare(strict_types=1);

namespace OCA\WorkspaceFix\Settings;

use OCA\WorkspaceFix\AppInfo\Application;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Services\IInitialState;
use OCP\IConfig;
use OCP\IUserSession;
use OCP\Settings\ISettings;
use OCP\Util;

class PersonalSettings implements ISettings {
    public function __construct(
        private IConfig $config,
        private IUserSession $userSession,
        private IInitialState $initialStateService,
    ) {}

    public function getForm(): TemplateResponse {
        $user = $this->userSession->getUser();
        $lang = $user ? $this->config->getUserValue($user->getUID(), Application::APP_ID, 'lang', 'ja') : 'ja';
        if ($lang !== 'en' && $lang !== 'ja') {
            $lang = 'ja';
        }

        $this->initialStateService->provideInitialState('lang', $lang);
        Util::addScript(Application::APP_ID, 'settings');
        Util::addStyle(Application::APP_ID, 'settings-v2');

        return new TemplateResponse(Application::APP_ID, 'settings-personal', [
            'lang' => $lang,
            'version' => '0.2.0',
        ]);
    }

    public function getSection(): string {
        return Application::APP_ID;
    }

    public function getPriority(): int {
        return 74;
    }
}
