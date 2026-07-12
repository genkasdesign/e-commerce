

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Ajouter une catégorie</h1>
        <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-outline text-sm px-4 py-2">← Retour</a>
    </div>

    <?php if($errors->any()): ?>
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card p-6">
        <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1">Nom</label>
                <input type="text" name="name" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white" value="<?php echo e(old('name')); ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1">Slug</label>
                <input type="text" name="slug" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white" value="<?php echo e(old('slug')); ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white"><?php echo e(old('description')); ?></textarea>
            </div>
            <button type="submit" class="btn-primary w-full py-3">Créer</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>