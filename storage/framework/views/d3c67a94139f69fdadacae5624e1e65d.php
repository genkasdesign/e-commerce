

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-6">Laisser un avis</h1>

    <?php if(session('error')): ?>
        <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($products->count()): ?>
        <div class="card p-6">
            <form action="<?php echo e(route('reviews.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-4">
                    <label for="product_id" class="block text-sm font-medium text-gray-300 mb-1">Produit</label>
                    <select name="product_id" id="product_id" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required>
                        <option value="">Sélectionnez un produit acheté</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->id); ?>" <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>><?php echo e($product->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['product_id'];
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
                    <label class="block text-sm font-medium text-gray-300 mb-1">Note</label>
                    <div class="flex flex-row-reverse justify-end space-x-1 space-x-reverse" x-data="{ rating: <?php echo e(old('rating', 0)); ?> }">
                        <?php for($i=5; $i>=1; $i--): ?>
                            <label class="cursor-pointer text-3xl" :class="rating >= <?php echo e($i); ?> ? 'text-yellow-400' : 'text-gray-500'">
                                <input type="radio" name="rating" value="<?php echo e($i); ?>" x-model="rating" class="hidden">
                                ★
                            </label>
                        <?php endfor; ?>
                    </div>
                    <?php $__errorArgs = ['rating'];
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
                    <label for="comment" class="block text-sm font-medium text-gray-300 mb-1">Votre avis</label>
                    <textarea name="comment" id="comment" rows="4" class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" required><?php echo e(old('comment')); ?></textarea>
                    <?php $__errorArgs = ['comment'];
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

                <button type="submit" class="btn-primary w-full py-3">Publier l'avis</button>
            </form>
        </div>
    <?php else: ?>
        <div class="card p-12 text-center">
            <p class="text-gray-400">Vous n'avez pas encore acheté de produits pour laisser un avis.</p>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn-primary inline-block mt-4">Découvrir nos produits</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/reviews/create.blade.php ENDPATH**/ ?>