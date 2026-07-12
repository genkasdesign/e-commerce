<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle commande</title>
</head>
<body>
    <h1>Nouvelle commande #<?php echo e($order->id); ?></h1>
    <p>Un client vient de passer une commande.</p>
    <p><strong>Total :</strong> <?php echo e(number_format($order->total, 2)); ?> $</p>
    <p><strong>Client :</strong> <?php echo e($order->user->email); ?></p>
    <p><a href="<?php echo e(url('/admin/orders')); ?>">Voir la commande</a></p>
</body>
</html><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/emails/new-order-notification.blade.php ENDPATH**/ ?>