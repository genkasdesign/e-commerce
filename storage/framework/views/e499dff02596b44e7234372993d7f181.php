

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">✏️ Modifier : <?php echo e($product->name); ?></h1>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn-outline text-sm px-4 py-2 rounded-lg">← Retour</a>
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
        <form action="<?php echo e(route('admin.products.update', $product)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-300 mb-1">Catégorie</label>
                <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
                    <option value="">Sélectionner</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom du produit</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="<?php echo e(old('name', $product->name)); ?>" required>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-300 mb-1">Slug (URL unique)</label>
                <input type="text" name="slug" id="slug" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="<?php echo e(old('slug', $product->slug)); ?>" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red"><?php echo e(old('description', $product->description)); ?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-1">Prix ($)</label>
                    <input type="number" step="0.01" name="price" id="price" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="<?php echo e(old('price', $product->price)); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-300 mb-1">Stock</label>
                    <input type="number" name="stock" id="stock" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" value="<?php echo e(old('stock', $product->stock)); ?>" required>
                </div>
            </div>

            <!-- Ajout de stock -->
            <div class="mb-4">
                <label for="add_stock" class="block text-sm font-medium text-gray-300 mb-1">Ajouter au stock</label>
                <input type="number" name="add_stock" id="add_stock" value="0" min="0" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red">
                <p class="text-xs text-gray-500 mt-1">Entrez une quantité pour augmenter le stock (le stock actuel sera conservé).</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300 mb-1">Image actuelle</label>
                <?php if($product->image): ?>
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="h-24 w-24 object-cover rounded-lg mb-2">
                <?php else: ?>
                    <p class="text-gray-400 text-sm">Aucune image</p>
                <?php endif; ?>
                <input type="file" name="image" id="image" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Laissez vide pour conserver l'image actuelle.</p>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Mettre à jour</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>