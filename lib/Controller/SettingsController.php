<?php
/**
 * SPDX-FileCopyrightText: 2026 uttii-com <https://uttii.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
declare(strict_types=1);

namespace OCA\WorkspaceFix\Controller;

use OCA\WorkspaceFix\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\Attribute\NoAdminRequired;
use OCP\AppFramework\Http\DataResponse;
use OCP\IConfig;
use OCP\IRequest;
use OCP\IUserSession;

class SettingsController extends Controller {
    public function __construct(
        string $appName,
        IRequest $request,
        private IConfig $config,
        private IUserSession $userSession,
    ) {
        parent::__construct($appName, $request);
    }

    #[NoAdminRequired]
    public function setLanguage(): DataResponse {
        $user = $this->userSession->getUser();
        if ($user === null) {
            return new DataResponse(['success' => false, 'error' => 'Not authenticated'], 401);
        }

        $lang = (string)$this->request->getParam('lang', 'ja');
        if ($lang !== 'en' && $lang !== 'ja') {
            $lang = 'ja';
        }

        $this->config->setUserValue($user->getUID(), Application::APP_ID, 'lang', $lang);

        return new DataResponse([
            'success' => true,
            'lang' => $lang,
        ]);
    }
}
