<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Manage Categories</h1>

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

    <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST" class="bg-white p-6 rounded shadow mb-6">
        <?php echo csrf_field(); ?>
        <div class="flex gap-4">
            <input type="text" name="name" placeholder="Category Name" class="flex-1 border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Add Category</button>
        </div>
    </form>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?php echo e($category->name); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500"><?php echo e($category->slug); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right space-x-3">
                            <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No categories yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>