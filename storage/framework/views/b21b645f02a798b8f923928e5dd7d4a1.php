:root {
        --primary-color: <?php echo e($primaryColor); ?>;
        --accent-color: <?php echo e($accentColor); ?>;
        --text-color: <?php echo e($textColor); ?>;
        --heading-font: <?php echo $headingFont; ?>;
        --body-font: <?php echo $bodyFont; ?>;
        --border-radius: <?php echo e($borderRadius); ?>;
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
    }<?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/partials/theme-vars.blade.php ENDPATH**/ ?>