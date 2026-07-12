<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'GenShop')); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="font-sans antialiased bg-gray-950 text-gray-200">
    <div class="min-h-screen flex flex-col bg-gray-950">
        <!-- ⚠️ NAVIGATION EN PREMIER -->
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php if(isset($header)): ?>
            <header class="border-b border-gray-800 bg-gray-900/80">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Messages Flash -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <?php if(session('success')): ?>
                <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 rounded-r-lg shadow-sm">
                    <p><?php echo e(session('success')); ?></p>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 rounded-r-lg shadow-sm">
                    <p><?php echo e(session('error')); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Contenu principal -->
        <main class="flex-1 py-8">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Footer -->
        <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->isAdmin()): ?>
                <?php echo $__env->make('layouts.admin-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>
        <?php else: ?>
            <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/layouts/app.blade.php ENDPATH**/ ?>