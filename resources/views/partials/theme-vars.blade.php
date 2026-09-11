:root {
        --primary-color: {{ $primaryColor }};
        --accent-color: {{ $accentColor }};
        --text-color: {{ $textColor }};
        --heading-font: {!! $headingFont !!};
        --body-font: {!! $bodyFont !!};
        --border-radius: {{ $borderRadius }};
    }
    body {
        color: var(--text-color);
        font-family: var(--body-font);
    }
    h1, h2, h3, h4, h5, h6 {
        font-family: var(--heading-font);
    }
    .bg-primary { background-color: var(--primary-color) !important; }
    .text-primary { color: var(--primary-color) !important; }
    .border-primary { border-color: var(--primary-color) !important; }
    button[type="submit"], .btn-primary {
        background-color: var(--primary-color) !important;
    }
    button[type="submit"]:hover, .btn-primary:hover {
        filter: brightness(0.9);
    }