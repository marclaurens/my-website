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
    <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

    <form action="<?php echo e(route('admin.posts.update', $post->id)); ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo e(old('title', $post->title)); ?>" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="category_id">Category</label>
            <select name="category_id" id="category_id" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- None --</option>
                <?php $__currentLoopData = $categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $post->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="new_category">Or create a new category (optional)</label>
            <input type="text" name="new_category" id="new_category" value="<?php echo e(old('new_category')); ?>" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Leave blank to keep current category">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="body">Content</label>
            <textarea name="body" id="body"><?php echo e(old('body', $post->body)); ?></textarea>
            <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <?php if($post->image_path): ?>
            <div class="mb-4">
                <span class="text-xs text-gray-500 block mb-1">Current featured image:</span>
                <img src="<?php echo e(Storage::url($post->image_path)); ?>" alt="<?php echo e($post->title); ?>" class="h-24 rounded border mb-2">
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="image">Replace Featured Image (optional)</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500">
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-6 flex items-center space-x-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1" <?php echo e(old('is_published', $post->is_published) ? 'checked' : ''); ?> class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded">
                <span class="text-gray-700 font-medium">Published</span>
            </label>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Update Post</button>
        <a href="<?php echo e(route('admin.posts.index')); ?>" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>

    <?php $__env->startPush('scripts'); ?>
<link rel="stylesheet" href="/build/assets/ckeditor-init-BA9sK04e.css">
        <?php
            $pagesForEditor = \App\Models\Page::orderBy('title')->get()->map(function ($p) {
                return ['title' => $p->title, 'slug' => $p->slug, 'url' => '/page/' . $p->slug, 'published' => (bool) $p->is_published];
            })->values()->all();
        ?>
<script type="module">
    import('<?php echo e(Vite::asset("resources/js/ckeditor-init.js")); ?>').then(() => {
        window.initCkEditor('#body', {
            pages: <?php echo json_encode($pagesForEditor, 15, 512) ?>,
            simpleUpload: {
                uploadUrl: '<?php echo e(route("admin.posts.upload_image")); ?>',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            }
        }).catch(err => console.error('[CKEditor] init failed', err));
    }).catch(err => console.error('[CKEditor] module load failed', err));
</script>
<?php $__env->stopPush(); ?>
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
<?php /**PATH C:\Users\marcl\Desktop\my-website\resources\views/admin/posts/edit.blade.php ENDPATH**/ ?>