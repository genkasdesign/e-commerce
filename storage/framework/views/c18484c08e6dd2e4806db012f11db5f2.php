<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de commande</title>
</head>
<body>
    <h1>Merci pour votre commande #<?php echo e($order->id); ?></h1>
    <p>Bonjour <?php echo e($order->user->name); ?>,</p>
    <p>Votre commande a bien été enregistrée.</p>
    <p><strong>Total :</strong> <?php echo e(number_format($order->total, 2)); ?> $</p>
    <p><strong>Statut :</strong> <?php echo e(__('status.' . $order->status)); ?></p>
    <p>Vous pouvez suivre votre commande sur votre espace client.</p>
    <p>À bientôt,<br>L'équipe GenShop</p>
</body>
</html><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/emails/order-confirmation.blade.php ENDPATH**/ ?>