import 'ckeditor5/ckeditor5.css';
import 'ckeditor5/ckeditor5-content.css';
/**
 * Shared CKEditor 5 initializer â€” self-hosted GPL build.
 * Bypasses CKEditor's license server entirely.
 */
import {
    ClassicEditor,
    Essentials,
    Paragraph,
    Table,
    TableToolbar,
    TableCaption,
    ImageUtils,
    ImageEditing,
    GeneralHtmlSupport,
    Mention,
    Emoji,
    Autoformat,
    TextTransformation,
    CloudServices,
    Link,
    ImageBlock,
    ImageToolbar,
    ImageUpload,
    ImageInsertViaUrl,
    AutoImage,
    MediaEmbed,
    Bold,
    Italic,
    Underline,
    Strikethrough,
    Code,
    Subscript,
    Superscript,
    Heading,
    BlockQuote,
    HorizontalLine,
    CodeBlock,
    Indent,
    IndentBlock,
    List,
    TodoList,
    BlockToolbar,
    ShowBlocks,
    SourceEditing
} from 'ckeditor5';

import { Style } from '@ckeditor/ckeditor5-style';
import { FontFamily, FontSize, FontColor, FontBackgroundColor } from '@ckeditor/ckeditor5-font';
import { Alignment } from '@ckeditor/ckeditor5-alignment';
import { Highlight } from '@ckeditor/ckeditor5-highlight';

const LICENSE_KEY = 'GPL';

window.initCkEditor = function (selector, options) {
    options = options || {};
    const el = document.querySelector(selector);
    if (!el) {
        console.warn('[CKEditor] Element not found:', selector);
        return Promise.resolve(null);
    }

    const plugins = [
        Autoformat, AutoImage, BlockQuote, BlockToolbar, Bold, CloudServices,
        Code, CodeBlock, Emoji, Essentials, GeneralHtmlSupport, Heading,
        HorizontalLine, ImageBlock, ImageEditing, ImageInsertViaUrl,
        ImageToolbar, ImageUpload, ImageUtils, Indent, IndentBlock, Italic,
        Link, List, MediaEmbed, Mention, Paragraph, Strikethrough, Subscript,
        Superscript, Table, TableCaption, TableToolbar, TextTransformation,
        TodoList, Underline, ShowBlocks, SourceEditing,
        Style, FontFamily, FontSize, FontColor, FontBackgroundColor,
        Alignment, Highlight
    ];

    const config = {
        licenseKey: LICENSE_KEY,
        placeholder: 'Type or paste your content here!',
        plugins: plugins,
        toolbar: {
            items: [
                'undo', 'redo', '|',
                'sourceEditing', 'showBlocks', '|',
                'heading', 'style', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'bold', 'italic', 'underline', '|',
                'link', 'insertTable', 'highlight', 'blockQuote', 'codeBlock', '|',
                'alignment', '|',
                'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
            ],
            shouldNotGroupWhenFull: false
        },
        blockToolbar: [
            'fontSize', 'fontColor', 'fontBackgroundColor', '|',
            'bold', 'italic', '|',
            'link', 'insertTable', '|',
            'bulletedList', 'numberedList', 'outdent', 'indent'
        ],
        fontFamily: { supportAllValues: true },
        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        htmlSupport: {
            allow: [
                { name: /^.*$/, styles: true, attributes: true, classes: true }
            ]
        },
        image: {
            toolbar: ['imageTextAlternative']
        },
        link: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://'
        },
        style: {
            definitions: [
                { name: 'Article category', element: 'h3', classes: ['category'] },
                { name: 'Title', element: 'h2', classes: ['document-title'] },
                { name: 'Subtitle', element: 'h3', classes: ['document-subtitle'] },
                { name: 'Info box', element: 'p', classes: ['info-box'] },
                { name: 'CTA Link Primary', element: 'a', classes: ['button', 'button--green'] },
                { name: 'CTA Link Secondary', element: 'a', classes: ['button', 'button--black'] },
                { name: 'Marker', element: 'span', classes: ['marker'] },
                { name: 'Spoiler', element: 'span', classes: ['spoiler'] }
            ]
        },
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        }
    };

    if (options.simpleUpload) {
        config.simpleUpload = options.simpleUpload;
    }

    return ClassicEditor.create(el, config).then(editor => {
        // Sync editor content back into the <textarea> on form submit.
        const form = el.closest('form');
        if (form) {
            form.addEventListener('submit', function () {
                el.value = editor.getData();
            });
        }
        return editor;
    }).catch(err => {
        console.error('[CKEditor] Initialization failed:', err);
        throw err;
    });
};
