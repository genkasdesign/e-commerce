<!DOCTYPE html>
<html>
<head>
    <title>Alerte stock bas</title>
</head>
<body>
    <h1>Alerte stock bas</h1>
    <p>Le produit <strong>{{ $product->name }}</strong> a un stock de <strong>{{ $product->stock }}</strong> unités.</p>
    <p>Veuillez réapprovisionner dès que possible.</p>
    <p><a href="{{ url('/admin/products/' . $product->id . '/edit') }}">Modifier le produit</a></p>
</body>
</html>