<div class="mt-16">
    <h2 class="text-2xl font-bold text-white text-center mb-8">Avis clients</h2>
    <?php if($reviews->count()): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-white font-medium"><?php echo e($review->user->name); ?></span>
                        <span class="text-yellow-400">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <span class="text-sm"><?php echo e($i <= $review->rating ? '★' : '☆'); ?></span>
                            <?php endfor; ?>
                        </span>
                    </div>
                    <p class="text-gray-300 text-sm"><?php echo e($review->comment); ?></p>
                    <p class="text-gray-500 text-xs mt-2">Sur <?php echo e($review->product->name ?? 'un produit'); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="text-gray-400 text-center">Aucun avis pour le moment.</p>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        <?php if(!auth()->user()->isAdmin()): ?>
            <div class="text-center mt-6">
                <a href="<?php echo e(route('reviews.create')); ?>" class="btn-primary inline-block px-6 py-2">Laisser un avis</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/partials/reviews.blade.php ENDPATH**/ ?>