

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Menu Builder</h1>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.menu.store')); ?>" method="POST" class="bg-white p-6 shadow rounded mb-6">
        <?php echo csrf_field(); ?>
        <h2 class="text-lg font-bold mb-4">Add Menu Item</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Link Title</label>
                <input type="text" name="title" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Link to Dynamic Page</label>
                <select name="page_id" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Custom URL --</option>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Custom URL (if no page chosen)</label>
                <input type="text" name="url" placeholder="https://..." class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Display Order</label>
                <input type="number" name="order" value="0" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded">Add Link to Menu</button>
    </form>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-bold mb-4">Current Navigation Items</h2>
        <ul class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="py-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <span class="font-bold text-gray-800 text-lg"><?php echo e($item->title); ?></span>
                        <span class="text-sm text-gray-500 block md:inline md:ml-2">(<?php echo e($item->target_url); ?>)</span>
                    </div>
                    
                    <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                        <!-- Inline Update Form for Order -->
                        <form action="<?php echo e(route('admin.menu.update', $item->id)); ?>" method="POST" class="flex items-center gap-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <label class="text-xs text-gray-600 font-medium">Order:</label>
                            <input type="number" name="order" value="<?php echo e($item->order); ?>" class="w-20 border p-1 rounded text-sm text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1.5 rounded border">Update</button>
                        </form>

                        <!-- Delete Form -->
                        <form action="<?php echo e(route('admin.menu.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Remove this menu item?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium px-2 py-1">Remove</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="py-3 text-gray-500">No menu items configured yet.</li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/admin/menu/index.blade.php ENDPATH**/ ?>