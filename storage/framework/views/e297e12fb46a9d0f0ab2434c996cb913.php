<?php
    $hasChildren = $item->children && $item->children->isNotEmpty();
    $isLink      = !empty($item->url) || !empty($item->page_id);
    $href        = $item->target_url;
    $padLeft     = 16 + ($depth * 16);
?>

<?php if($hasChildren): ?>
    <div x-data="{ open: false }">
        <div class="flex items-center">
            <?php if($isLink): ?>
                <a
                    href="<?php echo e($href); ?>"
                    class="flex-1 block pe-2 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out"
                    style="padding-left: <?php echo e($padLeft); ?>px;"
                >
                    <?php echo e($item->title); ?>

                </a>
                <button
                    type="button"
                    @click="open = !open"
                    class="px-3 py-2 text-gray-500 hover:text-gray-800 focus:outline-none"
                    :aria-expanded="open"
                    aria-label="Toggle submenu"
                >
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            <?php else: ?>
                <button
                    type="button"
                    @click="open = !open"
                    class="flex-1 flex items-center justify-between pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
                    style="padding-left: <?php echo e($padLeft); ?>px;"
                    :aria-expanded="open"
                >
                    <span><?php echo e($item->title); ?></span>
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            <?php endif; ?>
        </div>

        <div x-show="open" class="bg-gray-50">
            <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.menu-item-mobile', ['item' => $child, 'depth' => $depth + 1], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php else: ?>
    <a
        href="<?php echo e($href); ?>"
        class="block pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
        style="padding-left: <?php echo e($padLeft); ?>px;"
    >
        <?php echo e($item->title); ?>

    </a>
<?php endif; ?><?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/partials/menu-item-mobile.blade.php ENDPATH**/ ?>