<?php
/**
 * SPDX-FileCopyrightText: 2026 uttii-com <https://uttii.com>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
?>
<div id="workspace_fix-settings" class="section" data-lang="<?php p($_['lang']); ?>">
    <h2 class="app-name" data-i18n="pageTitle">Workspace表示安定化の設定</h2>
    <p class="settings-hint" data-i18n="pageDesc">
        フォルダ上部の Readme.md（Rich Workspaces）表示時に発生する 44px のガタつき・レイアウトシフトを防止し、誤クリックを防ぐ機能を提供します。
    </p>

    <div class="uttii-lang-bar">
        <label for="uttii-lang-select" data-i18n="langLabel">表示言語 / Language:</label>
        <select id="uttii-lang-select" class="uttii-lang-select">
            <option value="ja" <?php if ($_['lang'] === 'ja') p('selected'); ?>>日本語（デフォルト）</option>
            <option value="en" <?php if ($_['lang'] === 'en') p('selected'); ?>>English</option>
        </select>
        <span id="uttii-lang-status" class="uttii-lang-status"></span>
    </div>

    <div class="uttii-info-box">
        <strong data-i18n="statusLabel">動作ステータス:</strong>
        <span data-i18n="statusText">有効（ファイル一覧画面を開くと自動的にレイアウト安定化処理が適用されます）</span>
    </div>

    <div class="uttii-credit-card">
        <div class="uttii-credit-header">
            <h3 data-i18n="creditTitle">uttii-WorkspaceFix — クレジット・ライセンス・免責事項</h3>
            <span class="uttii-version-badge">v<?php p($_['version']); ?></span>
        </div>

        <div class="uttii-credit-grid">
            <div class="uttii-credit-item">
                <strong data-i18n="creditDevLabel">開発・運営</strong>
                <div>
                    uttii.com<br>
                    <a href="https://uttii.com" target="_blank" rel="noopener noreferrer">https://uttii.com</a><br>
                    <a href="https://app-nextcloud.uttii.com" target="_blank" rel="noopener noreferrer">https://app-nextcloud.uttii.com</a>
                </div>
            </div>

            <div class="uttii-credit-item">
                <strong data-i18n="creditLicenseLabel">ライセンス</strong>
                <div>GNU Affero General Public License v3.0 or later (AGPL-3.0-or-later)</div>
            </div>

            <div class="uttii-credit-item">
                <strong data-i18n="creditSupportLabel">ソースコード・不具合報告・お問い合わせ</strong>
                <div data-i18n="creditSupportDesc">不具合のご報告やご要望は、以下のいずれかよりご連絡ください。</div>
                <ul class="uttii-credit-links">
                    <li>GitHub Issues: <a href="https://github.com/uttii-com/uttii-workspace_fix/issues" target="_blank" rel="noopener noreferrer">https://github.com/uttii-com/uttii-workspace_fix/issues</a></li>
                    <li><span data-i18n="creditContactFormLabel">お問い合わせフォーム</span>: <a href="https://contact.uttii.com" target="_blank" rel="noopener noreferrer">https://contact.uttii.com</a></li>
                    <li><span data-i18n="creditEmailLabel">メール</span>: <a href="mailto:info@uttii.com">info@uttii.com</a></li>
                </ul>
            </div>
        </div>

        <div class="uttii-warranty-box">
            <strong data-i18n="warrantyTitle">無保証・自己責任での利用について</strong>
            <p data-i18n="warrantyBody">
                本アプリケーションは無償・無保証で提供されます。ソースコードは確認可能な形式で公開されており、利用者自身による検証を前提としています。<br>
                正常動作、互換性、安全性および継続的なサポートは保証されません。導入前にバックアップを取得し、ご自身の判断と責任でご利用ください。<br>
                法令上免除できない場合を除き、運営者は利用に伴う損害について責任を負いません。
            </p>
        </div>
    </div>
</div>
