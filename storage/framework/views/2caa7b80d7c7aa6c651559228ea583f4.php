

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Mon panier</h1>
        <p class="text-sm text-gray-400">
            <?php echo e(isset($cart) && count($cart) > 0 ? count($cart) . ' article(s)' : '0 article'); ?>

        </p>
    </div>

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

    <?php if(empty($cart)): ?>
        <div class="card p-12 text-center" data-aos="fade-up">
            <svg class="w-24 h-24 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-2xl font-semibold text-white">Votre panier est vide</h2>
            <p class="text-gray-400 mt-2">Decouvrez nos produits et remplissez-le !</p>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn-primary inline-block mt-6 px-6 py-3">Voir les produits</a>
        </div>
    <?php else: ?>
        <div class="card overflow-hidden" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-800/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Quantite</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-800" id="cart-items">
                        <?php $grandTotal = 0; ?>
                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $subtotal = $item['price'] * $item['quantity'];
                            $grandTotal += $subtotal;
                        ?>
                        <tr class="hover:bg-gray-800/50 transition-colors" data-product-id="<?php echo e($id); ?>">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <div class="h-12 w-12 flex-shrink-0 rounded-lg overflow-hidden bg-gray-800">
                                        <?php if(isset($item['image']) && $item['image']): ?>
                                            <img src="<?php echo e(asset('storage/' . $item['image'])); ?>" class="h-full w-full object-cover" alt="<?php echo e($item['name']); ?>">
                                        <?php else: ?>
                                            <div class="h-full w-full flex items-center justify-center text-gray-500 text-xs">Image</div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-white"><?php echo e($item['name']); ?></div>
                                        <div class="text-xs text-gray-400">Ref: #<?php echo e($id); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                <?php echo e(number_format($item['price'], 2)); ?> $
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST" class="cart-update-form" data-product-id="<?php echo e($id); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" max="99" 
                                           class="w-16 rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50 text-center">
                                    <button type="submit" class="btn-outline text-xs px-3 py-1.5 rounded-lg">Actualiser</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-brand-red subtotal">
                                <?php echo e(number_format($subtotal, 2)); ?> $
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <form action="<?php echo e(route('cart.remove', $id)); ?>" method="POST" class="inline-block cart-remove-form">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-danger text-xs px-3 py-1.5 rounded-lg" onclick="return confirm('Supprimer cet article ?')">
                                        <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-800/50 px-6 py-4 border-t border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-sm text-gray-400">
                    <span class="font-medium text-white"><?php echo e(count($cart)); ?> article(s)</span> dans votre panier
                </div>
                <div class="flex items-center space-x-6">
                    <span class="text-base font-medium text-white">Total :</span>
                    <span class="text-2xl font-bold text-brand-red grand-total" id="grand-total">
                        <?php echo e(number_format($grandTotal, 2)); ?> $
                    </span>
                </div>
            </div>
        </div>

        <!-- Formulaire de validation -->
        <div class="card mt-8" data-aos="fade-up" data-aos-delay="200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Adresse de livraison</h3>
                <form action="<?php echo e(route('checkout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="shipping_address" class="block text-sm font-medium text-gray-300 mb-1">Votre adresse complete</label>
                        <textarea name="shipping_address" id="shipping_address" rows="3" 
                                  class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red focus:ring-opacity-50" 
                                  placeholder="Ex: 123 rue du Commerce, 75001 Paris" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full sm:w-auto px-8 py-3 text-base">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Valider la commande
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/cart/index.blade.php ENDPATH**/ ?>