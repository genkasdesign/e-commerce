

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-brand-red mb-8">Tableau de bord</h1>

    <!-- Cartes statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Commandes</div>
            <div class="text-3xl font-bold text-white"><?php echo e($totalOrders); ?></div>
        </div>
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Chiffre d'affaires</div>
            <div class="text-3xl font-bold text-brand-red"><?php echo e(number_format($totalRevenue, 2)); ?> $</div>
        </div>
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Clients</div>
            <div class="text-3xl font-bold text-white"><?php echo e($totalCustomers); ?></div>
        </div>
        <div class="card p-6 text-center">
            <div class="text-sm text-gray-400">Produits</div>
            <div class="text-3xl font-bold text-white"><?php echo e($totalProducts); ?></div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="card p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Ventes (7 derniers jours)</h2>
            <canvas id="dailyChart" height="200"></canvas>
        </div>
        <div class="card p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Ventes (12 derniers mois)</h2>
            <canvas id="monthlyChart" height="200"></canvas>
        </div>
    </div>

    <!-- Produits les plus consultés -->
    <div class="card p-6 mb-8">
        <h2 class="text-xl font-semibold text-white mb-4">Produits les plus consultés</h2>
        <?php if($topViewedProducts->count()): ?>
            <ul class="divide-y divide-gray-700">
                <?php $__currentLoopData = $topViewedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="py-2 flex justify-between items-center text-gray-300">
                        <span><?php echo e($product->name); ?></span>
                        <span class="text-sm text-gray-400"><?php echo e($product->views); ?> vues</span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-400">Aucune donnée pour le moment.</p>
        <?php endif; ?>
    </div>

    <!-- Produits les plus vendus -->
    <div class="card p-6 mb-8">
        <h2 class="text-xl font-semibold text-white mb-4">Produits les plus vendus</h2>
        <?php if($topProducts->count()): ?>
            <ul class="divide-y divide-gray-700">
                <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="py-2 flex justify-between items-center text-gray-300">
                        <span><?php echo e($product->name); ?></span>
                        <span class="text-brand-red font-semibold"><?php echo e($product->total_sold); ?> vendus</span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-400">Aucune vente pour le moment.</p>
        <?php endif; ?>
    </div>

    <!-- Commandes récentes -->
    <div class="card p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Dernières commandes</h2>
        <?php if($recentOrders->count()): ?>
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="text-left text-xs text-gray-400">
                    <tr>
                        <th class="pb-2">#</th>
                        <th class="pb-2">Client</th>
                        <th class="pb-2">Total</th>
                        <th class="pb-2">Statut</th>
                        <th class="pb-2">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="py-2 text-sm text-gray-300">
                        <td class="py-2"><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->user->email); ?></td>
                        <td><?php echo e(number_format($order->total, 2)); ?> $</td>
                        <td>
                            <span class="px-2 py-1 text-xs rounded-full 
                                <?php if($order->status == 'pending'): ?> bg-yellow-900/30 text-yellow-300
                                <?php elseif($order->status == 'processing'): ?> bg-blue-900/30 text-blue-300
                                <?php elseif($order->status == 'completed'): ?> bg-green-900/30 text-green-300
                                <?php else: ?> bg-red-900/30 text-red-300 <?php endif; ?>">
                                <?php echo e(ucfirst($order->status)); ?>

                            </span>
                        </td>
                        <td><?php echo e($order->created_at->format('d/m/Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-400">Aucune commande récente.</p>
        <?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique journalier
    fetch('/admin/charts/daily')
        .then(res => res.json())
        .then(data => {
            const ctx = document.getElementById('dailyChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: 'Ventes (USD)',
                        data: data.map(item => item.total),
                        backgroundColor: 'rgba(230, 57, 70, 0.6)',
                        borderColor: '#E63946',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { labels: { color: '#e5e7eb' } }
                    },
                    scales: {
                        y: { ticks: { color: '#e5e7eb' } },
                        x: { ticks: { color: '#e5e7eb' } }
                    }
                }
            });
        });

    // Graphique mensuel
    fetch('/admin/charts/monthly')
        .then(res => res.json())
        .then(data => {
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.month),
                    datasets: [{
                        label: 'Ventes (USD)',
                        data: data.map(item => item.total),
                        borderColor: '#E63946',
                        backgroundColor: 'rgba(230, 57, 70, 0.1)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { labels: { color: '#e5e7eb' } }
                    },
                    scales: {
                        y: { ticks: { color: '#e5e7eb' } },
                        x: { ticks: { color: '#e5e7eb' } }
                    }
                }
            });
        });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>