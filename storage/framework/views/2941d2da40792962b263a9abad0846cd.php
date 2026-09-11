<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(isset($category) ? 'Category: ' . $category->name : __('Blog Posts')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Category Filter Bar -->
            <?php if(isset($categories) && $categories->count() > 0): ?>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-6 flex flex-wrap gap-2">
                    <a href="<?php echo e(route('posts.index')); ?>" class="px-3 py-1 rounded text-sm font-medium <?php echo e(!isset($category) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                        All Posts
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('categories.show', $cat->slug)); ?>" class="px-3 py-1 rounded text-sm font-medium <?php echo e((isset($category) && $category->id === $cat->id) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>">
                            <?php echo e($cat->name); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $slug = $post->slug ?? Str::slug($post->title);
                    ?>
                    <div class="mb-6 pb-6 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                        
                        <!-- Clickable Category Badge -->
                        <?php if($post->category): ?>
                            <a href="<?php echo e(route('categories.show', $post->category->slug)); ?>" class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded mb-2 hover:bg-blue-200">
                                <?php echo e($post->category->name); ?>

                            </a>
                        <?php endif; ?>

                        <h3 class="text-xl font-bold text-gray-900">
                            <a href="<?php echo e(route('posts.show', $slug)); ?>" class="hover:text-blue-600">
                                <?php echo e($post->title); ?>

                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">Published on <?php echo e($post->created_at->format('M d, Y')); ?></p>
                        <div class="mt-2 text-gray-700">
                            <?php echo Str::limit(strip_tags($post->body), 200); ?>

                        </div>
                        <div class="mt-4">
                            <a href="<?php echo e(route('posts.show', $slug)); ?>" class="text-blue-600 hover:underline text-sm font-semibold">Read More &rarr;</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500">No posts available in this category yet.</p>
                <?php endif; ?>

                <div class="mt-6">
                    <?php echo e($posts->links()); ?>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/posts/index.blade.php ENDPATH**/ ?>