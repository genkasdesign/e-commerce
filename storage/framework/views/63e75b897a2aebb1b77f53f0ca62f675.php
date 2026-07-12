<!DOCTYPE html>
<html>
<head>
    <title>Alerte stock bas</title>
</head>
<body>
    <h1>Alerte stock bas</h1>
    <p>Le produit <strong><?php echo e($product->name); ?></strong> a un stock de <strong><?php echo e($product->stock); ?></strong> unités.</p>
    <p>Veuillez réapprovisionner dès que possible.</p>
    <p><a href="<?php echo e(url('/admin/products/' . $product->id . '/edit')); ?>">Modifier le produit</a></p>
</body>
</html><?php /**PATH C:\xampp\htdocs\site-eCommerce\ecommerce\resources\views/emails/low-stock.blade.php ENDPATH**/ ?>