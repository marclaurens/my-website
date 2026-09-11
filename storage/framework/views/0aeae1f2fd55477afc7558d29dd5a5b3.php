<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage Posts</h1>
        <a href="<?php echo e(route('admin.posts.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">
            Create Post
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            <a href="<?php echo e(route('admin.posts.show', $post)); ?>" class="hover:underline"><?php echo e($post->title); ?></a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                            <?php echo e($post->category?->name ?? 'Uncategorized'); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($post->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                <?php echo e($post->is_published ? 'Published' : 'Draft'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                            <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>

                            <form action="<?php echo e(route('admin.posts.toggle', $post)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <?php if($post->is_published): ?>
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800">Unpublish</button>
                                <?php else: ?>
                                    <button type="submit" class="text-green-600 hover:text-green-800">Publish</button>
                                <?php endif; ?>
                            </form>

                            <form action="<?php echo e(route('admin.posts.destroy', $post)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No posts yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>