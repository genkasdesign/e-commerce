

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Toutes les commandes (admin)</h1>
        <a href="<?php echo e(route('admin.export.orders')); ?>" class="btn-primary px-4 py-2">
            Exporter CSV
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    <!-- Filtres avancés -->
    <div class="card p-6 mb-8">
        <form method="GET" action="<?php echo e(route('admin.orders.index')); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Statut</label>
                <select name="status" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white">
                    <option value="">Tous</option>
                    <?php $__currentLoopData = ['pending', 'processing', 'completed', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php echo e(request('status') == $status ? 'selected' : ''); ?>>
                            <?php echo e(__('status.' . $status)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Date de début</label>
                <input type="date" name="from" value="<?php echo e(request('from')); ?>" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Date de fin</label>
                <input type="date" name="to" value="<?php echo e(request('to')); ?>" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Client (email)</label>
                <input type="text" name="client" placeholder="email@exemple.com" value="<?php echo e(request('client')); ?>"
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white">
            </div>
            <div class="md:col-span-4 flex justify-end">
                <button type="submit" class="btn-primary px-6 py-2">Filtrer</button>
                <?php if(request()->anyFilled(['status', 'from', 'to', 'client'])): ?>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn-outline ml-3 px-6 py-2">Réinitialiser</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Paiement</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-800/50 transition-colors" id="order-row-<?php echo e($order->id); ?>">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($order->id); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($order->user->email); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e(number_format($order->total, 2)); ?> $</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>" method="POST" class="order-status-form" data-order-id="<?php echo e($order->id); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <select name="status" class="rounded-lg border-gray-600 bg-gray-800 text-white text-sm">
                                        <?php $__currentLoopData = ['pending', 'processing', 'completed', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($status); ?>" <?php echo e($order->status == $status ? 'selected' : ''); ?>>
                                                <?php echo e(__('status.' . $status)); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <button type="submit" class="btn-outline text-xs px-3 py-1 rounded-lg">Mettre à jour</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 py-1 text-xs rounded-full status-badge
                                    <?php if($order->payment_status == 'pending'): ?> bg-yellow-900/30 text-yellow-300
                                    <?php elseif($order->payment_status == 'paid'): ?> bg-green-900/30 text-green-300
                                    <?php else: ?> bg-red-900/30 text-red-300 <?php endif; ?>">
                                    <?php echo e(__('status.' . $order->payment_status)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300"><?php echo e($order->created_at->format('d/m/Y')); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="<?php echo e(route('orders.show', $order)); ?>" class="text-blue-400 hover:text-blue-300 transition">Voir</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">Aucune commande.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>