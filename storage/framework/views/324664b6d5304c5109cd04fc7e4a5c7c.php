

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Modifier le client</h1>
        <a href="<?php echo e(route('admin.clients.index')); ?>" class="btn-outline text-sm px-4 py-2 rounded-lg">← Retour</a>
    </div>

    <div class="card p-6">
        <form action="<?php echo e(route('admin.clients.update', $client)); ?>" method="POST">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name', $client->name)); ?>" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
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
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email', $client->email)); ?>" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" required>
                <?php $__errorArgs = ['email'];
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

            <div class="mb-6">
                <label for="is_admin" class="flex items-center space-x-3 text-sm font-medium text-gray-300">
                    <input type="checkbox" name="is_admin" value="1" id="is_admin" 
                           class="rounded border-gray-600 bg-gray-800 text-brand-red shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50"
                           <?php if($client->is_admin): ?> checked <?php endif; ?>>
                    <span>Administrateur</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary px-6 py-2.5 rounded-lg">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/clients/edit.blade.php ENDPATH**/ ?>