import { Plugin, ButtonView } from 'ckeditor5';

export default class InsertPagePlugin extends Plugin {
    static get pluginName() {
        return 'InsertPage';
    }

    init() {
        const editor = this.editor;

        editor.ui.componentFactory.add('insertPage', () => {
            const button = new ButtonView();

            button.set({
                label: 'Insert page link',
                tooltip: true,
                withText: false,
                icon: '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 2h6l4 4v12a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm6 1.5V7h3.5L12 3.5zM7 9v1.5h2.5V9H7zm4.5 0v1.5H13V9h-1.5zM7 12v1.5h2.5V12H7zm4.5 0v1.5H13V12h-1.5z" fill="currentColor"/></svg>'
            });

            button.on('execute', () => {
                this._openPicker(editor);
            });

            return button;
        });
    }

    _openPicker(editor) {
        const pages = window.__ckeditorPages || [];

        const overlay = document.createElement('div');
        overlay.style.cssText = 'position: fixed; inset: 0; background: rgba(0,0,0,0.3); z-index: 10000; display: flex; align-items: flex-start; justify-content: center; padding-top: 100px;';

        const panel = document.createElement('div');
        panel.style.cssText = 'background: #fff; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 400px; max-height: 60vh; overflow-y: auto; padding: 16px;';

        const heading = document.createElement('div');
        heading.textContent = 'Insert page link';
        heading.style.cssText = 'font-weight: 600; font-size: 14px; margin-bottom: 12px; color: #111827;';
        panel.appendChild(heading);

        if (!pages.length) {
            const empty = document.createElement('div');
            empty.textContent = 'No pages available.';
            empty.style.cssText = 'color: #6b7280; font-size: 13px; padding: 8px 0;';
            panel.appendChild(empty);
        } else {
            pages.forEach(page => {
                const item = document.createElement('button');
                item.type = 'button';
                item.style.cssText = 'display: block; width: 100%; text-align: left; padding: 10px 12px; border: none; background: transparent; cursor: pointer; border-radius: 6px; font-size: 13px; margin-bottom: 2px;';
                item.addEventListener('mouseover', () => { item.style.background = '#f3f4f6'; });
                item.addEventListener('mouseout', () => { item.style.background = 'transparent'; });

                const titleDiv = document.createElement('div');
                titleDiv.textContent = page.title;
                titleDiv.style.cssText = 'font-weight: 500; color: #111827;';

                const slugDiv = document.createElement('div');
                slugDiv.textContent = page.slug + (page.published ? '' : ' — draft');
                slugDiv.style.cssText = 'font-size: 11px; color: #6b7280; margin-top: 2px;';

                item.appendChild(titleDiv);
                item.appendChild(slugDiv);

                item.addEventListener('click', () => {
                    this._insertLink(editor, page);
                    document.body.removeChild(overlay);
                });

                panel.appendChild(item);
            });
        }

        const cancel = document.createElement('button');
        cancel.type = 'button';
        cancel.textContent = 'Cancel';
        cancel.style.cssText = 'margin-top: 12px; padding: 6px 14px; border: 1px solid #d1d5db; background: #fff; border-radius: 6px; cursor: pointer; font-size: 13px; color: #374151;';
        cancel.addEventListener('click', () => document.body.removeChild(overlay));
        panel.appendChild(cancel);

        overlay.appendChild(panel);
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) document.body.removeChild(overlay);
        });

        document.body.appendChild(overlay);
    }

    _insertLink(editor, page) {
        const url = page.url;
        const title = page.title;

        editor.model.change(writer => {
            const selection = editor.model.document.selection;
            const range = selection.getFirstRange();

            if (selection.isCollapsed) {
                const link = writer.createText(title, { linkHref: url });
                editor.model.insertContent(link, selection);
            } else {
                writer.setAttribute('linkHref', url, range);
            }
        });

        editor.editing.view.focus();
    }
}