<?php
declare(strict_types=1);

namespace OCA\WorkspaceFix\Listener;

use OCA\Files\Event\LoadAdditionalScriptsEvent;
use OCA\WorkspaceFix\AppInfo\Application;
use OCP\App\IAppManager;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\Util;

class LoadAdditionalScriptsListener implements IEventListener {
    public function __construct(
        private IAppManager $appManager,
    ) {}

    public function handle(Event $event): void {
        if (!($event instanceof LoadAdditionalScriptsEvent)) {
            return;
        }

        if (!$this->appManager->isEnabledForUser(Application::APP_ID)) {
            return;
        }

        Util::addStyle(Application::APP_ID, 'workspace_fix');
        Util::addScript(Application::APP_ID, 'workspace_fix');
    }
}
