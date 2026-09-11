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
<div class="container mx-auto py-6 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold"><?php echo e($post->title); ?></h1>
        <div class="flex gap-2">
            <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Edit</a>
            <a href="<?php echo e(route('admin.posts.index')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded">Back</a>
        </div>
    </div>

    <?php if($post->image_path): ?>
        <img src="<?php echo e(Storage::url($post->image_path)); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-auto rounded border mb-4">
    <?php endif; ?>

    <div class="bg-white shadow rounded p-6">
        <p class="text-sm text-gray-500 mb-4">
            <?php if($post->category): ?>
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded mr-2"><?php echo e($post->category->name); ?></span>
            <?php endif; ?>
            <?php if($post->is_published): ?>
                <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded mr-2">Published</span>
            <?php else: ?>
                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded mr-2">Draft</span>
            <?php endif; ?>
            Created <?php echo e($post->created_at->format('F j, Y')); ?>

        </p>

        <div class="prose max-w-none text-gray-800">
            <?php echo $post->body; ?>

        </div>
    </div>
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
<?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/admin/posts/show.blade.php ENDPATH**/ ?>