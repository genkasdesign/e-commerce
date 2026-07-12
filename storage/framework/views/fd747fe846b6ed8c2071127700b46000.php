

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Historique des mouvements - <?php echo e($product->name); ?></h1>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn-outline px-4 py-2">← Retour</a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Stock avant</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Stock après</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300">Raison</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-white"><?php echo e($movement->created_at->format('d/m/Y H:i')); ?></td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full
                                    <?php if($movement->type == 'in'): ?> bg-green-900/30 text-green-300
                                    <?php else: ?> bg-red-900/30 text-red-300 <?php endif; ?>">
                                    <?php echo e($movement->type == 'in' ? 'Entrée' : 'Sortie'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-white"><?php echo e($movement->quantity); ?></td>
                            <td class="px-6 py-4 text-sm text-gray-300"><?php echo e($movement->stock_before); ?></td>
                            <td class="px-6 py-4 text-sm text-gray-300"><?php echo e($movement->stock_after); ?></td>
                            <td class="px-6 py-4 text-sm text-gray-300"><?php echo e($movement->reason ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">Aucun mouvement.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/products/stock-history.blade.php ENDPATH**/ ?>