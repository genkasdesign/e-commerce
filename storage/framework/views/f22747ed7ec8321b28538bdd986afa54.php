

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Mes favoris</h1>
        <p class="text-sm text-gray-400"><?php echo e($wishlists->count()); ?> produit(s)</p>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    <?php if($wishlists->count()): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card group">
                    <div class="relative overflow-hidden bg-gray-800 aspect-square flex items-center justify-center">
                        <?php if($wishlist->product->image): ?>
                            <img src="<?php echo e(asset('storage/' . $wishlist->product->image)); ?>" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300" alt="<?php echo e($wishlist->product->name); ?>">
                        <?php else: ?>
                            <span class="text-gray-500 text-sm">Pas d'image</span>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-white truncate"><?php echo e($wishlist->product->name); ?></h3>
                        <p class="text-sm text-gray-400 mt-1"><?php echo e(number_format($wishlist->product->price, 2)); ?> €</p>
                        <div class="flex items-center justify-between mt-3">
                            <a href="<?php echo e(route('product.show', $wishlist->product->slug)); ?>" class="btn-outline text-sm px-3 py-1 rounded-lg">Voir</a>
                            <form action="<?php echo e(route('wishlist.remove', $wishlist->product)); ?>" method="POST">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-400 hover:text-red-300 transition">Retirer</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="card p-12 text-center">
            <p class="text-gray-400">Vous n'avez aucun produit dans vos favoris.</p>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn-primary inline-block mt-4">Découvrir les produits</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/wishlist/index.blade.php ENDPATH**/ ?>