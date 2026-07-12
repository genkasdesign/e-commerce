

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Gestion des produits</h1>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn-primary px-4 py-2">
            + Ajouter un produit
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Prix</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($product->id); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-10 w-10 rounded-lg overflow-hidden bg-gray-800">
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="h-full w-full object-cover" alt="<?php echo e($product->name); ?>">
                                    <?php else: ?>
                                        <div class="h-full w-full flex items-center justify-center text-gray-500 text-xs">Image</div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($product->name); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300"><?php echo e($product->category->name ?? '—'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e(number_format($product->price, 2)); ?> $</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?php if($product->stock <= 5): ?>
                                    <span class="text-red-400 font-semibold"><?php echo e($product->stock); ?></span>
                                    <span class="text-xs text-red-400 ml-1">⚠️ stock bas</span>
                                <?php else: ?>
                                    <span class="text-white"><?php echo e($product->stock); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="<?php echo e(route('admin.products.show', $product)); ?>" class="text-blue-400 hover:text-blue-300 transition mr-2">Voir</a>
                                <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="text-blue-400 hover:text-blue-300 transition mr-2">Modifier</a>
                                <a href="<?php echo e(route('admin.products.stock-history', $product)); ?>" class="text-green-400 hover:text-green-300 transition mr-2">Stock</a>
                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="inline-block">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                Aucun produit. <a href="<?php echo e(route('admin.products.create')); ?>" class="text-brand-red hover:underline">Ajouter le premier</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/products/index.blade.php ENDPATH**/ ?>