

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Gestion des clients</h1>
        <a href="<?php echo e(route('admin.export.clients')); ?>" class="btn-primary px-4 py-2">
            Exporter CSV
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
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Admin ?</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-800">
                    <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($client->id); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($client->name); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($client->email); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white"><?php echo e($client->is_admin ? 'Oui' : 'Non'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="<?php echo e(route('admin.clients.edit', $client)); ?>" class="text-blue-400 hover:text-blue-300 transition mr-3">Modifier</a>
                                <form action="<?php echo e(route('admin.clients.destroy', $client)); ?>" method="POST" class="inline-block">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">Aucun client.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/clients/index.blade.php ENDPATH**/ ?>