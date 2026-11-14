<?php
/**
 * SPDX-FileCopyrightText: 2026 uttii-com <https://uttii.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
declare(strict_types=1);

namespace OCA\WorkspaceFix\Listener;

use OCA\WorkspaceFix\AppInfo\Application;
use OCP\AppFramework\Http\Events\BeforeTemplateRenderedEvent;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\Util;

class SettingsStyleListener implements IEventListener {
    public function handle(Event $event): void {
        if (!($event instanceof BeforeTemplateRenderedEvent) || !$event->isLoggedIn()) {
            return;
        }
        $uri = (string)($_SERVER['REQUEST_URI'] ?? '');
        if (str_contains($uri, '/settings')) {
            Util::addStyle(Application::APP_ID, 'nav-icon');
        }
    }
}
