/**
 * Nextcloud Workspace Fix v0.1.1
 * Client-side stabilizer for Rich Workspace (Readme.md header)
 */
(function() {
    'use strict';

    var STYLE_ID = 'workspace-fix-injected-style';
    if (!document.getElementById(STYLE_ID)) {
        var style = document.createElement('style');
        style.id = STYLE_ID;
        style.textContent = [
            '#rich-workspace .rich-workspace--preview,',
            '#rich-workspace:not(.focus) .rich-workspace--preview {',
            '    margin-top: 0 !important;',
            '}',
            '#rich-workspace:not(.focus),',
            '#rich-workspace:not(.focus) .rich-workspace--preview,',
            '#rich-workspace:not(.focus) .editor__content-wrapper {',
            '    max-height: calc(30vh - 50px) !important;',
            '}',
            '#rich-workspace:not(.focus) .rich-workspace--preview {',
            '    overflow: hidden !important;',
            '}',
            '#rich-workspace {',
            '    transition: none !important;',
            '}',
            '@media only screen and (max-width: 1024px) {',
            '    #rich-workspace:not(.focus),',
            '    #rich-workspace:not(.focus) .rich-workspace--preview,',
            '    #rich-workspace:not(.focus) .editor__content-wrapper {',
            '        max-height: calc(30vh - 50px) !important;',
            '    }',
            '}'
        ].join('\n');
        document.head.appendChild(style);
    }
    console.debug('[WorkspaceFix v0.1.1] Stabilizer active and styles verified.');
})();
