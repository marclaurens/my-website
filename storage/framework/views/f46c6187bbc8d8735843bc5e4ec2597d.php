

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-6 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Global Look & Feel Settings</h1>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-6 space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Site Name -->
        <div>
            <label for="site_name" class="block text-gray-700 font-medium mb-2">Site Name</label>
            <input type="text" name="settings[site_name]" id="site_name" value="<?php echo e($settings['site_name'] ?? ''); ?>" class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <!-- Color Palette Options -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Color Palette</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="primary_color" class="block text-gray-700 font-medium mb-2">Primary Brand Color</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="settings[primary_color]" id="primary_color" value="<?php echo e($settings['primary_color'] ?? '#2563eb'); ?>" class="h-10 w-20 border border-gray-300 rounded cursor-pointer p-1">
                    </div>
                </div>

                <div>
                    <label for="accent_color" class="block text-gray-700 font-medium mb-2">Accent / Highlight Color</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="settings[accent_color]" id="accent_color" value="<?php echo e($settings['accent_color'] ?? '#f59e0b'); ?>" class="h-10 w-20 border border-gray-300 rounded cursor-pointer p-1">
                    </div>
                </div>

                <div>
                    <label for="text_color" class="block text-gray-700 font-medium mb-2">Global Text Color</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="settings[text_color]" id="text_color" value="<?php echo e($settings['text_color'] ?? '#1f2937'); ?>" class="h-10 w-20 border border-gray-300 rounded cursor-pointer p-1">
                    </div>
                </div>
            </div>
        </div>

        <!-- Typography Options -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Typography & Fonts</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="heading_font" class="block text-gray-700 font-medium mb-2">Heading Font Family</label>
                    <select name="settings[heading_font]" id="heading_font" class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Inter, sans-serif" <?php echo e((isset($settings['heading_font']) && $settings['heading_font'] == 'Inter, sans-serif') ? 'selected' : ''); ?>>Inter (Sans-Serif)</option>
                        <option value="Roboto, sans-serif" <?php echo e((isset($settings['heading_font']) && $settings['heading_font'] == 'Roboto, sans-serif') ? 'selected' : ''); ?>>Roboto (Sans-Serif)</option>
                        <option value="Playfair Display, serif" <?php echo e((isset($settings['heading_font']) && $settings['heading_font'] == 'Playfair Display, serif') ? 'selected' : ''); ?>>Playfair Display (Serif)</option>
                        <option value="Montserrat, sans-serif" <?php echo e((isset($settings['heading_font']) && $settings['heading_font'] == 'Montserrat, sans-serif') ? 'selected' : ''); ?>>Montserrat (Modern)</option>
                    </select>
                </div>

                <div>
                    <label for="body_font" class="block text-gray-700 font-medium mb-2">Body Font Family</label>
                    <select name="settings[body_font]" id="body_font" class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Inter, sans-serif" <?php echo e((isset($settings['body_font']) && $settings['body_font'] == 'Inter, sans-serif') ? 'selected' : ''); ?>>Inter</option>
                        <option value="Open Sans, sans-serif" <?php echo e((isset($settings['body_font']) && $settings['body_font'] == 'Open Sans, sans-serif') ? 'selected' : ''); ?>>Open Sans</option>
                        <option value="Lato, sans-serif" <?php echo e((isset($settings['body_font']) && $settings['body_font'] == 'Lato, sans-serif') ? 'selected' : ''); ?>>Lato</option>
                        <option value="Merriweather, serif" <?php echo e((isset($settings['body_font']) && $settings['body_font'] == 'Merriweather, serif') ? 'selected' : ''); ?>>Merriweather (Serif)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Layout & Style Options -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Layout & Style Controls</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="border_radius" class="block text-gray-700 font-medium mb-2">Border Radius Style</label>
                    <select name="settings[border_radius]" id="border_radius" class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="0px" <?php echo e((isset($settings['border_radius']) && $settings['border_radius'] == '0px') ? 'selected' : ''); ?>>Square (0px)</option>
                        <option value="0.375rem" <?php echo e((isset($settings['border_radius']) && $settings['border_radius'] == '0.375rem') ? 'selected' : ''); ?>>Subtle Rounded (6px)</option>
                        <option value="0.75rem" <?php echo e((isset($settings['border_radius']) && $settings['border_radius'] == '0.75rem') ? 'selected' : ''); ?>>Smooth Rounded (12px)</option>
                        <option value="9999px" <?php echo e((isset($settings['border_radius']) && $settings['border_radius'] == '9999px') ? 'selected' : ''); ?>>Pill Style</option>
                    </select>
                </div>

                <div>
                    <label for="container_width" class="block text-gray-700 font-medium mb-2">Content Container Width</label>
                    <select name="settings[container_width]" id="container_width" class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="max-w-3xl" <?php echo e((isset($settings['container_width']) && $settings['container_width'] == 'max-w-3xl') ? 'selected' : ''); ?>>Narrow (Reading Focused)</option>
                        <option value="max-w-5xl" <?php echo e((isset($settings['container_width']) && $settings['container_width'] == 'max-w-5xl') ? 'selected' : ''); ?>>Standard (Balanced)</option>
                        <option value="max-w-7xl" <?php echo e((isset($settings['container_width']) && $settings['container_width'] == 'max-w-7xl') ? 'selected' : ''); ?>>Wide (Dashboard / Portal)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Header Styling Options -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Header Customization</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="header_bg_color" class="block text-gray-700 font-medium mb-2">Header Background Color</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="settings[header_bg_color]" id="header_bg_color" value="<?php echo e($settings['header_bg_color'] ?? '#ffffff'); ?>" class="h-10 w-20 border border-gray-300 rounded cursor-pointer p-1">
                        <span class="text-sm text-gray-500">Overrides default white navigation bar.</span>
                    </div>
                </div>

                <div>
                    <label for="header_image" class="block text-gray-700 font-medium mb-2">Header Background Image</label>
                    <input type="file" name="header_image" id="header_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-amber-600 mt-1">Recommended dimensions: 1920x200px (Aspect ratio ~9.6:1 or wide banner format).</p>
                    
                    <?php if(!empty($settings['header_image'])): ?>
                        <div class="mt-3">
                            <span class="text-xs text-gray-500 block mb-1">Current Banner:</span>
                            <img src="<?php echo e(asset('storage/' . $settings['header_image'])); ?>" alt="Header Banner" class="h-16 w-full object-cover rounded border mb-2">
                            
                            <label class="inline-flex items-center text-sm text-red-600 cursor-pointer mt-1">
                                <input type="checkbox" name="remove_header_image" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500 mr-2">
                                Remove current header image (revert to color)
                            </label>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded shadow">Save Settings</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>