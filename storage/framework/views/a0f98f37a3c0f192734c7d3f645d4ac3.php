

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-brand-red">Mes commandes</h1>
        <p class="text-sm text-gray-400"><?php echo e($orders->count()); ?> commande(s)</p>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 mb-6 rounded-r-lg shadow-sm">
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    <?php if($orders->count()): ?>
        <div class="grid grid-cols-1 gap-6">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card p-6 hover:shadow-lg transition-shadow duration-300" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 50); ?>">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="h-14 w-14 rounded-full bg-gray-800 flex items-center justify-center text-2xl font-bold text-brand-red">
                                #<?php echo e($order->id); ?>

                            </div>
                            <div>
                                <div class="text-sm text-gray-400">Passée le</div>
                                <div class="font-medium text-white"><?php echo e($order->created_at->format('d/m/Y à H:i')); ?></div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="text-right">
                                <div class="text-sm text-gray-400">Total</div>
                                <div class="text-xl font-bold text-brand-red"><?php echo e(number_format($order->total, 2)); ?> $</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-400">Statut</div>
                                <?php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-900/30 text-yellow-300',
                                        'processing' => 'bg-blue-900/30 text-blue-300',
                                        'completed' => 'bg-green-900/30 text-green-300',
                                        'cancelled' => 'bg-red-900/30 text-red-300',
                                    ];
                                ?>
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full <?php echo e($statusColors[$order->status] ?? 'bg-gray-700 text-gray-300'); ?>">
                                    <?php echo e(__('status.' . $order->status)); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <a href="<?php echo e(route('orders.show', $order)); ?>" class="btn-outline text-sm px-4 py-2 rounded-lg">
                            Voir le détail
                            <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="card p-12 text-center" data-aos="fade-up">
            <svg class="w-24 h-24 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h2 class="text-2xl font-semibold text-white">Aucune commande</h2>
            <p class="text-gray-400 mt-2">Vous n'avez pas encore passé de commande.</p>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn-primary inline-block mt-6 px-6 py-3">Découvrir nos produits</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/orders/index.blade.php ENDPATH**/ ?>