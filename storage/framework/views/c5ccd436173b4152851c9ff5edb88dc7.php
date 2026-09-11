<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($globalSettings['site_name'] ?? config('app.name', 'Laravel')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen">

    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4" style="color: <?php echo e($globalSettings['primary_color'] ?? '#2563eb'); ?>;">
            Welcome to <?php echo e($globalSettings['site_name'] ?? 'Our Website'); ?>

        </h1>
        <p class="text-lg text-gray-600 mb-8">Use the top navigation bar to explore standalone pages or access the admin panel.</p>

        <?php if(auth()->guard()->check()): ?>
            <div class="inline-flex space-x-4">
                <a href="<?php echo e(route('admin.pages.index')); ?>" class="text-white font-medium px-5 py-2.5 rounded-lg shadow hover:opacity-90" style="background-color: <?php echo e($globalSettings['primary_color'] ?? '#2563eb'); ?>;">
                    Manage Pages
                </a>
                <a href="<?php echo e(route('admin.menu.index')); ?>" class="bg-gray-800 text-white font-medium px-5 py-2.5 rounded-lg shadow hover:bg-gray-900">
                    Menu Builder
                </a>
            </div>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="text-white font-medium px-5 py-2.5 rounded-lg shadow hover:opacity-90" style="background-color: <?php echo e($globalSettings['primary_color'] ?? '#2563eb'); ?>;">
                Log In to Admin
            </a>
        <?php endif; ?>
    </main>

</body>
</html><?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/welcome.blade.php ENDPATH**/ ?>