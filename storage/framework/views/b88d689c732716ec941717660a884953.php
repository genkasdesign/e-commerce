

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <?php if(session('success')): ?>
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('error')); ?></p>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Image -->
        <div class="bg-gray-800 rounded-xl overflow-hidden flex items-center justify-center aspect-square">
            <?php if($product->image): ?>
                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="object-cover w-full h-full" alt="<?php echo e($product->name); ?>">
            <?php else: ?>
                <span class="text-gray-500 text-sm">Aucune image</span>
            <?php endif; ?>
        </div>

        <!-- Informations -->
        <div class="space-y-4">
            <h1 class="text-3xl font-bold text-white"><?php echo e($product->name); ?></h1>
            <p class="text-gray-400">Catégorie : <?php echo e($product->category->name ?? 'Non catégorisé'); ?></p>
            <p class="text-gray-300 leading-relaxed"><?php echo e($product->description); ?></p>
            <p class="text-3xl font-bold text-brand-red"><?php echo e(number_format($product->price, 2)); ?> $</p>
            <p class="text-gray-400">Stock : <span class="text-white font-medium"><?php echo e($product->stock); ?></span></p>

            <!-- Panier -->
            <?php if(!auth()->user() || !auth()->user()->isAdmin()): ?>
                <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-300 mb-1">Quantité</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo e($product->stock); ?>" 
                               class="w-24 rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red">
                    </div>
                    <button type="submit" class="btn-primary px-6 py-2">Ajouter au panier</button>
                </form>
            <?php else: ?>
                <div class="bg-yellow-900/30 border-l-4 border-yellow-500 text-yellow-300 p-4 rounded-lg">
                    Mode administration : vous ne pouvez pas acheter.
                </div>
            <?php endif; ?>

            <!-- Favoris -->
            <?php if(auth()->guard()->check()): ?>
                <?php if(!auth()->user()->isAdmin()): ?>
                    <?php
                        $inWishlist = auth()->user()->isProductInWishlist($product->id);
                    ?>
                    <?php if($inWishlist): ?>
                        <form action="<?php echo e(route('wishlist.remove', $product)); ?>" method="POST" class="inline-block">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-400 hover:text-red-300 transition">
                                Retirer des favoris
                            </button>
                        </form>
                    <?php else: ?>
                        <form action="<?php echo e(route('wishlist.add', $product)); ?>" method="POST" class="inline-block">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-brand-red hover:underline transition">
                                Ajouter aux favoris
                            </button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/products/show.blade.php ENDPATH**/ ?>