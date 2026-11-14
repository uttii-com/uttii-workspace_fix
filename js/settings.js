/* SPDX-FileCopyrightText: 2026 uttii-com <https://uttii.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
(function () {
    'use strict';

    const I18N = {
        ja: {
            pageTitle: 'Workspace表示安定化の設定',
            pageDesc: 'フォルダ上部の Readme.md（Rich Workspaces）表示時に発生する 44px のガタつき・レイアウトシフトを防止し、誤クリックを防ぐ機能を提供します。',
            langLabel: '表示言語 / Language:',
            langSaved: '言語設定を保存しました',
            langError: '保存に失敗しました',
            statusLabel: '動作ステータス:',
            statusText: '有効（ファイル一覧画面を開くと自動的にレイアウト安定化処理が適用されます）',
            creditTitle: 'uttii-WorkspaceFix — クレジット・ライセンス・免責事項',
            creditDevLabel: '開発・運営',
            creditLicenseLabel: 'ライセンス',
            creditSupportLabel: 'ソースコード・不具合報告・お問い合わせ',
            creditSupportDesc: '不具合のご報告やご要望は、以下のいずれかよりご連絡ください。',
            creditContactFormLabel: 'お問い合わせフォーム',
            creditEmailLabel: 'メール',
            warrantyTitle: '無保証・自己責任での利用について',
            warrantyBody: '本アプリケーションは無償・無保証で提供されます。ソースコードは確認可能な形式で公開されており、利用者自身による検証を前提としています。<br>正常動作、互換性、安全性および継続的なサポートは保証されません。導入前にバックアップを取得し、ご自身の判断と責任でご利用ください。<br>法令上免除できない場合を除き、運営者は利用に伴う損害について責任を負いません。'
        },
        en: {
            pageTitle: 'Workspace Fix Settings',
            pageDesc: 'Eliminates the 44px jump and delayed layout shift when opening folders with Readme.md (Rich Workspaces), preventing mis-clicks on mobile and desktop.',
            langLabel: 'Display Language / 表示言語:',
            langSaved: 'Language preference saved',
            langError: 'Failed to save language preference',
            statusLabel: 'Status:',
            statusText: 'Active (Layout stabilization is automatically applied in Nextcloud Files)',
            creditTitle: 'uttii-WorkspaceFix — Credits, License & Disclaimer',
            creditDevLabel: 'Developer & Publisher',
            creditLicenseLabel: 'License',
            creditSupportLabel: 'Source Code, Bug Reports & Contact',
            creditSupportDesc: 'For bug reports or inquiries, please contact us via any of the following:',
            creditContactFormLabel: 'Contact Form',
            creditEmailLabel: 'Email',
            warrantyTitle: 'No Warranty and Use at Your Own Risk',
            warrantyBody: 'This application is provided free of charge and without any warranty. The source code is published in an inspectable format and is intended to be verified by the user.<br>Normal operation, compatibility, security, and ongoing support are not guaranteed. Please take backups before installation and use the application at your own judgment and risk.<br>Except where liability cannot be excluded by applicable law, the operator shall not be liable for any damages arising from the use of this application.'
        }
    };

    let currentLang = 'ja';

    function applyLanguage(lang) {
        currentLang = (lang === 'en') ? 'en' : 'ja';
        const dict = I18N[currentLang];
        const root = document.getElementById('workspace_fix-settings');
        if (!root) return;

        root.setAttribute('data-lang', currentLang);
        root.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            if (dict[key] !== undefined) {
                if (key === 'warrantyBody') {
                    el.innerHTML = dict[key];
                } else {
                    el.textContent = dict[key];
                }
            }
        });
    }

    function init() {
        const root = document.getElementById('workspace_fix-settings');
        if (!root) return;

        const initialLang = root.getAttribute('data-lang') || OC.InitialState?.loadState('workspace_fix', 'lang') || 'ja';
        applyLanguage(initialLang);

        const select = document.getElementById('uttii-lang-select');
        const statusEl = document.getElementById('uttii-lang-status');
        if (select) {
            select.value = currentLang;
            select.addEventListener('change', async () => {
                const newLang = select.value === 'en' ? 'en' : 'ja';
                applyLanguage(newLang);
                if (statusEl) statusEl.textContent = '...';

                try {
                    const res = await fetch(OC.generateUrl('/apps/workspace_fix/api/settings/language'), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'requesttoken': OC.requestToken
                        },
                        body: JSON.stringify({ lang: newLang })
                    });
                    const data = await res.json();
                    if (res.ok && data.success) {
                        if (statusEl) {
                            statusEl.textContent = I18N[newLang].langSaved;
                            setTimeout(() => { statusEl.textContent = ''; }, 3000);
                        }
                    } else if (statusEl) {
                        statusEl.textContent = I18N[newLang].langError;
                    }
                } catch (e) {
                    if (statusEl) statusEl.textContent = I18N[newLang].langError;
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
