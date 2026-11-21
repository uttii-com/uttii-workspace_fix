<?php
/**
 * SPDX-FileCopyrightText: 2026 uttii-com <https://uttii.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
declare(strict_types=1);

namespace OCA\WorkspaceFix\Settings;

use OCA\WorkspaceFix\AppInfo\Application;
use OCP\IConfig;
use OCP\IURLGenerator;
use OCP\IUserSession;
use OCP\Settings\IIconSection;

class PersonalSection implements IIconSection {
    public function __construct(
        private IConfig $config,
        private IUserSession $userSession,
        private IURLGenerator $urlGenerator,
    ) {}

    public function getID(): string {
        return Application::APP_ID;
    }

    public function getName(): string {
        return 'uttii-WorkspaceFix';
    }

    public function getPriority(): int {
        return 905;
    }

    public function getIcon(): string {
        try {
            return $this->urlGenerator->imagePath(Application::APP_ID, 'app.svg') . '?v=3';
        } catch (\Throwable $e) {
            return '';
        }
    }
}
