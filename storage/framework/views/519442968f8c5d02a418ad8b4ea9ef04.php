<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3 = $attributes; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdminLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Draft Posts</h1>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($posts->isEmpty()): ?>
        <div class="bg-white shadow rounded p-6 text-gray-500">
            No drafts available.
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded p-6">
                    <?php if($post->image_path): ?>
                        <img src="<?php echo e(Storage::url($post->image_path)); ?>" alt="<?php echo e($post->title); ?>" class="h-32 rounded border mb-3">
                    <?php endif; ?>

                    <h2 class="text-lg font-bold">
                        <a href="<?php echo e(route('admin.posts.show', $post)); ?>" class="text-gray-800 hover:underline">
                            <?php echo e($post->title); ?>

                        </a>
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">Created <?php echo e($post->created_at->diffForHumans()); ?></p>

                    <div class="text-gray-700 mt-2">
                        <?php echo Str::limit(strip_tags($post->body), 200); ?>

                    </div>

                    <div class="flex items-center gap-3 mt-4">
                        <a href="<?php echo e(route('admin.posts.show', $post)); ?>" class="text-blue-600 hover:underline text-sm font-medium">Preview draft &rarr;</a>
                        <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="text-indigo-600 hover:underline text-sm font-medium">Edit</a>
                        <form action="<?php echo e(route('admin.posts.destroy', $post)); ?>" method="POST" onsubmit="return confirm('Delete this draft permanently?');" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline text-sm font-medium">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $attributes = $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/admin/posts/drafts.blade.php ENDPATH**/ ?>