<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(isset($globalSettings['site_name']) ? $globalSettings['site_name'] : config('app.name', 'Laravel')); ?> - Admin Panel</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php
        $settings = isset($globalSettings) ? $globalSettings : \App\Models\Setting::pluck('value', 'key')->all();
        $siteName = $settings['site_name'] ?? config('app.name', 'Laravel');
        $primaryColor = $settings['primary_color'] ?? '#2563eb';
        $accentColor = $settings['accent_color'] ?? '#f59e0b';
        $textColor = $settings['text_color'] ?? '#1f2937';
        $headingFont = $settings['heading_font'] ?? 'Inter, sans-serif';
        $bodyFont = $settings['body_font'] ?? 'Inter, sans-serif';
        $borderRadius = $settings['border_radius'] ?? '0.375rem';
        $containerWidth = $settings['container_width'] ?? 'max-w-7xl';
        $headerBgColor = $settings['header_bg_color'] ?? '#ffffff';
        $headerImage = $settings['header_image'] ?? null;
    ?>

    <style>
        <?php echo $__env->make('partials.theme-vars', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        .main-container {
            font-family: var(--body-font);
        }
        .editor-container_classic-editor .editor-container__editor {
            min-width: 100%;
            max-width: 100%;
        }
        .ck-editor__editable {
            min-height: 400px;
        }

        .ck-content h3.category {
            font-family: 'Oswald', sans-serif;
            font-size: 20px;
            font-weight: bold;
            color: #555;
            letter-spacing: 10px;
            margin: 0;
            padding: 0;
        }
        .ck-content h2.document-title {
            font-family: 'Oswald', sans-serif;
            font-size: 50px;
            font-weight: bold;
            margin: 0;
            padding: 0;
            border: 0;
        }
        .ck-content h3.document-subtitle {
            font-family: 'Oswald', sans-serif;
            font-size: 20px;
            color: #555;
            margin: 0 0 1em;
            font-weight: bold;
            padding: 0;
        }
        .ck-content p.info-box {
            --background-size: 30px;
            --background-color: #e91e63;
            padding: 1.2em 2em;
            border: 1px solid var(--background-color);
            background:
                linear-gradient(135deg, var(--background-color) 0%, var(--background-color) var(--background-size), transparent var(--background-size)),
                linear-gradient(
                    135deg,
                    transparent calc(100% - var(--background-size)),
                    var(--background-color) calc(100% - var(--background-size)),
                    var(--background-color)
                );
            border-radius: 10px;
            margin: 1.5em 2em;
            box-shadow: 5px 5px 0 #ffe6ef;
        }
        .ck-content span.marker { background: yellow; }
        .ck-content span.spoiler { background: #000; color: #000; }
        .ck-content span.spoiler:hover { background: #000; color: #fff; }
        .ck-content .button {
            display: inline-block;
            width: 260px;
            border-radius: 8px;
            margin: 0 auto;
            padding: 12px;
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
        }
        .ck-content .button--green { background-color: #406b1e; }
        .ck-content .button--black { background-color: #141517; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen">
    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(isset($header)): ?>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <?php echo e($header); ?>

            </div>
        </header>
    <?php endif; ?>

    <main class="py-8">
        <?php echo e($slot); ?>

    </main>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/layouts/app.blade.php ENDPATH**/ ?>