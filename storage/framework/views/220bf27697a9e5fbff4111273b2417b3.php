<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="card w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-white text-center mb-6">Connexion</h2>

        <?php if($errors->any()): ?>
            <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 mb-4 rounded-r-lg shadow-sm">
                <ul class="list-disc pl-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="w-full rounded-lg border-gray-600 bg-gray-800 text-white shadow-sm focus:border-brand-red focus:ring-brand-red" 
                       required>
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-300">
                    <input type="checkbox" name="remember" class="rounded border-gray-600 bg-gray-800 text-brand-red shadow-sm focus:ring-brand-red">
                    <span class="ml-2">Se souvenir de moi</span>
                </label>
                <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-brand-red hover:underline">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-primary w-full py-3">Se connecter</button>

            <p class="text-center text-gray-400 text-sm mt-4">
                Pas encore de compte ? 
                <a href="<?php echo e(route('register')); ?>" class="text-brand-red hover:underline">Créer un compte</a>
            </p>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/auth/login.blade.php ENDPATH**/ ?>