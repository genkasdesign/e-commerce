

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Ajouter un produit</h1>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn-outline text-sm px-4 py-2 rounded-lg">← Retour</a>
    </div>

    <div class="card p-6">
        <form action="<?php echo e(route('admin.products.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-300 mb-1">Catégorie</label>
                <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                    <option value="">Sélectionner une catégorie</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom du produit</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-300 mb-1">Slug (URL unique)</label>
                <input type="text" name="slug" id="slug" value="<?php echo e(old('slug')); ?>" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                <p class="text-xs text-gray-400 mt-1">Ex: mon-produit-super</p>
                <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="5" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-1">Prix (€)</label>
                    <input type="number" step="0.01" name="price" id="price" value="<?php echo e(old('price')); ?>" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-300 mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" value="<?php echo e(old('stock')); ?>" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                    <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-300 mb-1">Image (optionnel)</label>
                <input type="file" name="image" id="image" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50">
                <p class="text-xs text-gray-400 mt-1">Formats autorisés : jpg, jpeg, png (max 2MB)</p>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary px-6 py-2.5 rounded-lg">Créer le produit</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/products/create.blade.php ENDPATH**/ ?>